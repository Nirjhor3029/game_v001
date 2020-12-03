<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginform(){
        return view('admins.auth.login');
    }


    public  function loginSubmit(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('admin/dashboard');
        }
        return redirect()->back()->with(only($request->email));
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form');
    }






}
