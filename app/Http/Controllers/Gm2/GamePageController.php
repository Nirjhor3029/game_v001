<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;

use App\Models\Graph;
use App\Models\GraphItem;
use App\Models\Cost;
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
            Graph::where(['graph_point' => $graphItem->id, 'graph_point' => $graph_point])->delete();
            if ($request->filled('restData')) {
                foreach ($request->restData as $items) {
                    //add new items
                    $graph = new Graph();
                    $graph->graph_item_id = $graphItem->id;
                    $graph->rest_id = $items['restId'];
                    $graph->graph_point = $restArray['graphPointRow'] . $restArray['graphPointColumn'];
                    $graph->save();
                }
            }
        }
    }

    public function market_scenario_2()
    {
        $user_id = Auth::user()->id;
        $session_id = Session::getId();
        $typeArea = Cost::where('parent_id', 0)->whereType(1)->get();
        $typeQuantity = Cost::where('parent_id', 0)->whereType(2)->get();

        $graphItem = GraphItem::where('user_id',$user_id)
                    ->where('session_id',$session_id)
                    ->first();
                    
        $graphs = Graph::where('graph_item_id',$graphItem->id)->get();
        // return $graphs;
        return view("game_views.gm2.market_scenario_2", compact('typeArea', 'typeQuantity', 'graphs'));
    }
    public function market_scenario_defend()
    {
        $typeArea = Cost::where('parent_id', 0)->whereType(1)->get();
        $typeQuantity = Cost::where('parent_id', 0)->whereType(2)->get();

        $graphItems = Graph::all();
        // return $costs;
        return view("game_views.gm2.market_scenario_defend", compact('typeArea', 'typeQuantity', 'graphItems'));
    }

}
