<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;

class ReviewApi extends Controller
{
    public function makeReview(Request $request,$slug){
        // return $request->all();
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return response()->json([
                'message' => false,
                'data' => 'Product Slug Not Found!'
            ]);
        }

        $review = ProductReview::create([
            'user_id' => $request->user_id,
            'review' => $request->comment,
            'rating' => $request->rating,
            'product_id' => $product->id,
        ]);

        $review = ProductReview::where('id',$review->id)->with('user')->first();
        return response()->json([
            'message' => true,
            'data' => $review
        ]);
    }
}
