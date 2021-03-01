<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;
use App\Models\Market;
use Auth;
use Illuminate\Http\Request;

class Gm2AjaxController extends Controller
{
    //
    public function updateMarket(Request $request)
    {
        $user_id = Auth::user()->id;
        // dd($request->all());
        $area = $request->input('area');
        $quality = $request->input('quality');
        $competitorsMove = $request->input('competitorsMove');
        $totalValue = $request->input('totalValue');
        $rest_id = $request->input('rest_id'); //restaurant id

        $discountWithStore = $request->input('discountWithStore');
        $discountThroughDeliveryService = $request->input('discountThroughDeliveryService');
        $AdvertisingThroughSocialMedia = $request->input('AdvertisingThroughSocialMedia');
        $Branding = $request->input('Branding');
        $Other = $request->input('Other');

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
        


        
        
        

        return response()->json([
            'status' => "ok",
            'rest_id' => $rest_id,
            'user_id' => $user_id,
        ]);
    }
}
