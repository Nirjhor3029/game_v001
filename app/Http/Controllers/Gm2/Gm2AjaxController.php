<?php

namespace App\Http\Controllers\Gm2;

use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\Gm2MarketPromotion;
use App\Models\GraphLevel;
use App\Models\Market;
use App\Models\MarketCost;
use App\Models\Restaurant;
use App\Models\RestaurantGroup;
use App\Models\RestaurantPoint;
use App\Models\RestaurantUser;
use App\Models\User;
use Auth;
use Config;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;

class Gm2AjaxController extends Controller
{
    //
    public function gm2_attack(Request $request)
    {
        // return response()->json([
        //     'status' => "ok",
        // ]);
        $user_id = Auth::user()->id;
        // dd($request->all());
        $area = $request->input('area');
        $quality = $request->input('quality');
        $numberOfOutlets = $request->input('numberOfOutlets');
        // return $numberOfOutlets;

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
        $group = $request->input('group');


        $market_promotion_values = [
            $discountWithStore,
            $discountThroughDeliveryService,
            $AdvertisingThroughSocialMedia,
            $Branding,
            $Other
        ];

        $market = Market::where('user_id', $user_id)->where('restaurant_id', $rest_id)->get();
        // return $market;
        if ($market->isEmpty()) {
            // return "empty";
            $market = new Market();
            $market->user_id = $user_id;
            $market->restaurant_id = $rest_id;
        } else {
            $market = $market[0];
        }
        $market->total_cost = $totalValue;
        $market->save();


        // Market cost
        $market_cost = MarketCost::where('market_id', $market->id)->get();
        if ($market_cost->isEmpty()) {
            $market_cost = new MarketCost();
            $market_cost->market_id = $market->id;
        } else {
            $market_cost = $market_cost[0];
        }
        $market_cost->area_type = $area_type;
        $market_cost->quality_type = $quelity_type;
        $market_cost->area_sub_type = $area_sub_type;
        $market_cost->quality_sub_type = $quelity_sub_type;
        $market_cost->area = $area;
        $market_cost->quality = $quality;
        $market_cost->competitors_move = $competitorsMove;
        $market_cost->number_of_outlets = $numberOfOutlets;
        $market_cost->save();

        // Market & Promotion
        $mode = 1; // attack=1 & defend =2
        $promotion_options = Config::get('game.game2.promotion_options');
        foreach ($promotion_options as $key => $promotion_option) {
            $market_promotion = Gm2MarketPromotion::where('market_cost_id', $market_cost->id)
                ->where('promotion_id', $promotion_option['id'])->get();
            if ($market_promotion->isEmpty()) {
                $market_promotion = new Gm2MarketPromotion();
                $market_promotion->market_cost_id = $market_cost->id;
            } else {
                $market_promotion = $market_promotion[0];
            }
            $market_promotion->promotion_id = $promotion_option['id'];
            $market_promotion->value = $market_promotion_values[$key];
            $market_promotion->mode = $mode;
            $market_promotion->save();
        }


        $restaurantUser = RestaurantUser::where('user_id', $user_id)->first();
        if (!is_null($restaurantUser)) {
            $restaurantUser->rest_group_id = $group;
            $restaurantUser->save();
        } else {
            return "teacher not assigned !";
        }


        // $market_promotions
        return response()->json([
            'status' => "ok",
            'success' => "Attack Succesfully",
        ]);
    }

