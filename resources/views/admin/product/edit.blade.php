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
   <form action="{{ route('product.update',$product->slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
         <div class="col-8">
            <div class="card p-4">
               <small class="text-muted">Product Info</small>
               <div class="form-group">
                  <label>Enter Product Name</label>
                  <input type="text" name="product_name" class="form-control" value="{{ $product->name }}">
               </div>
               <div class="form-group">
                  <label>Choose Product Image</label>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                       <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old</a>
                     </li>
                     <li class="nav-item" role="presentation">
                       <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New</a>
                     </li>
                   </ul>
                   <div class="tab-content my-2" id="myTabContent">
                     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       <img src="{{asset('images/'.$product->image)}}" width="100">
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                       <input type="file" name="product_image" class="form-control-file" id="fileInput">
                     </div>
                   </div>                  
               </div>
               <div class="form-group">
                  <label>Enter Product Description</label>
                  <textarea name="product_description" id="description" class="form-control">{{ $product->description }}</textarea>
               </div>         
            </div>
            <div class="card p-4">
               <small class="text-muted">Product Pricing</small>
               <div class="form-group">
                  <label>Total Quantity</label>
                  <input type="number" name="total_quantity" class="form-control" value="{{ $product->total_quantity }}" readonly>
               </div>
               <div class="form-group">
                  <label>Buy Price</label>
                  <input type="number" name="buy_price" class="form-control" value="{{ $product->buy_price }}" readonly>
               </div>
               <div class="form-group">
                  <label>Sale Price</label>
                  <input type="number" name="sale_price" class="form-control" value="{{ $product->sale_price }}">
               </div>
               <div class="form-group">
                  <label>Discount Price</label>
                  <input type="number" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
               </div>
            </div>
         </div>
         <div class="col-4">
            <div class="card p-4">
               <div class="form-group">
                  <label>Choose Supplier</label>
                  <select name="supplier_slug" id="supplier">
                     @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" @if($s->id == $product->supplier_id) selected @endif>{{ $s->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Category</label>
                  <select name="category_slug" id="category">
                     @foreach ($category as $c)
                        <option value="{{ $c->slug }}" @if($c->id == $product->category_id) selected @endif>{{ $c->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Brand</label>
                  <select name="brand_slug" id="brand">
                     @foreach ($brand as $b)
                        <option value="{{ $b->slug }}" @if($b->id == $product->brand_id) selected @endif>{{ $b->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Choose Color</label>
                  <select name="color_slug[]" id="color" multiple>
                     @foreach ($color as $c)
                        <option value="{{ $c->slug }}"
                            @foreach($product->color as $pc)
                              @if($c->id == $pc->id) selected @endif
                            @endforeach>{{ $c->name }}</option>
                     @endforeach
                  </select>
               </div>
               <input type="submit" value="Update" class="btn btn-primary">
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