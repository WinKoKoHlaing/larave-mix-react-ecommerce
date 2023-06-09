@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
   </div>
   <hr>
   <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
         <label for="name">Enter Category Name</label>
         <input type="text" name="name" id="name" class="form-control">
      </div>
      <div class="form-group">
         <label for="mm-name">Enter Category (MM) Name</label>
         <input type="text" name="mm_name" id="mm-name" class="form-control">
      </div>
      <div class="form-group">
         <label for="image">Choose Image</label>
         <input type="file" name="image" id="image" class="form-control-file">
      </div>
      <input type="submit" value="submit" class="btn btn-primary">
   </form>
@endsection