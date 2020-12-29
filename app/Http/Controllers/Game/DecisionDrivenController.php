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

    public function __construct()
    {
//        $this->user_id = Auth::user()->id;
//        $this->game_id = Session::get('game_id');
    }

    //Ajax request method
    function updateRevenueChart(int $marketPlace, int $product, $month)
    {
        $market_value = $marketPlace === 1 ? 'Bangladesh' : ($marketPlace === 2 ? 'Nepal' : '');
        $product_value = $product == 1 ? 'A' : ($marketPlace == 2 ? 'B' : '');


        $calculated_revenues = collect($this->calculateRevenueWithMonth());
        $data_values = $calculated_revenues->filter(function ($val, $key) use ($market_value) {
            return $val['country'] == $market_value;
        });

        $data_array = [];
        foreach ($data_values as $data_value) {
            $data_array['keys'][] = $data_value['product'];
            $data_array['values'][] = $data_value['revenue_m1'] + $data_value['revenue_m2'];
        }

        $total_revenue = [
            "values" => $data_array['values'],
            "labels" => $data_array['keys'],
            "chart_label" => '',
        ];

        return response()->json(['data' => $total_revenue]);

    }

    function updateCostChart()
    {


        $values = [];
        $labels = [];

        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "cost",
        ];

        return response()->json(['data' => $total_revenue]);
    }

    function updateUnitSalesChart()
    {


        $values = [];
        $labels = [];
        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "Unit sales",
        ];

        return response()->json(['data' => $total_revenue]);
    }

    function updatePricingCompetitionChart()
    {

        $values = [];
        $labels = [];

        $total_revenue = [
            "values" => $values,
            "labels" => $labels,
            "chart_label" => "price Vs Comp",
        ];

        return response()->json(['data' => $total_revenue]);
    }
}
