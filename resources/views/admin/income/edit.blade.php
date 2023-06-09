@extends('admin.layout.master')
@section('content')
   <div>
      <a href="{{ route('income.index') }}" class="btn btn-md btn-dark">
         All
      </a>
   </div>
   <form action="{{ route('income.update',$income->id) }}" class="mt-4" method="post" id="create">
      @csrf
      @method('PUT')
      <div class="form-group">
         <label>Title</label>
         <input type="text" name="title" class="form-control" value="{{ $income->title }}">
      </div>
      <div class="form-group">
         <label>Amount</label>
         <input type="number" name="amount" class="form-control" value="{{ $income->amount }}">
      </div>
      <div class="form-group">
         <label>Description</label>
         <textarea name="description" class="form-control">{{ $income->description }}</textarea>
      </div>
      <input type="submit" value="Update" class="btn btn-md btn-primary">
   </form>
@endsection
