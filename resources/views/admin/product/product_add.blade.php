@extends('admin.layout.master')
<!-- select2 -->
<link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
<style>
  .select2-selection{
     height: 43px !important;
  }
  .select2-selection__rendered{
     line-height: 20px !important;
  }
  .select2-selection__choice__display{
     padding-left: 3px !important;
  }
  .select2-selection__choice__remove{
     padding: 0px 2px 0px 0px !important;
  }
</style>
@section('content')
    <h2>
      Add For
      <b class="text-danger">Product-Name</b>
    </h2>
    <div>
       <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
    </div>
    <hr>
    <form action="{{ url('admin/product-add/'.$product->slug) }}" method="POST">
      @csrf
      <div class="form-group">
         <label>Choose Supplier</label>
         <select name="supplier_id" class="form-control" id="supplier">
            @foreach ($supplier as $s)                
               <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label>Total Quantity</label>
         <input type="number" name="total_quantity" class="form-control">
      </div>
      <div class="form-group">
         <label>Description</label>
         <textarea name="description" class="form-control"></textarea>
      </div>
      <input type="submit" value="Add" class="btn btn-primary">
    </form>
    
@endsection
@section('script')    
   <!-- select2 -->
   <script src="{{ asset('select2/select2.min.js') }}"></script>
   <script>
      $(document).ready(function(){
         $('#supplier').select2();
      });
   </script>
@endsection