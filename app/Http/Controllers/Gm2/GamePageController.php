<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;
use App\Models\AttackDefend;
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

        $resturentUser = RestaurantUser::where('user_id', $user_id)->first();
        if (is_null($resturentUser)) {
            return view("game_views.gm2.market_scenario_1");
        }

        // return $resturentUser;

        $resGroup = RestaurantPoint::where('res_id', optional($resturentUser)->restaurant_id)->with('restaurant', 'restaurantGroup')->first();
        // return $resGroup;

        $investment = config('game.game2.asset.invest');


        $restaurantGroups = RestaurantGroup::where("user_id", $resturentUser->teacher_id)->whereNotIn('id', [optional($resGroup)->res_group_id])->get();

        $promotion_options = config('game.game2.promotion_options');

        // return $restaurantGroups;
        // return $resGroup->restaurant->name;
        // return $resGroup->restaurant;
        $market = Market::where('user_id', $user_id,)
            ->with('marketCost')
            ->with('marketCost.gm2MarketPromotion', function ($query) {
                $query->where('mode', '=', '1');
            })
            ->first();
        //        return  $market;
        //        $market = (object)$market;
        //            return $market->marketCost;
        //        dd($market);
        //        if(is_null($market)){
        //            return "null";
        //        }


        if (isset($resGroup)) {
            $userInfo = [
                "student_id" => $user_id,
                "assigned_res_id" => $resGroup->restaurant->id,
                "assigned_group_id" => $resGroup->restaurantGroup->id,
            ];
            session(["student_info" => $userInfo]);
            // $session = Session::all();
            // return $session;
            return view("game_views.gm2.market_scenario_2", compact('typeArea', 'typeQuantity', 'resGroup', 'restaurantGroups', 'investment', 'market', 'promotion_options', 'resturentUser'));
        } else {
            return view("game_views.gm2.market_scenario_1");
        }
    }

    public function market_scenario_defend()
    {
        $user_id = Auth::user()->id;

        $student_info = session('student_info');
        $assigned_res_id = $student_info['assigned_res_id'];
        $assigned_group_id = $student_info['assigned_group_id'];

        $resUser = RestaurantUser::where('rest_group_id', $assigned_group_id)->get();
        // return $resUser;
        if ($resUser->isEmpty()) {
            $msg = "Till Now No One Attack Your market place";
            return view("game_views.gm2.market_scenario_defend_empty", compact("msg"));
        }
        $res_ids = $resUser->pluck('restaurant_id')->all();
        // return $res_ids;


        $attackMarkets = Market::whereIn('restaurant_id', $res_ids)
            ->with('restaurant')
            ->with('marketCost.gm2MarketPromotion', function ($query) {
                $query->where('mode', '=', '1');
            })
            ->get();
        // return $attackMarkets;

        $attackers = [];
        $attackersRests = [];
        foreach ($attackMarkets as $key => $attacker) {
            $attackersRests[] = [
                'id' => $attacker->restaurant->id,
                'name' => $attacker->restaurant->name,
            ];
            foreach ($attacker->marketCost[0]->gm2MarketPromotion as $promotion) {
                $attackers[$key][] = [
                    "promotion_id" => $promotion->promotion_id,
                    "value" => $promotion->value,
                ];
            }
        }

        $attackersRestIds = implode(",", array_column($attackersRests, "id"));


        // return $attackersRests[0]['name'];

        $defendMarket = null;
        $defendMarketPromotions = null;

        $defendMarket = Market::where(['user_id' => $user_id, 'restaurant_id' => $assigned_res_id])->with('marketCost', 'restaurant')->first();
        if (is_null($defendMarket)) {
            $msg = "You need to Attack someone first !!";
            return view("game_views.gm2.market_scenario_defend_empty", compact("msg"));
        }
        $defendMarketPromotions = Gm2MarketPromotion::where('market_cost_id', optional($defendMarket)->marketCost[0]->id)->where('mode', 2)->get();

        //        dd( $defendMarket);
        //         return $defendMarketPromotions;
        // return ($attackMarkets[0]->marketCost[0]->gm2MarketPromotion[0]->value);

        // return $defendMarketPromotions;
        // return $defendMarket;
        $promotions = config('game.game2.promotion_options');
        return view("game_views.gm2.market_scenario_defend", compact('attackMarkets', 'defendMarket', 'promotions', 'defendMarketPromotions', 'attackers', 'attackersRestIds', 'attackersRests'));
    }

    public function market_scenario_defend_new()
    {

        $user_id = Auth::user()->id;
        $msg = "";

        $student_info = session('student_info');
        // return $student_info;
        if (is_null($student_info)) {
            $msg = "Start The Game Kindly... from home page!";
            return view("game_views.gm2.market_scenario_1", compact('msg'));
        }
        $assigned_res_id = $student_info['assigned_res_id'];
        $assigned_group_id = $student_info['assigned_group_id'];

        $attackers = AttackDefend::where('defender', $user_id)->select('attacker')->get();
        // return [$attackers,$user_id];
        if ($attackers->isNotEmpty()) {
            $attackers_userId = $attackers->pluck('attacker')->toArray();
            // return $attackers;
        } else {
            // return "Wait Till Teacher's Approval. ";
            $msg = "Wait Till Teacher's Approval.  !!";
            return view("game_views.gm2.market_scenario_defend_empty", compact("msg"));
        }
        // return $attackers;

        // $resUser = RestaurantUser::where('rest_group_id', $assigned_group_id)->get();
        // return $resUser;
        // if ($resUser->isEmpty()) {
        //     $msg = "Till Now No One Attack Your market place";
        //     return view("game_views.gm2.market_scenario_defend_empty", compact("msg"));
        // }
        // $res_ids = $resUser->pluck('restaurant_id')->all();
        // return $res_ids;


        $attackMarkets = Market::whereIn('user_id', $attackers_userId)
            ->with('restaurant')
            ->with('marketCost.gm2MarketPromotion', function ($query) {
                $query->where('mode', '=', '1');
            })
            ->get();
        // return $attackMarkets;

        $attackers = [];
        $attackersRests = [];
        foreach ($attackMarkets as $key => $attacker) {
            $attackersRests[] = [
                'id' => $attacker->restaurant->id,
                'name' => $attacker->restaurant->name,
            ];
            foreach ($attacker->marketCost[0]->gm2MarketPromotion as $promotion) {
                $attackers[$key][] = [
                    "promotion_id" => $promotion->promotion_id,
                    "value" => $promotion->value,
                ];
            }
        }
        // return $attackersRests;

        $attackersRestIds = implode(",", array_column($attackersRests, "id"));
        $attackers_userId = implode(",", $attackers_userId);


        // return $attackersRests[0]['name'];

        $defendMarket = null;
        $defendMarketPromotions = null;

        $defendMarket = Market::where(['user_id' => $user_id, 'restaurant_id' => $assigned_res_id])->with('marketCost', 'restaurant')->first();
        if (is_null($defendMarket)) {
            $msg = "You need to Attack someone first !!";
            return view("game_views.gm2.market_scenario_defend_empty", compact("msg"));
        }
        $defendMarketPromotions = Gm2MarketPromotion::where('market_cost_id', optional($defendMarket)->marketCost[0]->id)->where('mode', 2)->get();

        //    dd( $defendMarket);
        //         return $defendMarketPromotions;
        // return ($attackMarkets[0]->marketCost[0]->gm2MarketPromotion[0]->value);

        // return $defendMarketPromotions;
        // return $defendMarket;
        $promotions = config('game.game2.promotion_options');
        return view("game_views.gm2.market_scenario_defend", compact('attackMarkets', 'defendMarket', 'promotions', 'defendMarketPromotions', 'attackers', 'attackersRestIds', 'attackersRests', 'attackers_userId'));
    }


    public function show_users_graph()
    {
        $user_id = Auth::user()->id;
        // get all restaurant
        $restaurants = \App\Models\Restaurant::get();

        $teacher_id = RestaurantUser::where('user_id', $user_id)->select('teacher_id')->first();
        // check graph item set on this user
        if (!isset($teacher_id)) {
            return view('gm2.users_graph_empty', compact("restaurants"));
        }
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

        $addedRestaurants = $records->pluck('restaurant_id')->all();

        $rest_groups = RestaurantGroup::where('user_id', $teacher_id->teacher_id)->get();
        $graph_level = GraphLevel::where('user_id', $teacher_id->teacher_id)->get()->first();
        // return $teacher_id->teacher_id;

        // get x-axis & y-axis option from config file
        $level_options = Config::get('game.game2.options');

        return view('gm2.users_graph', compact('rest_groups', 'graph_level', 'level_options', 'restaurants', 'records', 'addedRestaurants'));
    }


    // Game page
    public function addGraph(Request $request)
    {
        $this->set_graph_point($request, 1);
        return response()->json(['success' => 'Restaurant position set successfully !']);
    }


    // users_graph page
    public function add_users_graph(Request $request)
    {
        // set restaurant in graph on task 2
        $this->set_graph_point($request, 2);
        return response()->json(['success' => 'Restaurant position set successfully !']);
    }

    public function set_graph_point($request, $level = 1)
    {
        if ($request->ajax()) {
            $restArray = [];

            $graphItem = GraphItem::where('user_id', Auth::guard('web')->user()->id)->latest('id')->first();
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
            Graph::where(['graph_item_id' => $graphItem->id, 'graph_point' => $graph_point, 'level' => $level])->delete();
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

    public function example_of_strategic_group()
    {
        return view('game_views.gm2.example_of_strategic_group');
    }


    // Helper function
    function get_percentage($value, $percent)
    {
        if ($value > 0) {
            return round($percent * ($value / 100), 2);
        } else {
            return 0;
        }
    }
}
