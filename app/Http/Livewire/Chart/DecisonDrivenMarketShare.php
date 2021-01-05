<?php

namespace App\Http\Livewire\Chart;

use App\Models\Game\Marketplace;
use App\Models\Product;
use App\Models\Revenue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DecisonDrivenMarketShare extends Component
{
    public $red;
    public $yellow;
    public $blue;

    public $user_id;
    public $game_id;
    public $bangladesh_id;
    public $nepal_id;

    public $market_share;


    public $nextUrl = "https://www.google.com/";
    public $previousUrl = "";

//

//    market share
    public $MARKET_TOTAL_SELL_VALUE = 2000;

    public function mount(){
        $this->red = 20;
        $this->yellow = 20;
        $this->blue = 10;

        $this->user_id = Auth::user()->id;
        $this->game_id = Session::get('game_id');

        $this->bangladesh_id = Marketplace::where('name','Bangladesh')->first()->id;
        $this->nepal_id = Marketplace::where('name','Nepal')->first()->id;

        $market_places = Marketplace::all();
        $products = Product::all();

        $revenue = [];
        foreach($market_places as $market_place){

            foreach($products as $product){
                $revenue[] = [
                    "country" => $market_place->name,
                    "product" => $product->name,
                    "revenue" => Revenue::where('user_id',$this->user_id)
                        ->where('game_id',$this->game_id)
                        ->where('market_place_id',$market_place->id)
                        ->where('product_id',$product->id)->first()->revenue,
                ];

            }
        }

        $total_revenue = 0  ;

        // Bangladesh & Nepal ( Product A & B ) revenues
        foreach($revenue as $value){
            $total_revenue += $value['revenue'];
        }
        $this->market_share = $total_revenue/$this->MARKET_TOTAL_SELL_VALUE;

        $this->market_share = 5;




    }

    public function update()
    {
        $this->red += 50;
        $this->yellow = 10;
        $this->blue = 10;
    }

    public function render()
    {
        $this->red += 2;
        return view('livewire.chart.decison-driven-market-share');
    }
}