    // Set Group page ::Admin
    public function updateGroup(Request $request)
    {
        // return ($request);

        $user_id = Auth::user()->id;

        $xAxisValue = $request->input('xAxisValue');
        $yAxisValue = $request->input('yAxisValue');
        $groupNames = $request->input('groupNames');
        $groupRows = $request->input('groupRows');
        $groupColumns = $request->input('groupColumns');


        $graphLevel = GraphLevel::where('user_id', $user_id)->get();
        if ($graphLevel->isEmpty()) {
            $graphLevel = new GraphLevel();
            $graphLevel->user_id = $user_id;
            $msg = "Set label";
        } else {
            $graphLevel = $graphLevel[0];
            $msg = "Update label";
        }
        $graphLevel->x_level = $xAxisValue;
        $graphLevel->y_level = $yAxisValue;
        $graphLevel->save();


        $restaurantGroups = RestaurantGroup::where('user_id', $user_id);
        if ($restaurantGroups->get()->isNotEmpty()) {
            // $restaurantGroups->delete();
        } else {
            foreach ($groupColumns as $key => $column) {
                $restaurantGroup = new RestaurantGroup();
                $restaurantGroup->user_id = $user_id;
                $restaurantGroup->name = $groupNames[$key];
                $restaurantGroup->point = $groupRows[$key] . $column;
                $restaurantGroup->save();
            }
        }


        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
        ]);
    }

    public function setSingleGroup(Request $request)
    {
        $user_id = Auth::user()->id;

        $groupName = $request->input('groupName');
        $points = $request->input('points');
        $firstPoint = $points[0];
        $points = implode(",", $points);
        $restaurantGroup = RestaurantGroup::where(['user_id' => $user_id, 'point' => $firstPoint])->first();
        if (is_null($restaurantGroup)) {
            $restaurantGroup = new RestaurantGroup();
            $restaurantGroup->user_id = $user_id;
            $restaurantGroup->point = $firstPoint;
            $restaurantGroup->points = $points;
            $msg = "Create New Group";
        } else {
            $restaurantGroup = $restaurantGroup;
            $msg = "Update Group";
        }
        $restaurantGroup->name = $groupName;
        $restaurantGroup->save();
        return response()->json([
            'status' => "success",
            'msg' => $msg . " Successfully ",
            'groupPoint' => $restaurantGroup->point,
            'groupName' => $restaurantGroup->name,
        ]);
    }

    public function deleteSingleGroup(Request $request)
    {

        $user_id = Auth::user()->id;
        $groupPoint = $request->input('groupPoint');
        $restaurantGroup = RestaurantGroup::where(['user_id' => $user_id, 'point' => $groupPoint])->first();
        // dd($restaurantGroup);
        $msg = "Delete Group ( name:" . $restaurantGroup->name . " )";

        $resPoints = RestaurantPoint::where('res_group_id', $restaurantGroup->id)->count();
        if ($resPoints) {
            return response()->json([
                'status' => "error",
                'msg' => 'Restaurant already assign to this group',
            ]);
        } else {
            $restaurantGroup->delete();
        }

        // try {
        //     $restaurantGroup->delete();
        // } catch (QueryException $e) {
        //     return response()->json([
        //         'status' => "error",
        //         'msg' => 'Restaurant already assign this group',
        //     ]);
        // }

        return response()->json([
            'status' => "success",
            'msg' => $msg . " Successfully ",
        ]);
    }

    public function groupNameUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $groupPoint = $request->input('groupPoint');
        $groupName = $request->input('groupName');
        $restaurantGroup = RestaurantGroup::where(['user_id' => $user_id, 'point' => $groupPoint])->first();
        $oldGroupName = $restaurantGroup->name;
        $restaurantGroup->name = $groupName;
        $restaurantGroup->save();
        $msg = "Update Group Name";
        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
            'groupName' => $groupName,
            'oldGroupName' => $oldGroupName,
        ]);
    }

    // Set Group page ::Admin

    public function updateRestaurantGroup(Request $request)
    {
        $user_id = Auth::user()->id;
        $restId = $request->input('restId');
        $groupValue = $request->input('groupValue');
        $leader = $request->input('leader');
        if ($groupValue == null) {
            $groupValue = 0;
        }

        $restaurantPoint = RestaurantPoint::where('user_id', $user_id)
            ->where('res_id', $restId)->get();
        if ($restaurantPoint->isEmpty()) {
            $restaurantPoint = new RestaurantPoint();
            $restaurantPoint->user_id = $user_id;
            $restaurantPoint->res_id = $restId;
            $msg = "Group Set";
        } else {
            $restaurantPoint = $restaurantPoint[0];
            $msg = "Group Update";
        }
        $restaurantPoint->res_group_id = $groupValue;
        $restaurantPoint->leader = $leader;
        $restaurantPoint->save();

        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
        ]);
    }

    public function assignStudent(Request $request)
    {
        $teacher_id = Auth::user()->id;

        $userId = $request->input('studentId');
        $dataStatus = $request->input('dataStatus');
        $restId = $request->input('restId');
        $restaurantUser = RestaurantUser::where('user_id', $userId)->get();
        // dd($restaurantUser);
        if ($restaurantUser->isEmpty()) {
            $restaurantUser = new RestaurantUser();
            $restaurantUser->user_id = $userId;
            $msg = "New Restaurant Set to student";
        } else {
            $restaurantUser = $restaurantUser[0];
            $msg = "Restaurant Update to student";
        }
        $restaurantUser->restaurant_id = $restId;
        $restaurantUser->teacher_id = $teacher_id;
        $restaurantUser->save();


        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
        ]);
    }

    public function deleteStudent(Request $request)
    {
        // return $request;
        $teacher_id = Auth::user()->id;
        $userId = $request->input('studentId');
        $restId = $request->input('restId');
        $user = User::find($userId);
        $user->delete();
        $msg = "Delete.";
        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
        ]);
    }

    public function setStudentCriteria(Request $request)
    {
        $user_id = Auth::user()->id;
        $xAxis = $request->input('xAxis');
        $yAxis = $request->input('yAxis');

        $graphLevel = GraphLevel::where('user_id', $user_id)->get();

        if ($graphLevel->isEmpty()) {
            $graphLevel = new GraphLevel();
            $graphLevel->user_id = $user_id;
        } else {
            $graphLevel = $graphLevel[0];
        }
        $graphLevel->x_level = $xAxis;
        $graphLevel->y_level = $yAxis;
        $graphLevel->save();


        return response()->json([
            'status' => "ok",
            'user Id' => $user_id,
            'success' => "Graph criteria changed successfully."
        ]);
    }

    public function userSetGroup(Request $request)
    {
        // Attack
        $user_id = Auth::user()->id;
        $group = $request->input('group');
        $rest_id = $request->input('rest_id');

        $restaurantUser = RestaurantUser::where('user_id', $user_id)->where('restaurant_id', $rest_id)->first();

        $restaurantUser->rest_group_id = $group;
        $restaurantUser->save();


        return response()->json([
            'status' => "Ok",
        ]);
    }

    // Admin Restaurant set / admin user graph page
    public function addRestaurantPoint(Request $request)
    {
        $user_id = Auth::user()->id;
        $restData = $request->input('restData');

        $groupId = $request->input('groupId');


        // dd($groupId);
        $restaurantPoint = RestaurantPoint::where('user_id', $user_id)
            ->where('res_group_id', $groupId)
            ->where('leader', 0)->delete();
        foreach ($restData as $resID) {
            $restaurantPoint = RestaurantPoint::where('user_id', $user_id)
                ->where('res_group_id', $groupId)
                ->where('res_id', $resID)->first();
            if (is_null($restaurantPoint)) {
                $restaurantPoint = new RestaurantPoint();
                $restaurantPoint->user_id = $user_id;
                $restaurantPoint->res_group_id = $groupId;
                $restaurantPoint->res_id = $resID;
                $restaurantPoint->save();
            }
        }

        // dd($restaurantPoint);

        $msg = "Restaurant position set";
        return response()->json([
            'status' => "ok",
            'success' => $msg . " Successfully ",
            'restaurantPoint' => $restaurantPoint,
        ]);
        // return response()->json(['success' => 'Restaurant position set successfully !']);
    }

    public function setLeader(Request $request)
    {
        $user_id = Auth::user()->id;
        $restId = $request->input('restId');
        $groupId = $request->input('groupId');
        $restaurantPoint = RestaurantPoint::where(["user_id" => $user_id, "res_group_id" => $groupId])->get();
        foreach ($restaurantPoint as $item) {

            if ($item->res_id == $restId) {
                $item->leader = 1;
            } else {
                RestaurantUser::where('restaurant_id', $item->res_id)->where("teacher_id", $user_id)->delete();

                $item->leader = 0;
            }
            $item->save();
        }
        return response()->json([
            'status' => "ok",
            'success' => "New Leader Set Successfully",

        ]);
    }
}
