@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('income.index') }}" class="btn btn-md btn-dark">
         All
      </a>
   </div>
   <form action="{{ route('income.store') }}" class="mt-4" method="post" id="create">
      @csrf
      <div class="form-group">
         <label>Title</label>
         <input type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
         <label>Amount</label>
         <input type="number" name="amount" class="form-control">
      </div>
      <div class="form-group">
         <label>Description</label>
         <textarea name="description" class="form-control"></textarea>
      </div>
      <input type="submit" value="Create" class="btn btn-md btn-primary">
   </form>
@endsection
