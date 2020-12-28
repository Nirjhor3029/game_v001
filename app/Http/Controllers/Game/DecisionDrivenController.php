<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game\Marketplace;
use App\Traits\RevenueTraits;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecisionDrivenController extends Controller
{
    use RevenueTraits;

//    public $user_id;
//    public $game_id;

    public function __construct(){
//        $this->user_id = Auth::user()->id;
//        $this->game_id = Session::get('game_id');
    }
    //Ajax request method
    function updateRevenueChart($marketPlace,$product,$month){

//        $r = [ $this->calculateRevenueArray(),$this->calculateRevenueWithMonth()];dd( $r );
//        dd( $r );

        $calculated_revenues = $this->calculateRevenueWithMonth();

        $bn_total_revenue = 0;
        $np_total_revenue = 0;


        $bn_A_total_revenue = 0;
        $bn_B_total_revenue = 0;
        $np_A_total_revenue = 0;
        $np_B_total_revenue = 0;

        $bn_AM1_total_revenue = 0;
        $bn_BM1_total_revenue = 0;
        $bn_AM2_total_revenue = 0;
        $bn_BM2_total_revenue = 0;
        $np_AM1_total_revenue = 0;
        $np_BM1_total_revenue = 0;
        $np_AM2_total_revenue = 0;
        $np_BM2_total_revenue = 0;



        $values = [];
        $labels = [];

        foreach ($calculated_revenues as $calculated_revenue) {
            if ($calculated_revenue['country'] == "Bangladesh") {
                if($calculated_revenue['product'] == "A"){
                    $bn_A_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
                    $bn_AM1_total_revenue += $calculated_revenue['revenue_m1'];
                    $bn_AM2_total_revenue += $calculated_revenue['revenue_m2'];
                }else{
                    $bn_B_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
                    $bn_BM1_total_revenue += $calculated_revenue['revenue_m1'];
                    $bn_BM2_total_revenue += $calculated_revenue['revenue_m2'];
                }
                $bn_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            } elseif ($calculated_revenue['country'] == "Nepal") {
                if($calculated_revenue['product'] == "A"){
                    $np_A_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
                    $np_AM1_total_revenue += $calculated_revenue['revenue_m1'];
                    $np_AM2_total_revenue += $calculated_revenue['revenue_m2'];
                }else{
                    $np_B_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
                    $np_BM1_total_revenue += $calculated_revenue['revenue_m1'];
                    $np_BM2_total_revenue += $calculated_revenue['revenue_m2'];
                }
                $np_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }
        }


        $marketPlace_name = Marketplace::find($marketPlace)->name;
//        return $marketPlace_name;

        if(!$marketPlace && !$product && !$month){

        }elseif(!$marketPlace && !$month){

        }elseif(!$product && !$month){

        }elseif(!$marketPlace){
            $values = [$bn_total_revenue,$np_total_revenue];
            $labels = ["bangladesh","Np"];
        }elseif(!$month){

        }elseif(!$product){

        }else{

            $values = [$bn_total_revenue,$np_total_revenue];
            $labels = ["bangladesh","Np"];
        }

        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => $marketPlace_name,
        ];

        return response()->json(['data'=> $total_revenue]);

    }
    function updateCostChart(){


        $values = [];
        $labels = [];

        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "cost",
        ];

        return response()->json(['data'=> $total_revenue]);
    }
    function updateUnitSalesChart(){


        $values = [];
        $labels = [];
        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "Unit sales",
        ];

        return response()->json(['data'=> $total_revenue]);
    }
    function updatePricingCompetitionChart(){

        $values = [];
        $labels = [];

        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "price Vs Comp",
        ];

        return response()->json(['data'=> $total_revenue]);
    }
}
