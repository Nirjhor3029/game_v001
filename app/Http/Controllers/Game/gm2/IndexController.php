<?php

namespace App\Http\Controllers\Game\gm2;

use App\Http\Controllers\Controller;
use App\Models\Admin\Navbar;
use App\Models\CriteriaCombination;
use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\GraphLevel;
use App\Models\Restaurant;
use App\Models\RestaurantGroup;
use App\Models\RestaurantPoint;
use App\Models\User;
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
        $user_id = Auth::user()->id;
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
        return view('game_views.gm2.admin.criteria_combination', compact('gType'));
    }

    public function criteria_combination_post(Request $request)
    {
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

        foreach ($axis_points as $key => $axis_point) {
            CriteriaCombination::create([
                'user_id' => Auth::guard('web')->user()->id,
                'x_axis' => $axis_point[0],
                'y_axis' => $axis_point[1],
                'point' => $points_value[$key],
            ]);
        }
        $request->session()->flash('alert-success', 'Criteria value set successfuly !');
        return redirect()->route("gm2.admin.criteria_combination");

    }

    public function setGroup()
    {
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $user_id = Auth::user()->id;
        $restaurantGroups = RestaurantGroup::where('user_id', $user_id)->get();
        $graphLevel = GraphLevel::where('user_id', $user_id)->first();


        // return $graphLevel[0]->x_level;

        return view('game_views.gm2.admin.set_group', compact('gType', 'restaurants', 'restaurantGroups', 'graphLevel'));
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

    public function assignStudent()
    {

        $students = User::where('type', 3)->get();

        $restaurantPoints = RestaurantPoint::where('leader', 1)->get()->toArray();
        $rest_group_points = RestaurantGroup::with('restaurantPoints')->get();
        foreach ($rest_group_points as $item) {
            echo $item->name . 'group' . $item->restaurantPonts->rest_id;
        }
        exit();
        // $restaurants = Restaurant::all();
        $restaurants = Restaurant::whereIn('id', $restaurantPoints)->get();
        return $restaurantPoints;

        // return $restaurants;
        return view('game_views.gm2.admin.assign_student', compact('students', 'restaurants'));
    }

    public function get_task_one_result()
    {

        $user_id = Auth::user()->id;
        // get X & Y level option value from graph level table
        $get_xy_level = GraphLevel::where('user_id', $user_id)->get()->first();

        //get level combination point value from criteria combination table assign by teacher id
        // set teacher id form session

        $results = CriteriaCombination::select(['x_axis', 'y_axis', 'point'])->where('user_id', $user_id)->get();

        $point_value = $results->map(function ($item) use ($get_xy_level) {
            return ($get_xy_level->x_level == $item->x_axis && $get_xy_level->y_level == $item->y_axis) ? $item->point : 0;
        })->sum();
        $result = get_percentage($point_value, 30);
        dd($result);
    }

    public function get_task_two_result()
    {
        $user_id = Auth::user()->id;

        // get restaurant point with restaurant from group & point table which is assign by teacher
        // set teacher id form session

        $rest_id_points = RestaurantGroup::with(array('restaurantPoints' => function ($q) {
            $q->addselect('res_group_id', 'res_id');
        }))->where('user_id', $user_id)->get();
        $records = array();
        foreach ($rest_id_points as $key => $item) {
            $records[] = [
                'point' => (int)$item->point,
                'rest_ids' => $item->restaurantPoints->pluck('res_id')
            ];
        }
        $rr =  Graph::where('level',2)->get();



    }

}
