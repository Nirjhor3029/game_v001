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
        // get all restaurant
        $restaurants = \App\Models\Restaurant::get();
        // check graph item set on this user
        $graphItem = GraphItem::where(['user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();
        if (is_null($graphItem)) {
            $graphItem = new GraphItem();
            $graphItem->user_id = Auth::guard('web')->user()->id;
            $graphItem->session_id = Session::getId();
            $graphItem->save();
        }
        // old restaurant item get form graph table
        $records = DB::table('graphs')
            ->join('restaurants', 'graphs.rest_id', '=', 'restaurants.id')
            ->select('graphs.id as graph_id', 'graphs.rest_id as restaurant_id', 'restaurants.name', 'graphs.graph_point')
            ->where('graph_item_id', $graphItem->id)
            ->get();

        $added_restaurant = [];
        // get restaurant id & name
        if(!is_null($records)){
            $added_restaurant = $records->pluck('restaurant_id')->all();
        }
        // set x-axis & y-axis option from config file
        $gType = Config::get('game.game2.options');

        return view('game_views.gm2.demo', compact('restaurants', 'records', 'gType', 'added_restaurant'));
    }

    public function critaria_combination()
    {
        $gType = Config::get('game.game2.options');
        return view('game_views.gm2.admin.critaria_combination',compact('gType'));
    }
    public function critaria_combination_post(Request $request)
    {
        return $request;
    }

    public function setGroup()
    {
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');
        return view('game_views.gm2.admin.set_group',compact('gType','restaurants'));
    }
}
