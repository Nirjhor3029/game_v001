<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use Illuminate\Http\Request;

class GamePageController extends Controller
{
    public function overview()
    {
        $nav = null;
        return view('gm2.overview')->with('nav', $nav);
    }

    public function addGraph(Request $request)
    {
        if ($request->ajax()) {
            $graphPointRow = $request->input('graphPointRow') + 1;
            $graphPointColumn = $request->input('graphPointColumn') + 1;
            $restId = $request->restData['id'];
            dd($request->all());
        }
    }

    public function market_scenario_2()
    {
        $typeArea = Cost::where('parent_id',0)->whereType(1)->get();
        $typeQuantity = Cost::where('parent_id',0)->whereType(2)->get();
        // return $costs;
        return view("game_views.gm2.market_scenario_2",compact('typeArea','typeQuantity'));
    }

}
