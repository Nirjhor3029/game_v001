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
    public $MARKET_TOTAL_SELL_VALUE = 1000;
    public $marketShareValues=[];
    public $marketShareLabels=[];


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

    public $bn_unit_sales = [];
    public $np_unit_sales = [];

    public $pricelabel = [];

    public $marketPlaces;
    public $products;
    public $months;

    public $previousUrl = "/cash-flow-statements";
    public $nextUrl = "/course-points";
    

    public $selectedMarketPlace;
//    public $products;
//    public $months;

    // code for check null/empty value and show error message
    public $check_null = 1;

    public function updated($propertyName)
    {
        if ($this->$propertyName == "") {
            $this->check_null = 0;
        } else {
            $this->check_null = 1;
        }

    }


    public function mount()
    {
        $this->marketPlaces = Marketplace::all();
        $this->products = Product::all();
        $this->months = [
            1,2
        ];

        if ($this->check_null) {
            $this->calculateMarketShare();
            $this->calculateRevenue();
            $this->calculateCost();
            $this->calculateUnitSales();
            $this->calculateNetIncome();
            $this->calculatePriceVsCompetition();
        }
    }

    public function render()
    {
        if ($this->check_null) {
            return view('livewire.decision-driven');
        }

    }


    public function calculateMarketShare()
    {
        $revenue = $this->calculateRevenueArray();
        //dd($revenue);
        $this->total_revenue_array = $revenue;
        $total_revenue_bd = 0;
        $total_revenue_np = 0;

        // Bangladesh & Nepal ( Product A & B ) revenues
        foreach ($revenue as $value) {
            if(strtolower($value['country']) == "bangladesh" ){
                $total_revenue_bd += $value['revenue'];
            }else{
                $total_revenue_np += $value['revenue'];
            }
        }
        $total_revenue = $total_revenue_bd+$total_revenue_np;

        $tMart_already_have = ($this->MARKET_TOTAL_SELL_VALUE/100)*25;
        $restOfTheMarketShare = $this->MARKET_TOTAL_SELL_VALUE - $tMart_already_have;
        // dd($total_revenue_bd);

        $this->market_share = $total_revenue_bd*($restOfTheMarketShare/$this->MARKET_TOTAL_SELL_VALUE);

        $this->marketShareLabels = ["total","WalKart","T mart"];
        $this->marketShareValues = [$this->MARKET_TOTAL_SELL_VALUE,$this->market_share,$tMart_already_have];
        // $this->market_share = 5;
    }


    public function calculateRevenue()
    {
        $calculated_revenues = [];
        foreach ($this->total_revenue_array as $revenue) {

            $revenue_other = RevenueOther::where('revenue_id', $revenue['id'])->first();
            if (!is_null($revenue_other)) {
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
        foreach ($calculated_revenues as $calculated_revenue) {
            if ($calculated_revenue['country'] == "Bangladesh") {
                $this->bn_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            } elseif ($calculated_revenue['country'] == "Nepal") {
                $this->np_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }
        }
    }


    public function calculateCost()
    {
        foreach ($this->total_revenue_array as $cost) {
            if ($cost['country'] == "Bangladesh") {
                $this->bn_total_cost += $cost['product_cost'];
            } elseif ($cost['country'] == "Nepal") {
                $this->np_total_cost += $cost['product_cost'];
            }
        }
        //        dd($this->np_total_cost);
    }


    public $unitSalesLabel = [];
    public function calculateUnitSales()
    {
        //dd($this->calculated_unit_sales);
        $marketPlace = "";
        foreach ($this->calculated_unit_sales as $unit_sale) {
            if ($unit_sale['country'] == "Bangladesh") {
                $marketPlace = "Bn";
                $this->bn_unit_sales[] = $unit_sale['unit_m1'];
                $this->bn_unit_sales[] = $unit_sale['unit_m2'];

                $this->unitSalesLabel[] = $unit_sale['product']."M1";
                $this->unitSalesLabel[] = $unit_sale['product']."M2";

            } elseif ($unit_sale['country'] == "Nepal") {
                $marketPlace = "Np";
                $this->np_unit_sales[] = $unit_sale['unit_m1'];
                $this->np_unit_sales[] = $unit_sale['unit_m2'];
            }

        }

        $this->bn_unit_sales = collect($this->bn_unit_sales)->implode(',');
        $this->np_unit_sales = collect($this->np_unit_sales)->implode(',');
        $this->unitSalesLabel = json_encode($this->unitSalesLabel);
        //dd($this->unitSalesLabel);

        //dd($this->np_unit_sales);
    }


    public function calculateNetIncome()
    {
        $finansial_statements = FinancialStatement::where('user_id', $this->user_id)
            ->where('game_id', $this->game_id)->first();
        // dd($finansial_statements);
        if (!is_null($finansial_statements)) {
            $this->net_income = $finansial_statements->total_revenue - $finansial_statements->total_expanses;

        }


    }


    public $price_arr;
    public $compt_arr;

    public $price_bd;
    public $compt_bd;
    public $price_np;
    public $compt_np;

    public function calculatePriceVsCompetition()
    {
        //        dd($this->total_revenue_array);

        $price_bd_arr = [];
        $compt_bd_arr = [];
        $price_np_arr = [];
        $compt_np_arr = [];

        foreach ($this->total_revenue_array as $item) {
            $item = (object)$item;
            $this->total_price += $item->price;
            $this->total_competitor_price += $item->competitor;

            $this->pricelabel[] = (($item->country == 'Bangladesh') ? 'Bn' : 'Np') . '_' . $item->product;
            if($item->country == 'Bangladesh'){
                $price_bd_arr[] = $item->price;
                $compt_bd_arr[] = $item->competitor;
            }else{
                $price_np_arr[] = $item->price;
                $compt_np_arr[] = $item->competitor;
            }
            $this->price[] = $item->price;
            $this->competitor[] = $item->competitor;
        }


        $this->price_arr = $this->price;
        $this->compt_arr = $this->competitor;
        // dd($this->compt_arr[1]);
        $this->price = collect($this->price)->implode(',');
        // dd($this->price);
        $this->competitor = collect($this->competitor)->implode(',');
        //$this->pricelabel = collect($this->pricelabel)->implode(',');
        $this->pricelabel = json_encode($this->pricelabel);

        //dd($this->pricelabel);

        $this->price_bd = collect($price_bd_arr)->implode(',');
        $this->compt_bd = collect($compt_bd_arr)->implode(',');
        $this->price_np = collect($price_np_arr)->implode(',');
        $this->compt_np = collect($compt_np_arr)->implode(',');

    }


}
