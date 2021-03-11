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

        $graphLevel = GraphLevel::where('user_id',$user_id)->first();

        return view('game_views.gm2.game', compact('restaurants', 'records', 'gType', 'added_restaurant','graphLevel'));
    }

    public function game_view()
    {
        $restaurant_group = RestaurantGroup::where('user_id',Auth::guard('web')->user()->id)->findOrFail();


    }

    public function criteria_combination()
    {
        $gType = Config::get('game.game2.options');

        $combinations = CriteriaCombination::all();
        // return $combinations[0];

        return view('game_views.gm2.admin.criteria_combination', compact('gType','combinations'));
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

        $combinations = CriteriaCombination::where('user_id',$user_id);
        if($combinations->get()->isEmpty()){
            $msg = 'Criteria value set successfuly !';
        }else{
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
        $request->session()->flash('alert-success',$msg );
        return redirect()->route("gm2.admin.criteria_combination");

    }

    public function setGroup()
    {
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $user_id = Auth::user()->id;
        $restaurantGroups = RestaurantGroup::where('user_id',$user_id)->get();
        $graphLevel = GraphLevel::where('user_id',$user_id)->first();


        // return $graphLevel[0]->x_level;

        return view('game_views.gm2.admin.set_group',compact('gType','restaurants','restaurantGroups','graphLevel'));
    }
    public function setRestaurant()
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::all();
        // return $restaurants;
        $gType = Config::get('game.game2.options');

        $restaurantGroups = RestaurantGroup::where('user_id',$user_id)->get();

        return view('game_views.gm2.admin.set_restaurant',compact('gType','restaurants','restaurantGroups'));
    }
    public function setRestaurant2()
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::all();
        $gType = Config::get('game.game2.options');
        $restaurantGroups = RestaurantGroup::where('user_id',$user_id)->get();

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
        // return $records;

        $addedRestaurants = $records->pluck('restaurant_id')->all();

        $rest_groups = RestaurantGroup::where('user_id', $user_id)->get();
        $graph_level = GraphLevel::where('user_id', $user_id)->get()->first();
        // return $rest_groups;
        // return $teacher_id->teacher_id;
       
        // get x-axis & y-axis option from config file
        $level_options = Config::get('game.game2.options');

        return view('gm2.teacher_user_graph', compact('rest_groups', 'graph_level', 'level_options', 'restaurants','records','addedRestaurants'));
    }

    public function assignStudent()
    {
        
        $students = User::where('type',3)->with('restaurantUser')->get();
        // return $students[0]->restaurantUser[0]->restaurant_id;

        $restaurantPoints = RestaurantPoint::with(['restaurant','restaurantGroup'])->where('leader',1)->get();
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



        // $restaurants = collect($restaurants) ;
        // dd ($restaurants);
        
        // $restaurants = Restaurant::all();
  
        // dd($restaurantPoints[0]) ;

        // return $restaurants;
        return view('game_views.gm2.admin.assign_student',compact('students','restaurants','restaurantUsers'));
    }


    public function defendMarket(Request $request)
    {
        // return $request;
        $session = Session('student_info');
        $defender_res_id = $session['assigned_res_id'];
        // return $request;
        $mode = 2; //defend mode =2
        
        $attacker_res_id = $request->attacker_res_id;
        $attacker_res_ids = explode(",",$attacker_res_id);

       

        $promotionIds = $request->promotion_ids;

        $marketCostId = $request->market_cost_id;
        $previousPormotionCost = Gm2MarketPromotion::where(['market_cost_id'=>$marketCostId,"mode"=>$mode])->delete();
        
        foreach ($promotionIds as $key => $id) {
            $promotionCost = new Gm2MarketPromotion();
            $promotionCost->market_cost_id = $marketCostId;
            $promotionCost->promotion_id = $id;
            $promotionCost->value = $request->promotion_values[$key];
            $promotionCost->mode = $mode;
            $promotionCost->save();
        }
        
        $attackerResults =  $this->defendActionCalculation($defender_res_id,$attacker_res_ids);

        foreach ($attackerResults as $key => $value) {
            $attack_defends = new AttackDefend();
            $attack_defends->attacker = $key;
            $attack_defends->defender = $defender_res_id;
            $attack_defends->score = $value;
            $attack_defends->save();
        }
        

        // dd($attackerResults);
        // return $request;
        $request->session()->flash('alert-success', 'Defend Succesfull');
        return Redirect::back();

    }
    public function defendActionCalculation($defenderRestId,$attackerRestIds)
    {
        $defenderDetails = Market::where('restaurant_id',$defenderRestId)->with('marketCost.gm2MarketPromotion',function ($query) {
            $query->where('mode','=','2');
        })->get();
        


        $attackerDetails = Market::whereIn('restaurant_id',$attackerRestIds)->with('marketCost.gm2MarketPromotion',function ($query) {
            $query->where('mode','=','1');
        })->get();

        $resultMarketCost = [];
        $defenderPromotion = $defenderDetails[0]->marketCost[0]->gm2MarketPromotion;
        // return $defenderPromotion[0]->market_cost_id;

        foreach($attackerDetails as $attacker){
            $attackPromotions = $attacker->marketCost[0]->gm2MarketPromotion;
            foreach ($attackPromotions  as $key => $item) {
                // return $item->market_cost_id;
                if($item->promotion_id == $defenderPromotion[$key]->promotion_id){
                    $resultMarketCost[$attacker->restaurant_id][$item->promotion_id] = ($item->value - $defenderPromotion[$key]->value);
                }
            }
        }
        $prmotion_options = config('game.game2.promotion_options');
        $required_amounts = array_column($prmotion_options,"required_amount",'id');
        // dd($required_amounts);
        
        return  $this->get_percentage($resultMarketCost ,$required_amounts);

        // dd ($resultMarketCost,$required_amounts);
    }


    
    function get_percentage($values, $tks)
    {
        $result = [];
        // dd($values[17][1]);
        // dd($tks[1]);
        foreach ($values as  $resId=> $value) {
            foreach($tks as $key => $tk){
               
                $result[] = round($value[$key]/$tk, 2);
                
            }
            $result_sum[$resId]=  array_sum($result);
            
        }

        return ($result_sum);
        
        
       
    }
     

    public function test2()
    {
        $user_id = Auth::user()->id;

        $resGroup = RestaurantGroup::where('user_id',$user_id)->with('restaurantPoint')->get();
        // $resPoints = RestaurantPoint::where('user_id',$user_id)->with('restaurantGroup')->get();

        $teacherAssignedResPoints = [];
        foreach($resGroup as $singleGroup){
                $teacherAssignedResPoints[] = [
                    'point' => (int)$singleGroup->point,
                    'rest_id' => $singleGroup->restaurantPoint->pluck('res_id')->toArray(),
                ];
            
        }

        $student_id = 17;
        $graphItem = GraphItem::where('user_id',$student_id)->latest()->first();
        $graphs = Graph::where('graph_item_id',16)->where('level',2)->get();

        $studentResPoints = [];
        $rest_ids = [];
        $tmpGraphPoint = 0;
        foreach ($graphs as $key => $singleResPoint) {
            // $tmpGraphPoint = $singleResPoint->graph_point;
            $rest_ids[$singleResPoint->graph_point][] =  $singleResPoint->rest_id; 
            $studentResPoints[$singleResPoint->graph_point] = [
                'point' => $singleResPoint->graph_point,
                'rest_id' =>  $rest_ids[$singleResPoint->graph_point],
            ];
        }

        // $studentResPoints = array_values($studentResPoints);
        // return array_values($studentResPoints);
        // dd($teacherAssignedResPoints,$studentResPoints) ;
        // return $studentResPoints[13]['rest_id'][0];
        // return $graphs[0]->graph_point;

        $result = [];
        $dataSet = [];
        $count = [];
        foreach($teacherAssignedResPoints as $key => $teacherGPoint){
            $point = $teacherGPoint['point'];
            $teacherRestIds = $teacherGPoint['rest_id'];
            
            if(isset($studentResPoints[$point])){
                $studentRestIds = $studentResPoints[$point]['rest_id'];
                $dataSet[$point] =  array_map(function ($item) use ($studentRestIds)
                {
                    return (in_array($item,$studentRestIds))? "yes": "no"; 
                },$teacherRestIds);
            }else{
                return "not found";
            }

            $count[$point] = array_count_values($dataSet[$point]);

        }
        $correct = array_sum(array_column($count,"yes"));
        $wrong = array_sum(array_column($count,"no"));

        $result = [
            'Correct' => $correct,
            'Wrong' => $wrong,
            'dataSet' => $count,
        ];

        dd($result);

    }

    public function result()
    {
        $session_student = session("student_info");
        $studentResId = $session_student["assigned_res_id"];
        
        $defender = AttackDefend::where('defender',$studentResId)->select('score')->get();
        $attacker = AttackDefend::where('attacker',$studentResId)->select('score')->first();

        $defenderSum = $defender->sum("score");
        // $attackSum = ( 1 - $defenderSum );

        // return $defenderSum;

        return view("gm2.result",compact("defenderSum"));
    }
}
