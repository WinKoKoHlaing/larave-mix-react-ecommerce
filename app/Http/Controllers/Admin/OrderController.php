<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function showOrder(Request $request){
        $orders = ProductOrder::with('user','product');
        if($status = $request->status){
            $orders->where('status',$status);
        }
        $orders = $orders->latest()->paginate(3);
        return view('admin.order.index',compact('orders'));
    }

    public function statusOrder(Request $request){
        $status = $request->status;
        $id = $request->id;

        DB::beginTransaction();
        try{
            //product_order->status 
            $product_order = ProductOrder::where('id',$id);
            $product_order->update([
                'status' => $status
            ]);

            //product->total_quantity
            if($status === 'success'){
                Product::where('id',$product_order->first()->product_id)->update([
                    'total_quantity' => DB::raw('total_quantity-'.$product_order->first()->total_qty)
                ]);
            }

            DB::commit();
            return redirect('admin/order')->with('success','Ordered Status Changed.');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors(['error' => 'Something Wrong! ' . $e->getMessage()])->withInput();
        }
        


    }
}
