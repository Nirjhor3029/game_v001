<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Admin\TutorialPlaceholder;
use App\Http\Requests\Admin\TutorialPlaceholderRequest;

class TutorialPlaceholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = TutorialPlaceholder::all();
        return view('admins.tutorial_placeholder.index')->withData($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.tutorial_placeholder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TutorialPlaceholderRequest $request)
    {
        $obj = new TutorialPlaceholder();
        $obj->title = $request->title;
        $obj->placeholder = $request->placeholder;
        $obj->save();
        Session::flash('success','Data Saved Successfully');
        return redirect()->route('tutorial-placeholder.index');
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
        $all = TutorialPlaceholder::find($id);
        return view('admins.tutorial_placeholder.edit')->withData($all);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TutorialPlaceholderRequest $request, $id)
    {
        $obj = TutorialPlaceholder::find($id);
        $obj->title = $request->title;
        $obj->placeholder = $request->placeholder;
        $obj->update();
        Session::flash('success','Update Saved Successfully');
        return redirect()->route('tutorial-placeholder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $obj = TutorialPlaceholder::find($id);
        $obj->delete();
        Session::flash('success','Data Remove Successfully');
        return redirect()->route('tutorial-placeholder.index');
    }
}
