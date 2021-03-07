<?php

namespace App\Http\Controllers\Game\gm2;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Gm2AdminController extends Controller
{
    //
    public function userRole()
    {
        // $adminTle = 'assets/admintle/';
        // return asset($adminTle)."/plugins/fontawesome-free/css/all.min.css";
        $users = User::all();
        return view('game_views.gm2.admin.user_role', compact('users'));;
    }

    public function userManage()
    {

    }
}
