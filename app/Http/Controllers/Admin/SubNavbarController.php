<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin\SubNavbar;
use App\Http\Requests\Admin\SubNavbarRequest;
class SubNavbarController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = SubNavbar::with('navbarItem')->get();
        return view('admins.sub_navbar.index')->withData($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.sub_navbar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubNavbarRequest $request)
    {
        $obj = new SubNavbar();
        $obj->name = $request->name;
        $obj->slug = strtolower(str_replace(' ','-',$request->name));
        $obj->navbar_id = $request->navbar_id;
        $obj->save();
        Session::flash('success','Data Saved Successfully');
        return redirect()->route('sub-navbar.index');
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
        $all = SubNavbar::find($id);
        return view('admins.sub_navbar.edit')->withData($all);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubNavbarRequest $request, $id)
    {
        $obj = SubNavbar::find($id);
        $obj->name = $request->name;
        $obj->slug = strtolower(str_replace(' ','-',$request->name));
        $obj->navbar_id = $request->navbar_id;
        $obj->update();
        Session::flash('success','Update Saved Successfully');
        return redirect()->route('sub-navbar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = SubNavbar::find($id);
        $obj->delete();
        Session::flash('success','Data Remove Successfully');
        return redirect()->route('sub-navbar.index');
    }
}
