<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Revenue;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Models\Game\Marketplace;
use App\Models\Game\RevenueOther;
use Illuminate\Support\Facades\Auth;
use App\Models\Game\FinancialStatement;
use Illuminate\Support\Facades\Session;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use App\Traits\RevenueTraits;

class DecisionDriven extends Component
{
    use RevenueTraits;
    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];


    public $total_revenue_array;

    public $user_id;
    public $game_id;
    public $bangladesh_id;
    public $nepal_id;

    public $market_share;
    //    market share
    public $MARKET_TOTAL_SELL_VALUE = 2000;


//    Revenue
    public $bn_total_revenue;
    public $np_total_revenue;

//    Cost
    public $bn_total_cost;
    public $np_total_cost;

//    unit sales in country
    public $calculated_unit_sales;

    public $net_income;

    public $total_price = 0;
    public $total_competitor_price = 0;

    public $price = [];
    public $competitor = [];

//    public function calculateMarketShare()
//    {
//
//        $this->user_id = Auth::user()->id;
//
//        $this->game_id = Session::get('game_id');
//
//        $this->bangladesh_id = Marketplace::where('name','Bangladesh')->first()->id;
//        $this->nepal_id = Marketplace::where('name','Nepal')->first()->id;
//
//        $market_places = Marketplace::all();
//        $products = Product::all();
//
//        $revenue = [];
//        foreach($market_places as $market_place){
//
//            foreach($products as $product){
//                $revenue_row = Revenue::where('user_id',$this->user_id)
//                    ->where('game_id',$this->game_id)
//                    ->where('market_place_id',$market_place->id)
//                    ->where('product_id',$product->id)->first();
//                $revenue[] = [
//                    "id" => $revenue_row->id,
//                    "country" => $market_place->name,
//                    "product" => $product->name,
//                    "revenue" => $revenue_row->revenue,
//                    "product_cost" => $revenue_row->product_cost,
//                    "price" => $revenue_row->price,
//                    "competitor" => $revenue_row->competitors_price
//
//                ];
//
//                $this->total_revenue_array = $revenue;
//
//            }
//        }
//
//        $this->total_revenue_array = $revenue;
//
//        $total_revenue = 0  ;
//
//        // Bangladesh & Nepal ( Product A & B ) revenues
//        foreach($revenue as $value){
//            $total_revenue += $value['revenue'];
//        }
//        $this->market_share = $total_revenue/$this->MARKET_TOTAL_SELL_VALUE;
//
//        $this->market_share = 5;
//    }

    public function calculateMarketShare(){

        $revenue = $this->calculateRevenueArray();
        $this->total_revenue_array = $revenue;
        $total_revenue = 0  ;

        // Bangladesh & Nepal ( Product A & B ) revenues
        foreach($revenue as $value){
            $total_revenue += $value['revenue'];
        }
        $this->market_share = $total_revenue/$this->MARKET_TOTAL_SELL_VALUE;

        // $this->market_share = 5;
    }

    public function calculateRevenue()
    {

        $calculated_revenues = [];
        foreach($this->total_revenue_array as $revenue){



            $revenue_other = RevenueOther::where('revenue_id',$revenue['id'])->first();

            if(!is_null($revenue_other)){
                $calculated_revenues[] = [
                    "id" => $revenue['id'],
                    "country" => $revenue['country'],
                    "product" => $revenue['product'],
                    "unit_m1" => $revenue_other->month1_unit,
                    "revenue_m1" => $revenue['revenue'],
                    "unit_m2" => $revenue_other->month2_unit,
                    "revenue_m2" => $revenue_other->month2_revenue,
                ];
            }
            


        }

        $this->calculated_unit_sales = $calculated_revenues;
//        dd($calculated_revenues);
        foreach($calculated_revenues as $calculated_revenue){
            if($calculated_revenue['country']=="Bangladesh"){
                $this->bn_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }elseif($calculated_revenue['country']=="Nepal"){
                $this->np_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }
        }
    }



    public function calculateCost()
    {
        foreach($this->total_revenue_array as $cost){
            if($cost['country']=="Bangladesh"){
                $this->bn_total_cost += $cost['product_cost'];
            }elseif($cost['country']=="Nepal"){
                $this->np_total_cost += $cost['product_cost'] ;
            }
        }
//        dd($this->np_total_cost);
    }

    public $bn_unit_sales =[];
    public $np_unit_sales =[];

    public function calculateUnitSales()
    {
//        dd($this->calculated_unit_sales);
        foreach($this->calculated_unit_sales as $unit_sale){
            if($unit_sale['country']=="Bangladesh"){
                $this->bn_unit_sales[]= $unit_sale['unit_m1'];
                $this->bn_unit_sales[]= $unit_sale['unit_m2'];
            }elseif($unit_sale['country']=="Nepal"){
                $this->np_unit_sales[]= $unit_sale['unit_m1'] ;
                $this->np_unit_sales[]= $unit_sale['unit_m2'] ;
            }
        }

        $this->bn_unit_sales = collect($this->bn_unit_sales)->implode(',');
        $this->np_unit_sales = collect($this->np_unit_sales)->implode(',');


//        dd($this->np_unit_sales);
    }

    

    public function calculateNetIncome()
    {
        $finansial_statements = FinancialStatement::where('user_id',$this->user_id)
        ->where('game_id',$this->game_id)->first();
        // dd($finansial_statements);
        $this->net_income = $finansial_statements->total_revenue - $finansial_statements->total_expanses;

        
        
    }



    public $pricelabel = [];

    public function calculatePriceVsCompetition()
    {
//        dd($this->total_revenue_array);

        foreach($this->total_revenue_array as $item){
            $item = (object) $item;
            $this->total_price += $item->price;
            $this->total_competitor_price += $item->competitor;

//            $this->priceVsCompetition[] = [
//                "price" => $item->price,
//                "competitor_price" => $item->competitors_price
//            ];

            $this->pricelabel[] = (($item->country=='Bangladesh')? 'Bn' :'Np') .'_'.$item->product;

            $this->price[] = $item->price;
            $this->competitor[] = $item->competitor;
        }

//        dd($this->pricelabel);



        $this->price = collect($this->price)->implode(',');
        $this->competitor = collect($this->competitor)->implode(',');
//        $this->pricelabel = collect($this->pricelabel)->implode(',');
        $this->pricelabel =  json_encode($this->pricelabel);

//        dd($this->pricelabel);

}

    public function mount(){

        $this->calculateMarketShare();
        $this->calculateRevenue();
        $this->calculateCost();
        $this->calculateUnitSales();
        $this->calculateNetIncome();
        $this->calculatePriceVsCompetition();




    }


    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];

    public $firstRun = true;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }


    public function render()
    {
        $columnChartModel  =  (new ColumnChartModel())
        ->setTitle('Expenses by Type')
        ->addColumn('food','300','#f6ad55')
        ->addColumn('shopping','600','#f6ad56')
        ->addColumn('entertainment','900','#90cdf4')
        ->setAnimated($this->firstRun)
        ->withOnColumnClickEventName('onColumnClick');


    $lineChartModel = (new LineChartModel())
        ->setTitle('Expenses Evolution')
        ->addMarker("test 1",200)
        ->addMarker("test 2",300)
        ->addPoint("hello",400)
        ->setAnimated($this->firstRun)
        ->withOnPointClickEvent('onPointClick');


    $areaChartModel = (new AreaChartModel())
            ->setTitle('Expenses Peaks')
            ->setAnimated($this->firstRun)
            ->setColor('#f6ad55')
            ->addPoint('hello','')
            ->withOnPointClickEvent('onAreaPointClick')
            ->setXAxisVisible(false)
            ->setYAxisVisible(true);


    $pieChartModel =  (new PieChartModel())
                ->setTitle('Expenses by Type')
                ->addSlice('hardword',200,'red')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick');





        return view('livewire.decision-driven',[
            'columnChartModel'=>$columnChartModel,
            'lineChartModel'=>$lineChartModel,
            'areaChartModel'=>$areaChartModel,
            'pieChartModel'=>$pieChartModel,
        ]);
    }
}
