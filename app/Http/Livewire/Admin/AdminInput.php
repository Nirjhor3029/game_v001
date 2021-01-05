<?php

namespace App\Http\Livewire\Admin;

use App\Models\Game\FinancialStatement;
use App\Models\Game\Marketplace;
use App\Models\Game\ResultProcess;
use App\Models\Game\RevenueOther;
use App\Models\Product;
use App\Models\Revenue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Traits\RevenueTraits;

class AdminInput extends Component
{

    use RevenueTraits;
    public $MARKET_TOTAL_SELL_VALUE = 2000;
    // Process ids
    public $process_id=[
        1,2,3,4,5,6
    ];


    public $market_share_assigned_value=10;
    public $market_share_actual_value = 2;  //come from actual market share
    public $market_share_point_value;
    public $market_share_mark_value;


    public $revenue_assigned_value=1;
    public $revenue_actual_value = 2;  //come from actual revenue share
    public $revenue_point_value;
    public $revenue_mark_value;


    public $cost_assigned_value=1;
    public $cost_actual_value = 2;  //come from actual cost share
    public $cost_point_value;
    public $cost_mark_value;

    public $usic_assigned_value=1;
    public $usic_actual_value = 2;  //come from actual usic share
    public $usic_point_value;
    public $usic_mark_value;


    public $net_profit_assigned_value=1;
    public $net_profit_actual_value = 2;  //come from actual net_profit share
    public $net_profit_point_value;
    public $net_profit_mark_value;


    public $cm_price_assigned_value=1;
    public $cm_price_actual_value = 2;  //come from actual cm_price share
    public $cm_price_point_value;
    public $cm_price_mark_value;

    public  $total_revenue_array;

    public $calculated_unit_sales;

    public $userId;
    public  $gameId;

    public function round2($value)
    {
        return round($value,2);
    }

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
    public function mount()
    {
        if($this->check_null){
            $this->setField();
            //dd($this->calculateRevenueArray());
            $this->market_share_actual_value = $this->round2($this->calculateMarketShare());
            $this->revenue_actual_value = $this->round2($this->calculateRevenue());
            $this->cost_actual_value = $this->round2($this->calculateCost());
            $this->usic_actual_value = $this->round2($this->calculateUnitSales());
            $this->net_profit_actual_value = $this->round2($this->calculateNetIncome());
            $this->cm_price_actual_value = $this->round2($this->calculatePriceVsCompetition());
        }
    }

    public function render()
    {
        if($this->check_null){
            $this->CalculateAllMainField();
            $this->updateDb();
        }

        return view('livewire.admin.admin-input');
    }





    function setField(){
        $this->userId = Auth::guard('web')->user()->id;
        $this->gameId = Session::get("game_id");

        $process_subname = ["market_share","revenue","cost","usic","net_profit","cm_price"];

        foreach($process_subname as $key => $single_subname){

            $result_process = ResultProcess::where('user_id',$this->userId)->where('game_id',$this->gameId)->
            where('process_id',$key+1)->first();
            if(!is_null($result_process)){
                $this->{$single_subname."_assigned_value"} = $result_process->assigned_value;
                $this->{$single_subname."_actual_value"} = $result_process->actual_value;
                $this->{$single_subname."_point_value"} = $result_process->point_value;
                $this->{$single_subname."_mark_value"} = $this->round2($result_process->mark_value);
            }
        }
    }

    public function updateDb()
    {
        $this->userId = Auth::guard('web')->user()->id;
        $this->gameId = Session::get("game_id");

        $process_subname = ["market_share","revenue","cost","usic","net_profit","cm_price"];

        foreach($process_subname as $key => $single_subname){

            $result_process = ResultProcess::where('user_id',$this->userId)->where('game_id',$this->gameId)->
            where('process_id',$key+1)->first();
            if(is_null($result_process)){
                $result_process = new ResultProcess();
            }
            $result_process->user_id=$this->userId;
            $result_process->game_id=$this->gameId;
            $result_process->process_id = $key+1;
            $result_process->assigned_value=$this->{$single_subname."_assigned_value"};
            $result_process->actual_value=$this->{$single_subname."_actual_value"};
            $result_process->point_value=$this->{$single_subname."_point_value"};
            $result_process->mark_value=$this->{$single_subname."_mark_value"};
            $result_process->save();
        }

    }

