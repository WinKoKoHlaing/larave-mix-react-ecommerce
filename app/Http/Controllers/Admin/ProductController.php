<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $products = Product::latest()
        ->select('slug','name','image','total_quantity',)
        ->paginate(2);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();
        return view('admin.product.create',compact('supplier','category','brand','color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        // return $request->all();
        $request->validate([
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'total_quantity' => 'required|integer',
            'buy_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'discount_price' => 'required|integer',
            'supplier_slug' => 'required|string',
            'category_slug' => 'required|string',
            'brand_slug' => 'required|string',
            'color_slug.*' => 'required|string',
            'product_image' => 'required|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        //image upload
        $file = $request->file('product_image');
        $file_name = uniqid().$file->getClientOriginalName();
        $file->move(public_path('images'),$file_name);

    
        //supplier,category,brand,color => slug->validate();
        $supplier = Supplier::where('id',$request->supplier_slug)->first();//id,slug,name,created_at
        if(!$supplier){
            return redirect()->back()->with('error','Supplier Not Found');
        }
        $category = Category::where('slug',$request->category_slug)->first();
        if(!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $brand = Brand::where('slug',$request->brand_slug)->first();
        if(!$brand){
            return redirect()->back()->with('error','Brand Not Found');
        }
        $colors = []; //[1,2]
        foreach($request->color_slug as $each_color){
            $color = Color::where('slug',$each_color)->first();
            if(!$color){
                return redirect()->back()->with('error','Color Not Found');
            }
            // return $color;
            $colors[] = $color->id;
        }
    

        //store product
        $product = Product::create([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => uniqid().Str::slug($request->product_name),
            'name' => $request->product_name,
            'image' => $file_name,
            'description' => $request->product_description,
            'buy_price' => $request->buy_price,
            'discount_price' => $request->discount_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $request->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
        ]);//{id:1,..........}

        //add to transaction
        ProductAddTransaction::create([
            'supplier_id' => $supplier->id,
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity,
        ]);

        //store to product_color
        $p = Product::find($product->id);
        $p->color()->sync($colors);
        return redirect()->route('product.index')->with('success','Product Created Successfully');
  
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
        $supplier = Supplier::all();
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();

        $product = Product::where('slug',$id)->with('supplier','category','brand','color')->first();//egarload relationship
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        // return $product;

        return view('admin.product.edit',compact('supplier','category','brand','color','product'));
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
        //find product
        $product = Product::where('slug',$id);
        if(!$product->first()){
            return redirect()->back()->with('error','Product Not Found');
        }

        //product->id
        $product_id = $product->first()->id;

        //request form validate       
        $request->validate([
            'product_name' => 'required|string',
            'product_description' => 'required|string',
            'total_quantity' => 'required|integer',
            'buy_price' => 'required|integer',
            'sale_price' => 'required|integer',
            'discount_price' => 'required|integer',
            'supplier_slug' => 'required|string',
            'category_slug' => 'required|string',
            'brand_slug' => 'required|string',
            'color_slug.*' => 'required|string',
            'product_image' => 'sometimes|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        //request image new addable validate
        $file = $request->file('product_image');
        if($file){
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);
            File::delete(public_path('images/').$product->first()->image);
        }else{
            $file_name = $product->first()->image;
        }



        //supplier,category,brand,color => slug->validate();
        $supplier = Supplier::where('id',$request->supplier_slug)->first();//id,slug,name,created_at
        if(!$supplier){
            return redirect()->back()->with('error','Supplier Not Found');
        }
        $category = Category::where('slug',$request->category_slug)->first();
        if(!$category){
            return redirect()->back()->with('error','Category Not Found');
        }
        $brand = Brand::where('slug',$request->brand_slug)->first();
        if(!$brand){
            return redirect()->back()->with('error','Brand Not Found');
        }
        $colors = []; //[1,2]
        foreach($request->color_slug as $each_color){
            $color = Color::where('slug',$each_color)->first();
            if(!$color){
                return redirect()->back()->with('error','Color Not Found');
            }
            // return $color;
            $colors[] = $color->id;
        }

        //update
        $product->update([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'brand_id' => $brand->id,
            'slug' => uniqid().Str::slug($request->product_name),
            'name' => $request->product_name,
            'image' => $file_name,
            'description' => $request->product_description,
            'buy_price' => $product->first()->buy_price,
            'discount_price' => $request->discount_price,
            'sale_price' => $request->sale_price,
            'total_quantity' => $product->first()->total_quantity,
            'like_count' => 0,
            'view_count' => 0,
        ]);


        //product_color sync
        $p = Product::find($product_id);
        $p->color()->sync($colors);
        
        return redirect()->route('product.index')->with('success','Product Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('slug',$id)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }

        //remove image
        File::delete(public_path('images/').$product->image);

        //delete product_color
        $p = Product::find($product->id);
        $p->color()->sync([]);

        //delete product
        $product->delete();
        return redirect()->route('product.index')->with('success','Product Deleted Successfully');

    }

    public function imageUpload(){
        // return request()->all(); //{_token:'XM02kjJKlaA,photo{}}
         $file = request()->file('photo');
         $file_name = uniqid() . $file->getClientOriginalName(); //80802image.png
         $file->move(public_path('/images'),$file_name); //public->images->80802image.png
         return asset('/images/'.$file_name); 
    }

    public function createProduct($slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        $supplier = Supplier::all();
        return view('admin.product.product_add',compact('product','supplier'));
    }

    public function storeProduct(Request $request,$slug){
        $request->validate([
            'total_quantity' => 'required|integer',
        ]);

        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }      
        
        //add ProductAddTransaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_id,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description,
        ]);
        
        //update product->total_qty
        $product->update([
            'total_quantity' => DB::raw('total_quantity+'.$request->total_quantity)
        ]);
        return redirect()->route('product.index')->with('success',$request->total_quantity.' added');
    }

    public function productAddTransaction(){
        $transaction = ProductAddTransaction::with('product','supplier')->latest()->paginate(2);
        // return $transaction;
        return view('admin.product.product_add_transaction',compact('transaction'));
    }

    public function removeProduct($slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        return view('admin.product.product_remove',compact('product'));
    }

    public function destroyProduct(Request $request,$slug){
        $product = Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }

        //add to productRemoveTransaction
        ProductRemoveTransaction::create([
            'product_id' => $product->id,
            'total_quantity' => $request->total_quantity,
            'description' => $request->description,
        ]);

        //reduce from product->total_qty
        $product->update([
            'total_quantity' => DB::raw('total_quantity-'.$request->total_quantity)
        ]);

        return redirect()->route('product.index')->with('success',$request->total_quantity.' reduced.');
    }

    public function productRemoveTransaction(){
        $transaction = productRemoveTransaction::with('product')->paginate(2);
        return view('admin.product.product_remove_transaction',compact('transaction'));
    }
}
