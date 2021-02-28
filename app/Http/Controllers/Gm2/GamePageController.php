<?php

namespace App\Http\Controllers\Gm2;

use App\Http\Controllers\Controller;
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

}
