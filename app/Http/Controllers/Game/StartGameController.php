<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game\Budget;
use App\Models\Game\StartGame;
use App\Models\Game\Marketplace;
use Illuminate\Http\Request;
use Auth;
use Exception;
use Session;
use DB;

class StartGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::beginTransaction();
        try {

            $obj = new StartGame();
            $obj->user_id = Auth::guard('web')->user()->id;
            $obj->save();
            Session::put('game_id', $obj->id);

            foreach (Marketplace::all() as $market) {
                $budget = new Budget();
                $budget->marketplace_id = $market->id;
                $budget->user_id = Auth::guard('web')->user()->id;
                $budget->game_id = $obj->id;
                $budget->save();
            }

            $recruitment = new \App\Models\Recruitment();
            $recruitment->user_id = Auth::guard('web')->user()->id;
            $recruitment->game_id = $obj->id;
            $recruitment->save();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }

        return redirect('overview');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}