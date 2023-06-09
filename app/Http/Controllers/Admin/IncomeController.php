<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Requests\IncomeStore;
use App\Http\Requests\IncomeUpdate;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $incomes = Income::latest()->paginate(3);
        $todayIncome = Income::whereDay('created_at',date('d'))->sum('amount');
        return view('admin.income.index',compact('incomes','todayIncome'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeStore $request)
    {
        $income = new Income();
        $income->title = $request->title;
        $income->amount = $request->amount;
        $income->description = $request->description;

        $income->save();
        return redirect()->route('income.index')->with('success','Income Created Successful');
    }

    /**sd
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
        $income = Income::findOrFail($id);
        return view('admin.income.edit',compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IncomeUpdate $request, $id)
    {
        $income = Income::findOrFail($id);
        $income->title = $request->title;
        $income->amount = $request->amount;
        $income->description = $request->description;

        $income->update();
        return redirect()->route('income.index')->with('success','Income Updated Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return redirect()->route('income.index')->with('success','Income Deleted Successful');
    }
}
