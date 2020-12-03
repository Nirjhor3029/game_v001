<?php

namespace App\Http\Livewire;

use App\Models\Game\Marketplace;
use App\Models\Product;
use App\Models\Revenue;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RevenueOther extends Component
{

    public $userId;
    public $gameId;

    public $bn_marketPlace;
    public $np_marketPlace;

    public $bn_product_a;
    public $bn_product_b;

    public $np_product_a;
    public $np_product_b;


    public $bn_AM1;
    public $bn_AM1_revenue;
    public $bn_AM2;
    public $bn_AM2_revenue;

    public $bn_BM1;
    public $bn_BM1_revenue;
    public $bn_BM2;
    public $bn_BM2_revenue;

    public $np_AM1;
    public $np_AM1_revenue;
    public $np_AM2;
    public $np_AM2_revenue;

    public $np_BM1;
    public $np_BM1_revenue;
    public $np_BM2;
    public $np_BM2_revenue;


    /****************** for chart *******************/
    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

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
    /****************** for chart *******************/

    public function updateDB(){


        $products = Product::all();
        $marketPlaces = Marketplace::all();

        foreach($marketPlaces as $marketPlace) {
            foreach ($products as $product) {

                $revenue = Revenue::where('product_id',$product->id)
                    ->where('user_id',$this->userId)
                    ->where('game_id',$this->gameId)
                    ->where('market_place_id',$marketPlace->id)
                    ->first();

                $revenue_other = \App\Models\Game\RevenueOther::where('revenue_id',$revenue->id)->first();
                if(is_null($revenue_other)){
                    $revenue_other = new \App\Models\Game\RevenueOther();
                    $revenue_other->revenue_id = $revenue->id;
                    //dd("achi");
                }

                if(strtolower($marketPlace->name) == "bangladesh"){
                    //dd("bangladesh");
                    if(strtolower($product->name) == "a"){
                        $revenue_other->month1_price =  $this->bn_AM1;
                        $revenue_other->month1_revenue = $this->bn_AM1_revenue;
                        $revenue_other->month2_price = $this->bn_AM2;

                        $this->bn_AM2_revenue = $revenue->price * $this->bn_AM2 ;

                        $revenue_other->month2_revenue = $this->bn_AM2_revenue;
                    }elseif(strtolower($product->name) == "b"){
                        $revenue_other->month1_price =  $this->bn_BM1;
                        $revenue_other->month1_revenue = $this->bn_BM1_revenue;
                        $revenue_other->month2_price = $this->bn_BM2;

                        $this->bn_BM2_revenue = $revenue->price * $this->bn_BM2 ;

                        $revenue_other->month2_revenue = $this->bn_BM2_revenue;
                    }

                }elseif(strtolower($marketPlace->name) == "nepal"){
                    if(strtolower($product->name) == "a"){
                        $revenue_other->month1_price =  $this->np_AM1;
                        $revenue_other->month1_revenue = $this->np_AM1_revenue;
                        $revenue_other->month2_price = $this->np_AM2;

                        $this->np_AM2_revenue = $revenue->price * $this->np_AM2;

                        $revenue_other->month2_revenue = $this->np_AM2_revenue;
                    }elseif(strtolower($product->name) == "b"){
                        $revenue_other->month1_price =  $this->np_BM1;
                        $revenue_other->month1_revenue = $this->np_BM1_revenue;
                        $revenue_other->month2_price = $this->np_BM2;

                        $this->np_BM2_revenue = $revenue->price * $this->np_BM2 ;

                        $revenue_other->month2_revenue = $this->np_BM2_revenue;
                    }
                }
                $revenue_other->save();
            }
        }
    }

    public function setAllFields(){
        $products = Product::all();
        $marketPlaces = Marketplace::all();

        foreach($marketPlaces as $marketPlace) {
            foreach ($products as $product) {
                $revenue = Revenue::where('product_id',$product->id)
                    ->where('user_id',$this->userId)
                    ->where('game_id',$this->gameId)
                    ->where('market_place_id',$marketPlace->id)
                    ->first();

                $revenue_other = \App\Models\Game\RevenueOther::where('revenue_id',$revenue->id)->first();
                if(is_null($revenue_other)){
                    $revenue_other = new \App\Models\Game\RevenueOther();
                    $revenue_other->revenue_id = $revenue->id;
                    //$revenue_other->

                    if(strtolower($marketPlace->name) == "bangladesh"){
                        //dd("bangladesh");
                        if(strtolower($product->name) == "a"){
                            $this->bn_AM1_revenue = $revenue->revenue;

                        }elseif(strtolower($product->name) == "b"){
                            $this->bn_BM1_revenue = $revenue->revenue;
                        }

                    }elseif(strtolower($marketPlace->name) == "nepal"){

                        if(strtolower($product->name) == "a"){
                            $this->np_AM1_revenue = $revenue->revenue;

                        }elseif(strtolower($product->name) == "b"){
                            $this->np_BM1_revenue = $revenue->revenue;

                        }
                    }
                }else{
                    if(strtolower($marketPlace->name) == "bangladesh"){
                        //dd("bangladesh");
                        if(strtolower($product->name) == "a"){
                            $this->bn_AM1_revenue = $revenue_other->month1_revenue;
                            $this->bn_AM2 = $revenue_other->month2_price;
                            $this->bn_AM2_revenue = $revenue_other->month2_revenue;

                        }elseif(strtolower($product->name) == "b"){
                            $this->bn_BM1_revenue = $revenue_other->month1_revenue;
                            $this->bn_BM2 = $revenue_other->month2_price;
                            $this->bn_BM2_revenue = $revenue_other->month2_revenue;
                        }

                    }elseif(strtolower($marketPlace->name) == "nepal"){

                        if(strtolower($product->name) == "a"){
                            $this->np_AM1_revenue = $revenue_other->month1_revenue;
                            $this->np_AM2 = $revenue_other->month2_price;
                            $this->np_AM2_revenue = $revenue_other->month2_revenue;
                        }elseif(strtolower($product->name) == "b"){
                            $this->np_BM1_revenue = $revenue_other->month1_revenue;
                            $this->np_BM2 = $revenue_other->month2_price;
                            $this->np_BM2_revenue = $revenue_other->month2_revenue;
                        }
                    }
                }


                $revenue_other->save();
            }
        }

    }


    public function mount(){
        $this->userId = Auth::guard('web')->user()->id;
        $this->gameId = Session::get("game_id");

        $this->bn_marketPlace=1;
        $this->np_marketPlace=2;

        $this->setAllFields();

    }

    public function render()
    {

        $this->updateDB();

        $product_1  =  (new ColumnChartModel())
        ->setTitle('Bangladesh')
        ->addColumn('AM1',$this->bn_AM1_revenue,'#00B050')
        ->addColumn('BM1',$this->bn_BM1_revenue,'#FF0000')
        ->addColumn('','0','#90cdf4')
        ->addColumn('AM2',$this->bn_AM2_revenue,'#00B050')
        ->addColumn('BM2',$this->bn_BM2_revenue,'#FF0000')
        ->setAnimated($this->firstRun)
        ->withOnColumnClickEventName('onColumnClick');

        $product_2  =  (new ColumnChartModel())
        ->setTitle('Nepal')
        ->addColumn('AM1',$this->np_AM1_revenue,'#00B050')
        ->addColumn('BM1',$this->np_BM1_revenue,'#FF0000')
        ->addColumn('','0','#90cdf4')
        ->addColumn('AM2',$this->np_AM2_revenue,'#00B050')
        ->addColumn('BM2',$this->np_BM2_revenue,'#FF0000')
        ->setAnimated($this->firstRun)
        ->withOnColumnClickEventName('onColumnClick');

        return view('livewire.revenue-other',compact('product_1','product_2'));
    }
}
