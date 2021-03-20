<?php

namespace App\Http\Controllers\Game\gm2;

use App\Http\Controllers\Controller;
use App\Models\Admin\Navbar;
use App\Models\AttackDefend;
use App\Models\CriteriaCombination;
use App\Models\Gm2MarketPromotion;
use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\GraphLevel;
use App\Models\Market;
use App\Models\Restaurant;
use App\Models\RestaurantGroup;
use App\Models\RestaurantPoint;
use App\Models\RestaurantUser;
use App\Models\User;
use Auth;
use Barryvdh\Reflection\DocBlock\Type\Collection;
use Config;
use DB;
use Illuminate\Http\Request;
use Redirect;
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
        $user_id = Auth::user()->id;
        $session_id = Session::getId();
        $resturentUser = RestaurantUser::where('user_id', $user_id)->first();
        $resGroup = RestaurantPoint::where('res_id', optional($resturentUser)->restaurant_id)->with('restaurant', 'restaurantGroup')->first();
        if (isset($resGroup)) {
            $userInfo = [
                "student_id" => $user_id,
                "assigned_res_id" => $resGroup->restaurant->id,
                "assigned_group_id" => $resGroup->restaurantGroup->id,
            ];
            session(["student_info" => $userInfo]);
            // $session = Session::all();
            // return $session;
            return view('game_views.gm2.marketing_strategy');
        } else {
            return view("game_views.gm2.market_scenario_1");
        }
    }

    public function development_of_strategic_group()
    {
        return view('game_views.gm2.development_of_strategic_group');
    }

    public function game()
    {
        $user_id = Auth::user()->id;
        // get all restaurant
        $restaurants = \App\Models\Restaurant::get();


        // Start Game
        $user_id = Auth::user()->id;
        $session_id = Session::getId();
        $resturentUser = RestaurantUser::where('user_id', $user_id)->first();
        $resGroup = RestaurantPoint::where('res_id', optional($resturentUser)->restaurant_id)->with('restaurant', 'restaurantGroup')->first();
        // return [$resturentUser, $resGroup];
        if (isset($resGroup)) {
            $userInfo = [
                "student_id" => $user_id,
                "assigned_res_id" => $resGroup->restaurant->id,
                "assigned_group_id" => $resGroup->restaurantGroup->id,
            ];
            session(["student_info" => $userInfo]);
            // $session = Session::all();
            // return $session;
            // return view('game_views.gm2.marketing_strategy');
        } else {
            return view("game_views.gm2.market_scenario_1");
        }
        // Start Game


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
            ->where('level', '1')
            ->get();

        $added_restaurant = [];
        // get restaurant id & name
        if (!is_null($records)) {
            $added_restaurant = $records->pluck('restaurant_id')->all();
        }
        // get x-axis & y-axis option from config file
        $gType = Config::get('game.game2.options');

        $graphLevel = GraphLevel::where('user_id', $user_id)->first();

        return view('game_views.gm2.game', compact('restaurants', 'records', 'gType', 'added_restaurant', 'graphLevel'));
    }

    public function game_view()
    {
        $restaurant_group = RestaurantGroup::where('user_id', Auth::guard('web')->user()->id)->findOrFail();
    }

    public function criteria_combination()
    {
        $gType = Config::get('game.game2.options');

        $user_id = Auth::id();
        $combinations = CriteriaCombination::where('user_id', $user_id)->get();
        // return $combinations[0];

        return view('game_views.gm2.admin.criteria_combination', compact('gType', 'combinations'));
    }

    public function criteria_combination_post(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        // return $request;
        // get point values & check null
        $point_values = $request->point_value;
        $points_value = array_map(function ($item) {
            return is_null($item) ? 0 : (int)$item;
        }, $point_values);
        // separate x_axis & y_axis form point ex:1_2
        $points = $request->point;
        $axis_points = array_map(function ($item) {
            return explode('_', $item);
        }, $points);

        $combinations = CriteriaCombination::where('user_id', $user_id);
        if ($combinations->get()->isEmpty()) {
            $msg = 'Criteria value set successfuly !';
        } else {
            $msg = 'Criteria value update successfuly !';
        }
        $combinations->delete();
        foreach ($axis_points as $key => $axis_point) {
            CriteriaCombination::create([
                'user_id' => $user_id,
                'x_axis' => $axis_point[0],
                'y_axis' => $axis_point[1],
                'point' => $points_value[$key],
            ]);
        }
        $request->session()->flash('alert-success', $msg);
        return redirect()->back();
        // return redirect()->route("teacher.criteria_combination");
    }

    public function setGroup()
    {
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $user_id = Auth::user()->id;
        $restaurantGroups = RestaurantGroup::where('user_id', $user_id)
            ->with('restaurantPoint', function ($query) {
                $query->where('leader', 1)->with('restaurant');
            })
            ->get();
        $graphLevel = GraphLevel::where('user_id', $user_id)->first();
        // return $restaurantGroups[0]->restaurantPoint[0]->restaurant->name;

        return view('game_views.gm2.admin.set_group', compact('gType', 'restaurants', 'restaurantGroups', 'graphLevel'));
    }

    public function setGroup2()
    {
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $user_id = Auth::user()->id;
        $restaurantGroups = RestaurantGroup::where('user_id', $user_id)
            ->with('restaurantPoint', function ($query) {
                $query->where('leader', 1)->with('restaurant');
            })->orderBy('id', 'desc')
            ->get();
        $points_array = $restaurantGroups->pluck('points');//->toJson();
        // return $points_array;
        // return $restaurantGroups;
        $graphLevel = GraphLevel::where('user_id', $user_id)->first();
        // return $restaurantGroups[0]->restaurantPoint[0]->restaurant->name;
        return view('game_views.gm2.admin.set_group2', compact('gType', 'restaurants', 'restaurantGroups', 'graphLevel', 'points_array'));
    }

    public function setRestaurant()
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $restaurantGroups = RestaurantGroup::where('user_id', $user_id)->get();

        return view('game_views.gm2.admin.set_restaurant', compact('gType', 'restaurants', 'restaurantGroups'));
    }

    public function setRestaurant2()
    {
        $user_id = Auth::user()->id; //teacher own
        $restaurants = Restaurant::all();
        $gType = Config::get('game.game2.options');
        $restaurantGroups = RestaurantGroup::where('user_id', $user_id)->with('restaurantPoint', 'restaurantPoint.restaurant')->get();

        $addedRestaurants = $restaurantGroups->pluck('restaurantPoint')->collapse()->pluck('res_id');
        $addedRestaurants = $addedRestaurants->toArray();
        // $addedRestaurant = $addedRestaurant[0]->pluck('res_id');
        // return $addedRestaurants;

        $graph_level = GraphLevel::where('user_id', $user_id)->get()->first();
        $empty = false;
        if (is_null($graph_level)) {
            $empty = true;
            $msg = "Need to set the criteria of graph";
        } else {
            $msg = "";
        }

        // get x-axis & y-axis option from config file
        $level_options = Config::get('game.game2.options');
        //        return  (!$empty);

        return view('gm2.teacher_graph', compact('graph_level', 'level_options', 'restaurants', 'restaurantGroups', 'empty', 'addedRestaurants', 'msg'));
    }

    public function assignStudent()
    {

        $students = User::where('type', 3)->with('restaurantUser')->get();
        // return $students[0]->restaurantUser[0]->restaurant_id;

        $restaurantPoints = RestaurantPoint::with(['restaurant', 'restaurantGroup'])->where('leader', 1)->get();
        $restaurantUsers = RestaurantUser::all();

        // return $restaurantPoints;

        $restaurants = [];
        foreach ($restaurantPoints as $key => $item) {
            $restaurants[] = [
                "res_id" => $item->res_id,
                "res_name" => $item->restaurant->name,
                "group_id" => $item->res_group_id,
                "group_name" => $item->restaurantGroup->name,
            ];
        }

        return view('game_views.gm2.admin.assign_student', compact('students', 'restaurants', 'restaurantUsers'));
    }

    // Running
    public function assignStudentNew()
    {
        $user_id = Auth::user()->id;

        $students = User::where('type', 3)->with('restaurantUser')->get();
        //  return $students;

        $groupStudents = [];
        foreach ($students as $student) {
            if ($student->restaurantUser->isNotEmpty()) {
                $rest_id = $student->restaurantUser[0]->restaurant_id;
                $std_id = $student->restaurantUser[0]->user_id;
                $std_name = $student->name;
                $groupStudents[$rest_id][] = ['id' => $std_id, 'name' => $std_name];
            }

        }
        // return $groupStudents;


        $restaurantPoints = RestaurantPoint::with(['restaurant', 'restaurantGroup'])->where('leader', 1)->get();
        $restaurantUsers = RestaurantUser::all();


        // return $restaurantPoints;

        $restaurants = [];
        foreach ($restaurantPoints as $key => $item) {
            $restaurants[$item->res_id] = [
                "res_id" => $item->res_id,
                "res_name" => $item->restaurant->name,
                "group_id" => $item->res_group_id,
                "group_name" => $item->restaurantGroup->name,
            ];
        }

        // return [ $students,$restaurants,$restaurantUsers,$groupStudents];

        $restaurantGroups = RestaurantGroup::where("user_id", $user_id)
            ->with('restaurantPoint.restaurant.restaurantUser')->get();
        // $groupIds = $restaurantGroups->pluck('id');
        // return $restaurantGroups;

        $attacklists = $this->attackDefendSet();
        // return $attacklists;

        return view('game_views.gm2.admin.assign_student_new', compact('students', 'restaurants', 'restaurantUsers', 'groupStudents', 'attacklists'));
    }


    public function defendMarket(Request $request)
    {

        $session = Session('student_info');
        $defender_res_id = $session['assigned_res_id'];

        $mode = 2; //defend mode =2

        $attacker_res_id = $request->attacker_res_id;
        $attacker_res_ids = explode(",", $attacker_res_id);


        $promotionIds = $request->promotion_ids;

        $marketCostId = $request->market_cost_id;
        $previousPromotionCost = Gm2MarketPromotion::where(['market_cost_id' => $marketCostId, "mode" => $mode])->delete();

        foreach ($promotionIds as $key => $id) {
            $promotionCost = new Gm2MarketPromotion();
            $promotionCost->market_cost_id = $marketCostId;
            $promotionCost->promotion_id = $id;
            $promotionCost->value = $request->promotion_values[$key];
            $promotionCost->mode = $mode;
            $promotionCost->save();
        }

        $attackerResults = $this->defendActionCalculation($defender_res_id, $attacker_res_ids);

        foreach ($attackerResults as $key => $value) {
            $attack_defends = new AttackDefend();
            $attack_defends->attacker = $key;
            $attack_defends->defender = $defender_res_id;
            $attack_defends->score = $value;
            $attack_defends->save();
        }

        $request->session()->flash('alert-success', 'Defend Successful');
        return Redirect::back();
    }

    public function defendActionCalculation($defenderRestId, $attackerRestIds): array
    {
        $defenderDetails = Market::where('restaurant_id', $defenderRestId)->with('marketCost.gm2MarketPromotion', function ($query) {
            $query->where('mode', '=', '2');
        })->get();


        $attackerDetails = Market::whereIn('restaurant_id', $attackerRestIds)->with('marketCost.gm2MarketPromotion', function ($query) {
            $query->where('mode', '=', '1');
        })->get();

        $resultMarketCost = [];
        $defenderPromotion = $defenderDetails[0]->marketCost[0]->gm2MarketPromotion;

        foreach ($attackerDetails as $attacker) {
            $attackPromotions = $attacker->marketCost[0]->gm2MarketPromotion;
            foreach ($attackPromotions as $key => $item) {
                // return $item->market_cost_id;
                if ($item->promotion_id == $defenderPromotion[$key]->promotion_id) {
                    $resultMarketCost[$attacker->restaurant_id][$item->promotion_id] = ($item->value - $defenderPromotion[$key]->value);
                }
            }
        }
        // get option required amount form config file
        $promotion_options = config('game.game2.promotion_options');
        $requiredAmounts = array_column($promotion_options, "required_amount", 'id');

        return $this->get_percentages_array($resultMarketCost, $requiredAmounts);

        // dd ($resultMarketCost,$required_amounts);
    }


    function get_percentages_array(array $resultValues, $amounts): array
    {
        $result = [];
        $result_sum = [];
        foreach ($resultValues as $resId => $value) {
            foreach ($amounts as $key => $amount) {
                $result[] = round($value[$key] / $amount, 2);
            }
            $result_sum[$resId] = array_sum($result);
        }
        return ($result_sum);
    }


    public function result()
    {
        $session_student = session("student_info");
        $studentResId = $session_student["assigned_res_id"];

        $defender = AttackDefend::where('defender', $studentResId)->select('score')->get();
        $attacker = AttackDefend::where('attacker', $studentResId)->select('score')->first();

        $defenderSum = $defender->sum("score");
        // $attackSum = ( 1 - $defenderSum );
        // return $defenderSum;

        $taskOneResult = $this->get_task_one_result();
        $taskTwoResult = $this->get_task_two_result();
        // return $taskTwoResult['Correct'];

        return view("gm2.result", compact("defenderSum", "taskOneResult", "taskTwoResult"));
    }

    public function get_task_one_result()
    {

        $user_id = Auth::user()->id;
        // get X & Y level option value from graph level table
        $get_xy_level = GraphLevel::where('user_id', $user_id)->get()->first();
        $bag = [];
        if (!isset($get_xy_level)) {
            $bag = [
                'type' => 'error',
                'message' => 'You not set the level in graph'
            ];
        }

        //get level combination point value from criteria combination table assign by teacher id
        // set teacher id form session


        $restUser = RestaurantUser::where('user_id', $user_id)->first("teacher_id");
        // return $restUser;

        $results = CriteriaCombination::select(['x_axis', 'y_axis', 'point'])->where('user_id', $restUser->teacher_id)->get();
        // return $results;
        if ($results->isEmpty()) {
            return $bag = [
                'type' => 'error',
                'message' => 'Your coordinator not set the answer yet'
            ];
        }
        $point_value = $results->map(function ($item) use ($get_xy_level) {
            return (($get_xy_level->x_level == $item->x_axis && $get_xy_level->y_level == $item->y_axis) || ($get_xy_level->y_level == $item->x_axis && $get_xy_level->x_level == $item->y_axis)) ? $item->point : 0;
        })->sum();


        $result = get_percentage($point_value, 30);
        if (isset($point_value)) {
            $bag = [
                'type' => 'success',
                'message' => 'Your Task 1 result is  ' . $result,
            ];
        }
        return $data = [
            'result' => $result,
            'bag' => $bag
        ];
    }

    public function get_task_two_result()
    {
        // get authenticated user id
        $user_id = Auth::user()->id;
        $teacherId = RestaurantUser::where('user_id', $user_id)->first("teacher_id")->teacher_id;

        $resGroup = RestaurantGroup::where('user_id', $teacherId)->with('restaurantPoint')->get();
        // $resPoints = RestaurantPoint::where('user_id',$user_id)->with('restaurantGroup')->get();
        $bag = [];
        if (!isset($resGroup)) {
            $bag = [
                'type' => 'error',
                'message' => 'Teacher not set the score on level combination'
            ];
            return $bag;
        }
        $teacherAssignedResPoints = [];
        foreach ($resGroup as $singleGroup) {
            $teacherAssignedResPoints[] = [
                'point' => (int)$singleGroup->point,
                'rest_id' => $singleGroup->restaurantPoint->pluck('res_id')->toArray(),
            ];
        }
        // get student point value form graph & graph item table
        $student_id = $user_id;
        $graphItem = GraphItem::where('user_id', $student_id)->latest()->first();
        // return $graphItem;
        $graphs = Graph::where('graph_item_id', $graphItem->id)->where('level', 2)->get();
        if ($graphs->isEmpty()) {
            $bag = [
                'type' => 'error',
                'message' => 'First Play The Game !!!'
            ];
            return $bag;
        }
        $studentResPoints = [];
        $rest_ids = [];
        //get restaurant points with restaurant id of student..
        foreach ($graphs as $key => $singleResPoint) {
            $rest_ids[$singleResPoint->graph_point][] = $singleResPoint->rest_id;
            $studentResPoints[$singleResPoint->graph_point] = [
                'point' => $singleResPoint->graph_point,
                'rest_id' => $rest_ids[$singleResPoint->graph_point],
            ];
        }

        $dataSet = [];
        $count = [];
        foreach ($teacherAssignedResPoints as $key => $teacherGPoint) {
            $point = $teacherGPoint['point'];
            $teacherRestIds = $teacherGPoint['rest_id'];

            if (isset($studentResPoints[$point])) {
                $studentRestIds = $studentResPoints[$point]['rest_id'];
                $dataSet[$point] = array_map(function ($item) use ($studentRestIds) {
                    return (in_array($item, $studentRestIds)) ? "Correct" : "Wrong";
                }, $teacherRestIds);
            } else {
                return "student put restaurant into wrong boxes.";
            }

            $count[$point] = array_count_values($dataSet[$point]);
        }
        $correct = array_sum(array_column($count, "Correct"));
        $wrong = array_sum(array_column($count, "Wrong"));

        return $result = [
            'Correct' => $correct,
            'Wrong' => $wrong,
            'DataSet' => $count,
        ];
    }

    // teacher Login thakte hobe...
    public function attackDefendSet()
    {
        $bag = [];
        $teacherId = Auth::user()->id;
        $students = RestaurantUser::where('teacher_id', $teacherId)->with('restaurant')
            ->with('restaurantGroup')
            ->with('restaurantGroup.restaurantPoint', function ($query) {
                $query->where('leader', 1)->with('restaurant');
            })
            ->get();

        $std = $students->map(function ($item, $key) {
            return [
                "student_id" => $item->user_id,
                "assigned_rest_id" => $item->restaurant_id,
                "assigned_rest_name" => $item->restaurant->name,
                "attacking_rest_id" => $item->restaurantGroup->restaurantPoint[0]->res_id,
                "attacking_rest_name" => $item->restaurantGroup->restaurantPoint[0]->restaurant->name,
            ];
        });
        return $std;
        $attackerRestIds = $std->pluck("attacking_rest_id", "student_id")->all();
        $assignRestIds = $std->pluck("assigned_rest_id", "student_id")->all();
        //return ["assign:" => $assignRestIds, "attacker :" => $attackerRestIds ];

        $leaders = RestaurantGroup::where('user_id', $teacherId)
            ->with('restaurantPoint', function ($query) {
                $query->where('leader', 1)->with('restaurant');
            })
            ->get();

        $leaderData = $leaders->map(function ($item, $key) {
            return [
                "rest_id" => $item->restaurantPoint[0]->res_id,
                "rest_name" => $item->restaurantPoint[0]->restaurant->name,
            ];
        });

        $ownId = [];
        foreach ($std as $student) {
            $a_s_i = $student['assigned_rest_id'];
            if (in_array($a_s_i, $attackerRestIds)) {
                $ids = $this->attackerBag($a_s_i, $attackerRestIds, $assignRestIds);

                //$asStdId = array_search($a_s_i,$attackerRestIds);
                //$asResId = $assignRestIds[$asStdId]?? null;
                // echo($assignRestIds[$asStdId].','. $asStdId.'-');

            } else {
                $ids = null;
            }
            $ownId[] = [
                'defender' => $student['student_id'],
                'attacker' => $ids
            ];

        }
        return $ownId;
        //return [$std,$leaderData];
    }

    public function attackerBag($ownRestId, &$attackerRestIds, $assignRestIds, $max = 1): array
    {
        // get same restaurant ids attacker user ids
        $allAttackers = array_keys($attackerRestIds, $ownRestId);

        $attackLists = [];
        $assignLists = [];
        $count = 0;
        if (!empty($allAttackers)) {
            foreach ($allAttackers as $attacker) {
                if (in_array($assignRestIds[$attacker], $assignLists)) {
                    continue;
                } else {
                    $count++;
                    $attackLists[] = $attacker;
                    $assignLists[] = $assignRestIds[$attacker] ?? null;
                    unset($attackerRestIds[$attacker]);
                    if ($count == $max) break;
                }
            }
        }
        // return attacker user ids array
        return $attackLists;
    }
}
