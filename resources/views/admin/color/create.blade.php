@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>
    <hr>
    <form action="{{ route('color.store') }}" method="post">
      @csrf
      <div class="form-group">
         <label for="name">Name</label>
         <input type="text" name="name" id="name" class="form-control">
      </div>
      <input type="submit" value="Submit" class="btn btn-primary">
    </form>
@endsection