<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect('/')->with('error','Product Not Found.');
        }
        
        $category = Category::withCount('product')->get();
        return view('frontend.product-detail',compact('category','slug'));
    }
}
