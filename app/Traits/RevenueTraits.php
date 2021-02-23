<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 12/13/2020
 * Time: 1:19 PM
 */
namespace app\Traits;

use App\Models\Game\Marketplace;
use App\Models\Game\RevenueOther;
use App\Models\Product;
use App\Models\Revenue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait RevenueTraits{

    public $total_revenue_array;

    public $user_id;
    public $game_id;
    public $bangladesh_id;
    public $nepal_id;





    public function calculateRevenueArray()
    {
        $this->user_id = Auth::user()->id;

        $this->game_id = Session::get('game_id');

        $this->bangladesh_id = Marketplace::where('name','Bangladesh')->first()->id;
        $this->nepal_id = Marketplace::where('name','Nepal')->first()->id;

        $market_places = Marketplace::all();
        $products = Product::all();

        $revenue = [];
        foreach($market_places as $market_place){

            foreach($products as $product){
                $revenue_row = Revenue::where('user_id',$this->user_id)
                    ->where('game_id',$this->game_id)
                    ->where('market_place_id',$market_place->id)
                    ->where('product_id',$product->id)->first();

                if(!is_null($revenue_row)){
                    $revenue[] = [
                        "id" => $revenue_row->id,
                        "country" => $market_place->name,
                        "product" => $product->name,
                        "revenue" => $revenue_row->revenue,
                        "product_cost" => $revenue_row->product_cost,
                        "price" => $revenue_row->price,
                        "competitor" => $revenue_row->competitors_price

                    ];
                }


                $this->total_revenue_array = $revenue;

            }
        }

        $this->total_revenue_array = $revenue;

       return $this->total_revenue_array;
    }

    public function calculateRevenueWithMonth()
    {
        $calculateRevenueWithMonth = [];
        $total_revenue_array = $this->calculateRevenueArray();
        foreach ($total_revenue_array as $revenue) {

            $revenue_other = RevenueOther::where('revenue_id', $revenue['id'])->first();
            if (!is_null($revenue_other)) {
                $calculateRevenueWithMonth[] = [
                    "id" => $revenue['id'],
                    "country" => $revenue['country'],
                    "product" => $revenue['product'],
                    "unit_m1" => $revenue_other->month1_unit,
                    "revenue_m1" => $revenue['revenue'],
                    "unit_m2" => $revenue_other->month2_unit,
                    "revenue_m2" => $revenue_other->month2_revenue,
                    "total" => ''
                ];
            }
        }
        return $calculateRevenueWithMonth;

        $this->calculated_unit_sales = $calculateRevenueWithMonth;
        //        dd($calculated_revenues);
        foreach ($calculateRevenueWithMonth as $calculated_revenue) {
            if ($calculated_revenue['country'] == "Bangladesh") {
                $this->bn_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            } elseif ($calculated_revenue['country'] == "Nepal") {
                $this->np_total_revenue += ($calculated_revenue['revenue_m1'] + $calculated_revenue['revenue_m2']);
            }
        }
    }
}
