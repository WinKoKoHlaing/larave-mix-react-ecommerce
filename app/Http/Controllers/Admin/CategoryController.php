<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(2);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|min:3',
            'mm_name' => 'required|min:3',
            'image' => 'required'
        ]);

        $file = $request->file('image');
        $file_name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);

        //return $request->all();
        Category::create([
            'slug' => Str::slug($request->name).uniqid(), //t-shirt.0010900
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $file_name,
        ]);
        return redirect()->route('category.index')->with('success','Category Created Successfully.');
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
        $category = Category::where('slug',$id)->first();
        if(!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        return view('admin.category.edit',compact('category'));
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
            'name' => 'required|min:3',
            'mm_name' => 'required|min:3',
            'image' => 'sometimes|mimes:jpg,png,jpeg,webp|max:2048'
        ]);
        
        $category = Category::where('slug',$id);
        if(!$category->first()){
            return redirect()->back()->with('error','Category Not Found');
        }

        $file = $request->file('image');
        if($file){
            $file_name = uniqid().$file->getClientOriginalName();
            $file->move(public_path('images'),$file_name);
            File::delete(public_path('images/').$category->first()->image);
        }else{
            $file_name = $category->first()->image;
        }

        Category::where('slug',$id)->update([
            'name' => $request->name,
            'mm_name' => $request->mm_name,
            'image' => $file_name,
        ]);
        return redirect()->route('category.index')->with('success','Category Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('slug',$id);
        if(!$category->first()){
            return redirect()->back()->with('error','Category Not Found');
        }

        File::delete(public_path('images/').$category->first()->image);
        
        $category->delete();
        return redirect()->route('category.index')->with('success','Category Deleted Successfully');
    }
}
