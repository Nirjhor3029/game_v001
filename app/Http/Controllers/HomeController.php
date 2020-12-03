<?php

namespace App\Http\Controllers;

use App\Models\Admin\Navbar;
use App\Models\Admin\SubNavbar;
use App\Models\Admin\Tutorial;
use App\Models\Admin\TutorialPlaceholder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }

    public function home()
    {
        return view('dashboard');
    }
    public function Decisions()
    {
        $decisions = Navbar::where('slug','decisions')->with('subNavbarItem')
            ->first();
        $subNavbar = $decisions->subNavbarItem;
        return view('user/decisions')->with('sub_nav_bar_items',$subNavbar);
    }

    public function tutorial()
    {
        $decisions = Navbar::where('slug','decisions')->with('subNavbarItem')
            ->first();
        $subNavbar = $decisions->subNavbarItem;

        $tutorials = Tutorial::all();
        $tutorial_placeholder = TutorialPlaceholder::all();

        return view('user.tutorial',[
            'tutorials'=>$tutorials,
            'tutorialplaceholder'=>$tutorial_placeholder
        ])->with('sub_nav_bar_items',$subNavbar);
    }


    public function marketOutlook(){
        $decisions = Navbar::where('slug','decisions')->with('subNavbarItem')
            ->first();
        $subNavbar = $decisions->subNavbarItem;
        return view('user.market-outlook')
            ->with('sub_nav_bar_items',$subNavbar);
    }

    public function demand(){
        $decisions = Navbar::where('slug','decisions')->with('subNavbarItem')
            ->first();
        $subNavbar = $decisions->subNavbarItem;


        return view('user.demand')
            ->with('sub_nav_bar_items',$subNavbar);
    }




}