    public function CalculateAllMainField()
    {
        $this->market_share_mark_value = round($this->checkMarkValue($this->market_share_point_value , ($this->market_share_actual_value/$this->market_share_assigned_value)*$this->market_share_point_value),2);


        $this->revenue_mark_value = round($this->checkMarkValue($this->revenue_point_value , ($this->revenue_actual_value/$this->revenue_assigned_value)*$this->revenue_point_value),2);

        $this->cost_mark_value = round($this->checkMarkValue($this->cost_point_value , ($this->cost_actual_value/$this->cost_assigned_value)*$this->cost_point_value),2);

        $this->usic_mark_value = round($this->checkMarkValue($this->usic_point_value , ($this->usic_actual_value/$this->usic_assigned_value)*$this->usic_point_value),2);

        $this->net_profit_mark_value = round($this->checkMarkValue($this->net_profit_point_value , ($this->net_profit_actual_value/$this->net_profit_assigned_value)*$this->net_profit_point_value),2);

        // $this->cm_price_mark_value = round($this->checkMarkValue($this->cm_price_point_value , ($this->cm_price_actual_value/$this->cm_price_assigned_value)*$this->cm_price_point_value),2);
    }

    public function checkMarkValue($pointValue,$markValue)
    {
        if($markValue > $pointValue){
            return $pointValue;
        }else{
            return $markValue;
        }
    }




    public function calculateMarketShare(){

        $revenue = $this->calculateRevenueArray();
        $this->total_revenue_array = $revenue;
        $total_revenue = 0  ;

        // Bangladesh & Nepal ( Product A & B ) revenues
        foreach($revenue as $value){
            $total_revenue += $value['revenue'];
        }
        return $market_share = $total_revenue/$this->MARKET_TOTAL_SELL_VALUE;

        //return $market_share = 5;
    }


    public function calculateRevenue()
    {

        $calculated_revenues = [];
        $bn_total_revenue =0;
        $np_total_revenue=0;

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


            $this->calculated_unit_sales = $calculated_revenues;

        }



        foreach($calculated_revenues as $calculated_revenue){
            if($calculated_revenue['country']=="Bangladesh"){
                $bn_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }elseif($calculated_revenue['country']=="Nepal"){
                $np_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }
        }
        return $total_revenue = $bn_total_revenue + $np_total_revenue;
    }



    public function calculateCost()
    {
        $bn_total_cost =0;
        $np_total_cost=0;
        foreach($this->total_revenue_array as $cost){
            if($cost['country']=="Bangladesh"){
                $bn_total_cost += $cost['product_cost'];
            }elseif($cost['country']=="Nepal"){
                $np_total_cost += $cost['product_cost'] ;
            }
        }
        return $total_cost = $bn_total_cost+$np_total_cost;

    }


    public function calculateUnitSales()
    {
       // dd($this->calculated_unit_sales);
        $unitSales =0;
        foreach($this->calculated_unit_sales as $unit_sale){
            $unitSales += ($unit_sale['unit_m1']+$unit_sale['unit_m2']);
        }
        return $unitSales;

    }

    public function calculateNetIncome()
    {
        $net_income=0;
        $finansial_statements = FinancialStatement::where('user_id',$this->user_id)
            ->where('game_id',$this->game_id)->first();
        // dd($finansial_statements);
        if(!is_null($finansial_statements)){
            return $net_income = $finansial_statements->total_revenue - $finansial_statements->total_expanses;
        }

        return $net_income;


    }

    public function calculatePriceVsCompetition()
    {
        $total_competitor_price=0;
        $total_price=0;

        foreach($this->total_revenue_array as $item){

            $item = (object) $item;
            $total_price += $item->price;
            $total_competitor_price += $item->competitor;


        }

        return $total_priceVsCompetitorsPrice = $total_price+$total_competitor_price;

    }
}
