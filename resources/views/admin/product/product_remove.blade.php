@extends('admin.layout.master')
@section('content')
    <h2>
      Reduce for  
      <b class="text-danger">{{ $product->name }}</b>
    </h2>
    <div>
      <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
    </div>
    <hr>
    <form action="{{ url('admin/product-remove/'.$product->slug) }}" method="post">
      @csrf
      <div class="form-group">
         <label>Total Quantity</label>
         <input type="number" name="total_quantity" class="form-control">
      </div>
      <div class="form-group">
         <label>Description</label>
         <textarea name="description" class="form-control"></textarea>
      </div>
      <input type="submit" value="Reduce" class="btn btn-primary">
    </form>
@endsection