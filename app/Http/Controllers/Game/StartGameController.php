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
use Redirect;

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


        $userId = Auth::guard('web')->user()->id;

        DB::beginTransaction();
        try {

            $game = StartGame::where('user_id',$userId)->latest('created_at')->first();
            // dd ($game);

            /*
                Null check for new registered users
            */
            if(is_null($game) || (!is_null($game) && $game->status)){
                // dd("new");
                $obj = new StartGame();
                $obj->user_id = Auth::guard('web')->user()->id;
                $obj->save();

                $recruitment = new \App\Models\Recruitment();
                $recruitment->user_id = Auth::guard('web')->user()->id;
                $recruitment->game_id = $obj->id;
                $recruitment->save();

                foreach (Marketplace::all() as $market) {
                    $budget = new Budget();
                    $budget->marketplace_id = $market->id;
                    $budget->user_id = Auth::guard('web')->user()->id;
                    $budget->game_id = $obj->id;
                    $budget->save();
                }
            }else{
                // dd("old");
                $obj = $game;
            }


            Session::put('game_id', $obj->id);




            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }

        return redirect('overview');
    }

    public function startGame2(Request $request)
    {
        

        $userId = Auth::guard('web')->user()->id;

        DB::beginTransaction();
        try {

            $game = StartGame::where('user_id',$userId)->latest('created_at')->first();
            // dd ($game);

            /*
                Null check for new registered users
            */
            if(is_null($game) || (!is_null($game) && $game->status)){
                // dd("new");
                $obj = new StartGame();
                $obj->user_id = Auth::guard('web')->user()->id;
                $obj->save();
            }else{
                // dd("old");
                $obj = $game;
            }
            Session::put('game_id', $obj->id);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            return $ex->getMessage();
        }

        return redirect()->route('gm2.strategic_group');
    }

    // Game submit-end game
    public function submitGame()
    {
        $userId = Auth::guard('web')->user()->id;
        $game = StartGame::find(Session::get('game_id'));
        if($game->user_id == $userId ){
            $game->status = 1;
            $game->save();
        }
        return Redirect::to('dashboard');
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
