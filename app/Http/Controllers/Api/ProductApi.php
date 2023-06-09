<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductApi extends Controller
{
    public function productDetail($slug){
        $product = Product::where('slug',$slug)
        ->with('review.user','brand','category','color')
        ->first();

        if(!$product){
            return response()->json([
                'message' => true,
                'data'    => 'Product Not Found.'
            ]);
        }

        return response()->json([
            'message' => true,
            'data'    => $product
        ]);
    }
}
