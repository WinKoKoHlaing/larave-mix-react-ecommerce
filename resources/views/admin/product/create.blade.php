@extends('admin.layout.master')
@section('css')
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
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
@endsection
@section('content')
   <div>
      <a href="{{ route('product.index') }}" class="btn btn-dark">All Product</a>
   </div>
   <hr>
   <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
         <div class="col-8">
            <div class="card p-4">
               <small class="text-muted">Product Info</small>
               <div class="form-group">
                  <label>Enter Product Name</label>
                  <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
               </div>
               <div class="form-group">
                  <label>Choose Product Image</label>
                  <input type="file" name="product_image" class="form-control-file">
               </div>
               <div class="form-group">
                  <label>Enter Product Description</label>
                  <textarea name="product_description" id="description" class="form-control">{{ old('product_description') }}</textarea>
               </div>         
            </div>
            <div class="card p-4">
               <small class="text-muted">Product Pricing</small>
               <div class="form-group">
                  <label>Total Quantity</label>
                  <input type="number" name="total_quantity" class="form-control" value="{{ old('total_quantity') }}">
               </div>
               <div class="form-group">
                  <label>Buy Price</label>
                  <input type="number" name="buy_price" class="form-control" value="{{ old('buy_price') }}">
               </div>
               <div class="form-group">
                  <label>Sale Price</label>
                  <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
               </div>
               <div class="form-group">
                  <label>Discount Price</label>
                  <input type="number" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
               </div>
            </div>
         </div>
         <div class="col-4">
            <div class="card p-4">
               <div class="form-group">
                  <label>Choose Supplier</label>
                  <select name="supplier_slug" id="supplier">
                     @foreach ($supplier as $s)
                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Category</label>
                  <select name="category_slug" id="category">
                     @foreach ($category as $c)
                        <option value="{{ $c->slug }}">{{ $c->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Brand</label>
                  <select name="brand_slug" id="brand">
                     @foreach ($brand as $b)
                        <option value="{{ $b->slug }}">{{ $b->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Color</label>
                  <select name="color_slug[]" id="color" multiple>
                     @foreach ($color as $c)
                        <option value="{{ $c->slug }}">{{ $c->name }}</option>
                     @endforeach
                  </select>
               </div>
               <input type="submit" value="Create" class="btn btn-primary">
            </div>

         </div>
      </div>
   </form>
@endsection
@section('script')
    <!-- select2 -->
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <!-- summernote -->
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
    <script>
      $(document).ready(function(){
         $('#supplier').select2();
         $('#category').select2();
         $('#brand').select2();
         $('#color').select2();

         $('#description').summernote({
            callbacks:{
               onImageUpload:function(files){
                  // console.log(files);
                  // console.log(files[0]);
                  var formData = new FormData();
                  formData.append('photo',files[0]),
                  formData.append('_token','@php echo csrf_token(); @endphp')
                  $.ajax({
                     method:'POST',
                     url:'/admin/product-upload',
                     contentType:false,
                     processData:false,
                     data:formData,
                     success:function(data){
                        // console.log(data); //images/020930image.jpg
                        $('#description').summernote('insertImage',data);//summernote-auto-create-img:src
                     }
                  })
               }
            }
         });
      })
    </script>
@endsection