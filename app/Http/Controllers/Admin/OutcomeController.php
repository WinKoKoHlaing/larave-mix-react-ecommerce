<?php

namespace App\Http\Controllers\Admin;

use App\Models\Outcome;
use Illuminate\Http\Request;
use App\Http\Requests\OutcomeStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\OutcomeUpdate;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outcomes = Outcome::latest()->paginate(3);
        $todayOutcome = Outcome::whereDay('created_at',date('d'))->sum('amount');
        return view('admin.outcome.index',compact('outcomes','todayOutcome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.outcome.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutcomeStore $request)
    {
        $outcome = new Outcome();
        $outcome->title = $request->title;
        $outcome->amount = $request->amount;
        $outcome->description = $request->description;

        $outcome->save();
        return redirect()->route('outcome.index')->with('success','Outcome Created Successful');
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
        $outcome = Outcome::findOrFail($id);
        return view('admin.outcome.edit',compact('outcome'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OutcomeUpdate $request, $id)
    {
        $outcome = Outcome::findOrFail($id);
        $outcome->title = $request->title;
        $outcome->amount = $request->amount;
        $outcome->description = $request->description;

        $outcome->update();
        return redirect()->route('outcome.index')->with('success','Outcome Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outcome = Outcome::findOrFail($id);
        $outcome->delete();
        return redirect()->route('outcome.index')->with('success','Outcome Deleted Successful');
    }
}
