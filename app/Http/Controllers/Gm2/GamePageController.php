<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;

use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\Cost;
use App\Models\GraphLevel;
use App\Models\Restaurant;
use App\Models\RestaurantGroup;
use App\Models\RestaurantUser;
use Config;
use DB;
use Illuminate\Http\Request;
use Auth;
use Session;

class GamePageController extends Controller
{
    public function overview()
    {
        $nav = null;
        return view('gm2.overview')->with('nav', $nav);
    }

    public function addGraph(Request $request)
    {
        $this->set_graph_point($request, 1);

    }

    public function market_scenario_2()
    {
        $user_id = Auth::user()->id;
        $session_id = Session::getId();
        $typeArea = Cost::where('parent_id', 0)->whereType(1)->get();
        $typeQuantity = Cost::where('parent_id', 0)->whereType(2)->get();

        // $graphItem = GraphItem::where('user_id', $user_id)
        //     ->where('session_id', $session_id)
        //     ->first();

        // $graphs = Graph::where('graph_item_id', $graphItem->id)->get();
        // return $graphs;

        $resturentUser = RestaurantUser::where('user_id',$user_id)->first();
        $restaurant = Restaurant::where('id',optional($resturentUser)->restaurant_id)->get();
        // return $restaurant;

        $restaurantGroups = RestaurantGroup::all();


        return view("game_views.gm2.market_scenario_2", compact('typeArea', 'typeQuantity', 'restaurant','restaurantGroups'));
    }

    public function market_scenario_defend()
    {
        $user_id = Auth::user()->id;
        $typeArea = Cost::where('parent_id', 0)->whereType(1)->get();
        $typeQuantity = Cost::where('parent_id', 0)->whereType(2)->get();
        $graphItems = Graph::all();

        $restaurantUser = RestaurantUser::where('user_id',$user_id)->first();
        $restaurant = Restaurant::find(optional($restaurantUser)->restaurant_id);
        // return $restaurant;
        // return $costs;
        return view("game_views.gm2.market_scenario_defend", compact('typeArea', 'typeQuantity', 'graphItems'));
    }

    public function show_users_graph()
    {
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
            ->where('level', '2')
            ->get();
        $rest_groups = RestaurantGroup::where('user_id', Auth::user()->id)->get();
        $graph_level = GraphLevel::where('user_id', Auth::user()->id)->get()->first();
        // get all restaurant
        $restaurants = \App\Models\Restaurant::get();
        // get x-axis & y-axis option from config file
        $level_options = Config::get('game.game2.options');

        return view('gm2.users_graph', compact('rest_groups', 'graph_level', 'level_options', 'restaurants','records'));
    }

    public function add_users_graph(Request $request)
    {
        // set restaurant in graph on task 2
        $this->set_graph_point($request, 2);

    }

    public function set_graph_point($request,$level = 1)
    {
        if ($request->ajax()) {
            $restArray = [];
            $graphItem = GraphItem::where(['user_id' => Auth::guard('web')->user()->id, 'session_id' => Session::getId()])->get()->first();
            if (is_null($graphItem)) {
                $graphItem = new GraphItem();
                $graphItem->user_id = Auth::guard('web')->user()->id;
                $graphItem->session_id = Session::getId();
                $graphItem->save();
            }
            $restArray['graphPointRow'] = $request->input('graphPointRow') + 1;
            $restArray['graphPointColumn'] = $request->input('graphPointColumn') + 1;
            $graph_point = $restArray['graphPointRow'] . $restArray['graphPointColumn'];
            //remove old graph data
            Graph::where(['graph_point' => $graphItem->id, 'graph_point' => $graph_point,'level' => $level])->delete();
            if ($request->filled('restData')) {
                foreach ($request->restData as $items) {
                    //add new items
                    $graph = new Graph();
                    $graph->graph_item_id = $graphItem->id;
                    $graph->rest_id = $items['restId'];
                    $graph->graph_point = $restArray['graphPointRow'] . $restArray['graphPointColumn'];
                    $graph->level = $level;
                    $graph->save();
                }
            }
        }
    }
}
