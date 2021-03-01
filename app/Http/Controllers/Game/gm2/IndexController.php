<?php

namespace App\Http\Controllers\Game\gm2;

use App\Http\Controllers\Controller;
use App\Models\Admin\Navbar;
use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\Restaurant;
use Auth;
use Config;
use DB;
use Illuminate\Http\Request;
use Session;

class IndexController extends Controller
{
    public function index()
    {
        return view('game_views.gm2.layout.app');
    }

    public function strategic_group()
    {
        return view('game_views.gm2.strategic_group');
    }

    public function marketing_strategy()
    {
        return view('game_views.gm2.marketing_strategy');
    }

    public function development_of_strategic_group()
    {
        return view('game_views.gm2.development_of_strategic_group');
    }

    public function game()
    {
        $restaurants = \App\Models\Restaurant::get();
        $graphItem = GraphItem::where(['user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();
        $records = DB::table('graphs')
            ->join('restaurants', 'graphs.rest_id', '=', 'restaurants.id')
            ->select('graphs.id as graph_id', 'graphs.rest_id as restaurant_id', 'restaurants.name', 'graphs.graph_point')
            ->where('graph_item_id', $graphItem->id)
            ->get();
        $added_restaurant = $records->pluck('restaurant_id')->all();

        $gType = Config::get('game.game2.options');

        return view('game_views.gm2.demo', compact('restaurants', 'records', 'gType', 'added_restaurant'));
    }
}
