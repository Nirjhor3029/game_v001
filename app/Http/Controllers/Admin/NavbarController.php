<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NavbarRequest;
use App\Models\Admin\Navbar;
use Illuminate\Http\Request;
use Session;
class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Navbar::all();
        return view('admins.navbar.index')->withData($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.navbar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NavbarRequest $request)
    {
        $obj = new Navbar();
        $obj->name = $request->name;
        $obj->slug = strtolower(str_replace(' ','-',$request->name));
        $obj->save();
        Session::flash('success','Data Saved Successfully');
        return redirect()->route('navbar.index');
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
        $all = Navbar::find($id);
        return view('admins.navbar.edit')->withData($all);
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
        $obj = Navbar::find($id);
        $obj->name = $request->name;
        $obj->slug = strtolower(str_replace(' ','-',$request->name));
        $obj->update();
        Session::flash('success','Update Saved Successfully');
        return redirect()->route('navbar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Navbar::find($id);
        $obj->delete();
        Session::flash('success','Data Remove Successfully');
        return redirect()->route('navbar.index');
    }
}
