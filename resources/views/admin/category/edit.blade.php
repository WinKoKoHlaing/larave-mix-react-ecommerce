@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('category.index') }}" class="btn btn-dark">All Category</a>
   </div>
   <hr>
   <form action="{{ route('category.update',$category->slug) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
         <label for="name">Enter Category Name</label>
         <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
      </div>
      <div class="form-group">
         <label for="mm-name">Enter Category (MM) Name</label>
         <input type="text" name="mm_name" id="mm-name" class="form-control" value="{{ $category->mm_name }}">
      </div>
      <div class="form-group">
         <label for="name">Choose Image</label>
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
              <img src="{{asset('images/'.$category->image)}}" width="100">
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <input type="file" name="image" class="form-control-file" id="fileInput">
            </div>
          </div> 
      </div>
      <input type="submit" value="Update" class="btn btn-primary">
   </form>
@endsection