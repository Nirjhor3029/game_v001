<?php

namespace App\Http\Controllers\Game\gm2;

use App\Http\Controllers\Controller;
use App\Models\Admin\Navbar;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        
        // return $navbars;
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
        $restaurant = ['testy treat','unimart','pizza roma','pizza hut','bella italia','north end','tabaq','peyala','Burger king','take out','kfc','salman\'s kitchen','kacchi bhai','glazed','star kabab','dhanshiri'];
        $options = $restaurant;
        return view('game_views.gm2.demo',compact('options'));
    }
}
