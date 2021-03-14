<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;
use App\Models\Gm2MarketPromotion;
use App\Models\GraphLevel;
use App\Models\Market;
use App\Models\MarketCost;
use App\Models\RestaurantGroup;
use App\Models\RestaurantPoint;
use App\Models\RestaurantUser;
use Auth;
use Config;
use Illuminate\Http\Request;

class Gm2AjaxController extends Controller
{
    //
    public function updateMarket(Request $request)
    {
        // return response()->json([
        //     'status' => "ok",
        // ]);
        $user_id = Auth::user()->id;
        // dd($request->all());
        $area = $request->input('area');
        $quality = $request->input('quality');

        $area_type = $request->input('area_type');
        $quelity_type = $request->input('quelity_type');
        $area_sub_type = $request->input('area_sub_type');
        $quelity_sub_type = $request->input('quelity_sub_type');

        $competitorsMove = $request->input('competitorsMove');
        $totalValue = $request->input('totalValue');
        $rest_id = $request->input('rest_id'); //restaurant id

        $discountWithStore = $request->input('discountWithStore');
        $discountThroughDeliveryService = $request->input('discountThroughDeliveryService');
        $AdvertisingThroughSocialMedia = $request->input('AdvertisingThroughSocialMedia');
        $Branding = $request->input('Branding');
        $Other = $request->input('Other');
        $market_promotion_values  = [$discountWithStore,$discountThroughDeliveryService,
                            $AdvertisingThroughSocialMedia,$Branding,$Other];

        $market = Market::where('user_id',$user_id)->where('restaurant_id',$rest_id)->get();
        if($market->isEmpty()){
            // return "empty";
            $market = new Market();
            $market->user_id = $user_id;
            $market->restaurant_id = $rest_id;
        }else{
            $market = $market[0];
        }
        $market->total_cost = $totalValue;
        $market->save();


        // Market cost
        $market_cost = MarketCost::where('market_id',$market->id)->get();
        if($market_cost->isEmpty()){
            $market_cost = new MarketCost();
            $market_cost->market_id = $market->id;
        }else{
            $market_cost = $market_cost[0];
        }
        $market_cost->area_type = $area_type;
        $market_cost->quality_type = $quelity_type;
        $market_cost->area_sub_type = $area_sub_type ;
        $market_cost->quality_sub_type = $quelity_sub_type;
        $market_cost->area = $area;
        $market_cost->quality = $quality;
        $market_cost->competitors_move = $competitorsMove;
        $market_cost->save();

        // Market & Promotion
        $mode = 1; // attack=1 & defend =2
        $promotion_options = Config::get('game.game2.promotion_options');
        foreach($promotion_options as $key=>$promotion_option){
            $market_promotion = Gm2MarketPromotion::where('market_cost_id',$market_cost->id)
                                ->where('promotion_id',$promotion_option['id'])->get();
            if($market_promotion->isEmpty()){
                $market_promotion = new Gm2MarketPromotion();
                $market_promotion->market_cost_id = $market_cost->id;
            }else{
                $market_promotion = $market_promotion[0];
            }
            $market_promotion->promotion_id = $promotion_option['id'];
            $market_promotion->value = $market_promotion_values[$key];
            $market_promotion->mode = $mode;
            $market_promotion->save();
        }

        // $market_promotions
        return response()->json([
            'status' => "ok",
            'rest_id' => $rest_id,
            'user_id' => $user_id,
        ]);
    }

    public  function updateGroup(Request $request)
    {
        // return ($request);

        $user_id = Auth::user()->id;

        $xAxisValue = $request->input('xAxisValue');
        $yAxisValue = $request->input('yAxisValue');
        $groupNames = $request->input('groupNames');
        $groupRows = $request->input('groupRows');
        $groupColumns = $request->input('groupColumns');


        $graphLevel = GraphLevel::where('user_id',$user_id)->get();
        if($graphLevel->isEmpty()){
            $graphLevel = new GraphLevel();
            $graphLevel->user_id = $user_id;
            $msg = "Set label";
        }else{
            $graphLevel = $graphLevel[0];
            $msg = "Update label";
        }
        $graphLevel->x_level = $xAxisValue;
        $graphLevel->y_level = $yAxisValue;
        $graphLevel->save();


        $restaurantGroups = RestaurantGroup::where('user_id',$user_id);
        if($restaurantGroups->get()->isNotEmpty()){
            // $restaurantGroups->delete();
        }else{
            foreach($groupColumns as $key => $column){
                $restaurantGroup = new RestaurantGroup();
                $restaurantGroup->user_id = $user_id;
                $restaurantGroup->name = $groupNames[$key];
                $restaurantGroup->point = $groupRows[$key].$column;
                $restaurantGroup->save();
            }
        }


        return response()->json([
            'status' => "ok",
            'success' => $msg." Successfully ",
        ]);
    }

    public function updateRestaurantGroup(Request $request )
    {
        $user_id = Auth::user()->id;
        $restId = $request->input('restId');
        $groupValue = $request->input('groupValue');
        $leader = $request->input('leader');
        if($groupValue == null){
            $groupValue = 0;
        }

        $restaurantPoint = RestaurantPoint::where('user_id',$user_id)
                            ->where('res_id',$restId)->get();
        if($restaurantPoint->isEmpty()){
            $restaurantPoint = new RestaurantPoint();
            $restaurantPoint->user_id = $user_id;
            $restaurantPoint->res_id = $restId;
        }else{
            $restaurantPoint = $restaurantPoint[0];
        }
        $restaurantPoint->res_group_id = $groupValue;
        $restaurantPoint->leader = $leader;
        $restaurantPoint->save();

        return response()->json([
            'status' => "ok",
        ]);
    }

    public function assignStudent(Request $request)
    {
        $teacher_id = Auth::user()->id;

        $userId = $request->input('studentId');
        $restId = $request->input('restId');
        $restaurantUser = RestaurantUser::where('user_id',$userId)->get();
        // dd($restaurantUser);
        if($restaurantUser->isEmpty()){
            $restaurantUser = new RestaurantUser();
            $restaurantUser->user_id = $userId;

        }else{
            $restaurantUser = $restaurantUser[0];
        }
        $restaurantUser->restaurant_id = $restId;
        $restaurantUser->teacher_id = $teacher_id;
        $restaurantUser->save();



        return response()->json([
            'status' => "ok",
        ]);
    }

    public function setStudentCriteria(Request $request)
    {
        $user_id = Auth::user()->id;
        $xAxis = $request->input('xAxis');
        $yAxis = $request->input('yAxis');

        $graphLevel = GraphLevel::where('user_id',$user_id)->get();

        if($graphLevel->isEmpty()){
            $graphLevel = new GraphLevel();
            $graphLevel->user_id = $user_id;
        }else{
            $graphLevel = $graphLevel[0];
        }
        $graphLevel->x_level = $xAxis;
        $graphLevel->y_level = $yAxis;
        $graphLevel->save();


        return response()->json([
            'status' => "ok",
            'user Id' => $user_id,
        ]);
    }

    public function userSetGroup(Request $request)
    {
        // Attack
        $user_id = Auth::user()->id;
        $group = $request->input('group');
        $rest_id = $request->input('rest_id');

        $restaurantUser = RestaurantUser::where('user_id',$user_id)->where('restaurant_id',$rest_id)->first();

        $restaurantUser->rest_group_id = $group;
        $restaurantUser->save();


        return response()->json([
            'status' => "Ok",
        ]);
    }


}
