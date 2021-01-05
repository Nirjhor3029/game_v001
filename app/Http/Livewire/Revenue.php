<?php

namespace App\Http\Livewire;
use App\Models\Game\Budget;
use App\Models\Game\Marketplace;
use App\Models\Product;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Revenue extends Component
{


    
    public $bn_a_productCost;
    public $bn_a_opex;
    public $bn_a_totalCost;
    public $bn_a_competitorsPrice;
    public $bn_a_markup;
    public $bn_a_price;
    
    public $bn_a_unitSold ;
    public $bn_a_revenue ;

    public $bn_b_productCost ;
    public $bn_b_opex ;
    public $bn_b_totalCost ;
    public $bn_b_competitorsPrice ;
    public $bn_b_markup ;
    public $bn_b_price ;
    public $bn_b_unitSold ;
    public $bn_b_revenue ;


    public $userId;
    public $gameId;

    public $bn_marketPlace;
    public $np_marketPlace;

    public $bn_product_a;
    public $bn_product_b;

    public $np_product_a;
    public $np_product_b;

    public $previousUrl = "/budgeting";
    public $nextUrl = "/revenue-np";

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

        //set all fi filled data
        if($this->check_null){
            $this->setAllFields();
        }
    }

    public function render(){
        if($this->check_null){
            $this->calculateData();
            $this->updateDB();
        }
        
        return view('livewire.revenue');
    }



    public function updateDB(){
        $products = Product::all();
        $marketPlaces = Marketplace::all();
        $manufacturing = 0;

        foreach($marketPlaces as $marketPlace){
            //echo $marketPlace->name;
            
            if($marketPlace->id == $this->bn_marketPlace){
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

                    if(strtolower($marketPlace->name) == "bangladesh"){
                        //dd("bangladesh");
                        if(strtolower($product->name) == "a"){
                            $revenue->product_cost = $this->bn_a_productCost;
                            $revenue->opex = $this->bn_a_opex;
                            $revenue->total_cost = $this->bn_a_totalCost;
                            $revenue->competitors_price = $this->bn_a_competitorsPrice;
                            $revenue->mark_up = $this->bn_a_markup;
                            $revenue->price = $this->bn_a_price;
                            $revenue->unit_sold = $this->bn_a_unitSold;
                            $revenue->revenue = $this->bn_a_revenue;


                        }elseif(strtolower($product->name) == "b"){
                            $revenue->product_cost = $this->bn_b_productCost;
                            $revenue->opex = $this->bn_b_opex;
                            $revenue->total_cost = $this->bn_b_totalCost;
                            $revenue->competitors_price = $this->bn_b_competitorsPrice;
                            $revenue->mark_up = $this->bn_b_markup;
                            $revenue->price = $this->bn_b_price;
                            $revenue->unit_sold = $this->bn_b_unitSold;
                            $revenue->revenue = $this->bn_b_revenue;
                        }

                    }
                    $revenue->save();
                    $manufacturing += $revenue->product_cost;
                }
            }

        }
        $this->setManufacturingOfBudget( $manufacturing , $this->bn_marketPlace ); 

    }


    public function setAllFields(){
        $products = Product::all();
        $marketPlaces = Marketplace::all();

        foreach($marketPlaces as $marketPlace){
            if($marketPlace->id == 1){
                $budget = Budget::where('user_id',$this->userId)
                            ->where('game_id',$this->gameId)
                            ->where('marketplace_id',$marketPlace->id)
                            ->first();

                $total_budget = $budget->recruitment+$budget->manufacturing+$budget->launch+$budget->other;
                
                foreach($products as $product){

                    $revenue = \App\Models\Revenue::where('product_id',$product->id)
                        ->where('user_id',$this->userId)
                        ->where('game_id',$this->gameId)
                        ->where('market_place_id',$marketPlace->id)
                        ->first();
                        // dd($revenue);

                    if(is_null($revenue)){
                        // dd("if");
                        $revenue = new \App\Models\Revenue();

                        $revenue->product_id = $product->id;
                        $revenue->market_place_id = $marketPlace->id;

                        $revenue->user_id = $this->userId;
                        $revenue->game_id = $this->gameId;

                        


                        if(strtolower($marketPlace->name) == "bangladesh"){
                            if(strtolower($product->name) == "a"){
                                $this->bn_a_opex = $total_budget;
                                $this->bn_a_markup=0;

                            }elseif(strtolower($product->name) == "b"){
                                $this->bn_b_opex = $total_budget;
                                $this->bn_b_markup=0;

                            }

                        }

                    }else{
                        // dd("else");

                        if(strtolower($marketPlace->name) == "bangladesh"){
                            if(strtolower($product->name) == "a"){
                                $this->bn_a_productCost = $revenue->product_cost;
                                $this->bn_a_opex = $total_budget;
                                $this->bn_a_totalCost = $revenue->total_cost;
                                $this->bn_a_competitorsPrice =$revenue->competitors_price ;
                                $this->bn_a_markup = $revenue->mark_up;
                                $this->bn_a_price = $revenue->price;
                                $this->bn_a_unitSold = $revenue->unit_sold;
                                $this->bn_a_revenue = $revenue->revenue;
                                // dd("ok");
                            }elseif(strtolower($product->name) == "b"){
                                $this->bn_b_productCost = $revenue->product_cost;
                                $this->bn_b_opex = $total_budget;
                                $this->bn_b_totalCost = $revenue->total_cost;
                                $this->bn_b_competitorsPrice = $revenue->competitors_price;
                                $this->bn_b_markup = $revenue->mark_up ;
                                $this->bn_b_price = $revenue->price;
                                $this->bn_b_unitSold = $revenue->unit_sold;
                                $this->bn_b_revenue = $revenue->revenue;
                            }

                        }

                    }


                    $revenue->save();


                }
            }

        }

    }



    public function calculateData(){
        $this->bn_a_totalCost = ceil($this->bn_a_productCost+$this->bn_a_opex);
        $this->bn_b_totalCost = ceil($this->bn_b_productCost+$this->bn_b_opex);

        $this->bn_a_price = round(($this->bn_a_totalCost + (($this->bn_a_totalCost*$this->bn_a_markup)/100)),2);
        $this->bn_b_price = round(($this->bn_b_totalCost + (($this->bn_b_totalCost*$this->bn_b_markup)/100)),2);
        
        $this->bn_a_revenue = ceil(round(($this->bn_a_price*$this->bn_a_unitSold),2));
        $this->bn_b_revenue = ceil(round(($this->bn_b_price * $this->bn_b_unitSold),2));
        
    }

    

    public function setManufacturingOfBudget($manufacturing , $bn_marketPlaceId)
    {
        $budgets_for_bn = Budget::where('user_id',$this->userId)->where('game_id',$this->gameId)->where('marketplace_id',$bn_marketPlaceId)->first();

        $budgets_for_bn->manufacturing = $manufacturing;
        $budgets_for_bn->save();
    }

}
