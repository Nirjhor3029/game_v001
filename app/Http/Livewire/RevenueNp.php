<?php

namespace App\Http\Livewire;

use App\Models\Game\Budget;
use App\Models\Game\Marketplace;
use App\Models\Product;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RevenueNp extends Component
{

    public $np_a_productCost ;
    public $np_a_opex ;
    public $np_a_totalCost ;
    public $np_a_competitorsPrice ;
    public $np_a_markup ;
    public $np_a_price ;
    public $np_a_unitSold ;
    public $np_a_revenue ;

    public $np_b_productCost;
    public $np_b_opex;
    public $np_b_totalCost;
    public $np_b_competitorsPrice;
    public $np_b_markup;
    public $np_b_price;
    public $np_b_unitSold;
    public $np_b_revenue;

    public $userId;
    public $gameId;

    public $bn_marketPlace;
    public $np_marketPlace;

    public $bn_product_a;
    public $bn_product_b;

    public $np_product_a;
    public $np_product_b;

    public $previousUrl = "/revenue";
    public $nextUrl = "/revenue-other";
  

    // code for check null/empty value and show error message
    public $check_null = 1;
    public function updated($propertyName)
    {
        if($this->$propertyName == ""){
            $this->check_null = 0;
        }else{
            $this->check_null = 1;
        }
    }

    public function mount(){
        $this->userId = Auth::guard('web')->user()->id;
        $this->gameId = Session::get("game_id");
        $this->bn_marketPlace=1;
        $this->np_marketPlace=2;

        if($this->check_null){
            //set all fi filled data
            $this->setAllFields();
        }
    }

    public function render()
    {
        if($this->check_null){
            $this->calculateData();
            $this->updateDB();
        }
        
        return view('livewire.revenue-np');
    }


    public function updateDB(){
        $products = Product::all();
        $marketPlaces = Marketplace::all();
        $manufacturing = 0;

        foreach($marketPlaces as $marketPlace){
            if($marketPlace->id == $this->np_marketPlace){
                //echo $marketPlace->name;
                foreach($products as $product){
                    $revenue = \App\Models\Revenue::where('product_id',$product->id)
                        ->where('user_id',$this->userId)
                        ->where('game_id',$this->gameId)
                        ->where('market_place_id',$marketPlace->id)
                        ->first();
                    //dd($this->gameId);
                    if(is_null($revenue)){
                        $revenue = new \App\Models\Revenue();
                        //dd("ache");
                    }
                    $revenue->product_id = $product->id;
                    $revenue->market_place_id = $marketPlace->id;

                    $revenue->user_id = $this->userId;
                    $revenue->game_id = $this->gameId;

                    if(strtolower($marketPlace->name) == "nepal"){
                        //echo "nepal";
                        //dd("nepal");
                        if(strtolower($product->name) == "a"){
                            $revenue->product_cost = $this->np_a_productCost;
                            $revenue->opex = $this->np_a_opex;
                            $revenue->total_cost = $this->np_a_totalCost;
                            $revenue->competitors_price = $this->np_a_competitorsPrice;
                            $revenue->mark_up = $this->np_a_markup;
                            $revenue->price = $this->np_a_price;
                            $revenue->unit_sold = $this->np_a_unitSold;
                            $revenue->revenue = $this->np_a_revenue;
                        }elseif(strtolower($product->name) == "b"){
                            $revenue->product_cost = $this->np_b_productCost;
                            $revenue->opex = $this->np_b_opex;
                            $revenue->total_cost = $this->np_b_totalCost;
                            $revenue->competitors_price = $this->np_b_competitorsPrice;
                            $revenue->mark_up = $this->np_b_markup;
                            $revenue->price = $this->np_b_price;
                            $revenue->unit_sold = $this->np_b_unitSold;
                            $revenue->revenue = $this->np_b_revenue;
                        }
                    }
                    $revenue->save();
                    $manufacturing += $revenue->product_cost;
                }
            }

        }
        $this->setManufacturingOfBudget( $manufacturing , $this->np_marketPlace );

    }


    public function setAllFields(){
        $products = Product::all();
        $marketPlaces = Marketplace::all();

        foreach($marketPlaces as $marketPlace){
            if($marketPlace->id == 2){
                foreach($products as $product){
                    $revenue = \App\Models\Revenue::where('product_id',$product->id)
                        ->where('user_id',$this->userId)
                        ->where('game_id',$this->gameId)
                        ->where('market_place_id',$marketPlace->id)
                        ->first();

                        $budget = Budget::where('user_id',$this->userId)
                        ->where('game_id',$this->gameId)
                        ->where('marketplace_id',$marketPlace->id)
                        ->first();
                        $total_budget = $budget->recruitment+$budget->manufacturing+$budget->launch+$budget->other;

                    if(is_null($revenue)){
                        $revenue = new \App\Models\Revenue();

                        $revenue->product_id = $product->id;
                        $revenue->market_place_id = $marketPlace->id;

                        $revenue->user_id = $this->userId;
                        $revenue->game_id = $this->gameId;

                       



                        if(strtolower($marketPlace->name) == "nepal"){

                            if(strtolower($product->name) == "a"){
                                $this->np_a_opex = $total_budget;
                                $this->np_a_markup=0;

                            }elseif(strtolower($product->name) == "b"){
                                $this->np_b_opex = $total_budget;
                                $this->np_b_markup=0;

                            }
                        }

                    }else{
        //                    dd($revenue);

                        if(strtolower($marketPlace->name) == "nepal"){

                            if(strtolower($product->name) == "a"){
                                $this->np_a_productCost=$revenue->product_cost;
                                $this->np_a_opex=$total_budget;
                                $this->np_a_totalCost=$revenue->total_cost;
                                $this->np_a_competitorsPrice=$revenue->competitors_price;
                                $this->np_a_markup=$revenue->mark_up;
                                $this->np_a_price=$revenue->price ;
                                $this->np_a_unitSold=$revenue->unit_sold;
                                $this->np_a_revenue=$revenue->revenue;
                            }elseif(strtolower($product->name) == "b"){
                                $this->np_b_productCost=$revenue->product_cost;
                                $this->np_b_opex=$total_budget;
                                $this->np_b_totalCost=$revenue->total_cost;
                                $this->np_b_competitorsPrice=$revenue->competitors_price;
                                $this->np_b_markup=$revenue->mark_up;
                                $this->np_b_price=$revenue->price;
                                $this->np_b_unitSold=$revenue->unit_sold;
                                $this->np_b_revenue=$revenue->revenue;
                            }
                        }

                    }
                    $revenue->save();
                }
            }

        }

    }


    public function calculateData(){
        
        $this->np_a_totalCost = ceil($this->np_a_productCost+$this->np_a_opex);
        $this->np_b_totalCost = ceil($this->np_b_productCost+$this->np_b_opex);

        $this->np_a_price = $this->round2($this->np_a_totalCost + (($this->np_a_totalCost*$this->np_a_markup)/100));
        $this->np_b_price = $this->round2($this->np_b_totalCost + (($this->np_b_totalCost*$this->np_b_markup)/100));

        $this->np_a_revenue = ceil($this->np_a_price * $this->np_a_unitSold);
        $this->np_b_revenue = ceil($this->round2($this->np_b_price * $this->np_b_unitSold));
    }
    public function round2($value)
    {
        return round($value,2);
    }


    public function setManufacturingOfBudget($manufacturing , $np_marketPlaceId)
    {
        $budgets_for_np = Budget::where('user_id',$this->userId)->where('game_id',$this->gameId)->where('marketplace_id',$np_marketPlaceId)->first();

        $budgets_for_np->manufacturing = $manufacturing;
        $budgets_for_np->save();
    }
}
