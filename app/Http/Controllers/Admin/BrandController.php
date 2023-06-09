<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(2);
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);
        Brand::create([
            'slug' => Str::slug($request->name).uniqid(),
            'name' => $request->name,
        ]);
        return redirect()->route('brand.index')->with('success','Brand Created Successfully');
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
        $brand = Brand::where('slug',$id)->first();
        if(!$brand){
            return redirect()->back()->with('error','Brand Not Found');
        }
        return view('admin.brand.edit',compact('brand'));
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
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $brand = Brand::where('slug',$id);
        if(!$brand->first()){
            return redirect()->back()->with('error','Brand Not Found');
        }
        Brand::where('slug',$id)->update([
            'slug' => Str::slug($request->name).uniqid(),
            'name' => $request->name,
        ]);
        return redirect()->route('brand.index')->with('success','Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::where('slug',$id);
        if(!$brand->first()){
            return redirect()->back()->with('error','Brand Not Found');
        }
        $brand->delete();
        return redirect()->back()->with('success','Brand Deleted Successfully');
    }
}
