@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>
    <hr>
    <form action="{{ route('color.update',$color->slug) }}" method="post">
      @csrf
      @method('PUT')
      <div class="form-group">
         <label for="name">Name</label>
         <input type="text" name="name" id="name" class="form-control" value="{{ $color->name }}">
      </div>
      <input type="submit" value="Update" class="btn btn-primary">
    </form>
@endsection