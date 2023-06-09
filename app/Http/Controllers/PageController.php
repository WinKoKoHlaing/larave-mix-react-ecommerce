<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home(){
        return view('frontend.home');
    }

    public function showProfile(){
        return view('frontend.profile');
    }

    public function allProduct(Request $request){
        $categories = Category::withCount('product')->whereHas('product')->get();
        $colors = Color::whereHas('product')->get();
        $brands = Brand::whereHas('product')->get();
        $products = Product::latest();

        //category-filter
        if($category_slug = $request->category){
            $findCategory = Category::where('slug',$category_slug)->first();
            if(!$findCategory){
                return redirect('/product')->with('error','Category Not Found.');
            }
            $products->where('category_id',$findCategory->id);
        }

        //brand-filter
        if($brand_slug = $request->brand){
            $findBrand = Brand::where('slug',$brand_slug)->first();
            if(!$findBrand){
                return redirect('/product')->with('error','Brand Not Found.');
            }
            $products->where('brand_id',$findBrand->id);
        }

        //color-filter
        if($color_slug = $request->color){
            $findColor = Color::where('slug',$color_slug)->first();
            if(!$findColor){
                return redirect('/product')->with('error','Color Not Found.');
            }
            $products->whereHas('color',function($q) use ($findColor){
                $q->where('product_color.color_id',$findColor->id);
            });
        }

        //search-filter
        if($search = $request->search){
            $products->where('name','like',"%$search%");
        }

        //products->paginate
        $products = $products->paginate(3);

        return view('frontend.product',compact('categories','colors','brands','products'));
    }
}
