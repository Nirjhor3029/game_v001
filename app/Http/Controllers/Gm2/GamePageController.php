<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;

use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\Cost;
use App\Models\Gm2MarketPromotion;
use App\Models\GraphLevel;
use App\Models\Market;
use App\Models\Restaurant;
use App\Models\RestaurantGroup;
use App\Models\RestaurantPoint;
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
        
        // return $restaurant;

        $resGroup = RestaurantPoint::where('res_id',optional($resturentUser)->restaurant_id)->with('restaurant','restaurantGroup')->first();

        $investment = config('game.game2.asset.invest');

        
        $restaurantGroups = RestaurantGroup::whereNotIn('id',[optional($resGroup)->res_group_id])->get();

// dd($restaurantGroups);
// return $resGroup->restaurant->name;

        

    if(isset($resGroup)){
        $userInfo = [
            "student_id"=> Auth::user()->id,
            "assigned_res_id"=> $resGroup->restaurant->id,
            "assigned_group_id"=> $resGroup->restaurantGroup->id,
        ];
        session(["student_info"=>$userInfo]);
        // $session = Session::all();
        // return $session;
        return view("game_views.gm2.market_scenario_2", compact('typeArea', 'typeQuantity', 'resGroup','restaurantGroups','investment'));
    }else{
        return view("game_views.gm2.market_scenario_1");
    }
        


        
    }

    public function market_scenario_defend()
    {
        $user_id = Auth::user()->id;

        $student_info = session('student_info');
        $assigned_res_id = $student_info['assigned_res_id'];
        $assigned_group_id = $student_info['assigned_group_id'];

        $resUser = RestaurantUser::where('rest_group_id',$assigned_group_id)->get();
        if($resUser->isEmpty()){
            return view("game_views.gm2.market_scenario_defend_empty");
        }
        $res_ids = $resUser->pluck('restaurant_id')->all();
        // return $res_ids;
        

        $attackMarkets = Market::whereIn('restaurant_id',$res_ids)
        ->with('restaurant')
        ->with('marketCost.gm2MarketPromotion', function ($query) {
            $query->where('mode','=','1');
        })
        ->get();

        $defendMarket = Market::where(['user_id'=>$user_id,'restaurant_id'=>$assigned_res_id])->with('marketCost','restaurant')->first();

        $defendMarketPromotions= null;
        $defendMarketPromotions = Gm2MarketPromotion::where('market_cost_id',optional($defendMarket)->marketCost[0]->id)->where('mode',2)->get();
        // return ($defendCost->marketCost[0]->competitors_move);
        // return ($attackMarkets[0]->marketCost[0]->gm2MarketPromotion[0]->value);

        // return $defendMarketPromotions;
        // return $defendMarket;

        $promotions = config('game.game2.promotion_options');
        return view("game_views.gm2.market_scenario_defend", compact('attackMarkets','defendMarket','promotions','defendMarketPromotions'));
    }

    public function show_users_graph()
    {
        $user_id = Auth::user()->id;
        $teacher_id = RestaurantUser::where('user_id',$user_id)->select('teacher_id')->first();
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
        $rest_groups = RestaurantGroup::where('user_id', $teacher_id->teacher_id)->get();
        $graph_level = GraphLevel::where('user_id', $teacher_id->teacher_id)->get()->first();
        // return $teacher_id->teacher_id;
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
