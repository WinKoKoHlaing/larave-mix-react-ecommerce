<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CartApi extends Controller
{
    public function addToCart(Request $request,$slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return response()->json([
                'message' => false,
                'data' => 'Slug Not Found'
            ]);
        }

        //addtocart-item-check
        $findInCart = ProductCart::where('user_id',$request->user_id)->where('product_id',$product->id)->first();
        if($findInCart){
            $total_qty = $findInCart->total_qty + 1;
            $findInCart->update([
                'total_qty' => $total_qty
            ]);
        }else{
            ProductCart::create([
                'user_id' => $request->user_id,
                'product_id' => $product->id,
                'total_qty' => 1
            ]);
        }


        $cartCount = ProductCart::where('user_id',$request->user_id)->count();
        return response()->json([
            'message' => true,
            'data' => $cartCount
        ]);

        
    }

    public function showCart(Request $request){
        $user_id = $request->user_id;
        $carts = ProductCart::where('user_id',$user_id)
        ->with('product')
        ->get();
        return response()->json([
            'message' => true,
            'data' => $carts,
        ]);
    }

    public function storeCart(Request $request){
        $cart_id = $request->cart_id;
        $total_qty = $request->total_qty;

        $cart = ProductCart::where('id',$cart_id);
        $cart->update([
            'total_qty' => $total_qty,
        ]);
        return response()->json([
            'message' => true,
            'data' => null,
        ]);
    }

    public function destroyCart(Request $request){
        $cart_id = $request->cart_id;
        $cart = ProductCart::where('id',$cart_id);
        $cart->delete();
        return response()->json([
            'message' => true,
            'data' => null
        ]);
    }

    public function checkOut(Request $request){
        $user_id = $request->user_id;

        //find-user-carts_and_store
        $user_carts = ProductCart::where('user_id',$user_id)->get();
        foreach($user_carts as $cart){
            ProductOrder::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'total_qty' => $cart->total_qty,
            ]);
        }

        //user-cart-delete
        ProductCart::where('user_id',$user_id)->delete();
        return response()->json([
            'message' => true,
            'data' => null
        ]);
    }

    public function showOrder(Request $request){
        $user_id = $request->user_id;
        $user_orders = ProductOrder::where('user_id',$user_id)
        ->with('product')
        ->paginate(2);
        return response()->json([
            'message' => true,
            'data' => $user_orders
        ]);
    }
}
