@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brand</a>
    </div>
    <hr>
    <form action="{{ route('brand.update',$brand->slug) }}" method="post">
      @csrf
      @method('PUT')
      <div class="form-group">
         <label for="name">Name</label>
         <input type="text" name="name" id="name" class="form-control" value="{{ $brand->name }}">
      </div>
      <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection