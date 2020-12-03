<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin\Tutorial;
use App\Http\Requests\Admin\TutorialRequest;

class TutorialController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Tutorial::all();
        return view('admins.tutorial.index')->withData($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.tutorial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutorialRequest $request)
    {
        $obj = new Tutorial();
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->save();
        Session::flash('success','Data Saved Successfully');
        return redirect()->route('tutorial.index');
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
        $all = Tutorial::find($id);
        return view('admins.tutorial.edit')->withData($all);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TutorialRequest $request, $id)
    {
        $obj = Tutorial::find($id);
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->update();
        Session::flash('success','Update Saved Successfully');
        return redirect()->route('tutorial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Tutorial::find($id);
        $obj->delete();
        Session::flash('success','Data Remove Successfully');
        return redirect()->route('tutorial.index');
    }
}
