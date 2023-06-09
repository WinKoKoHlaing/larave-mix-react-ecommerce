@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('category.create') }}" class="btn btn-success">Create Category</a>
    </div>

    <table class="table table-striped">
      <thead>
         <tr>
            <td>Image</td>
            <td>Name</td>
            <td>Name(MM)</td>
            <td>Action</td>
         </tr>
      </thead>
      <tbody>
         @foreach ($categories as $c)
         <tr>
            <td>
               <img src="{{ asset('images/'.$c->image) }}" class="img-thumbnail" style="width:100px;">
            </td>
            <td>{{ $c->name }}</td>
            <td>{{ $c->mm_name }}</td>
            <td>
               <a href="{{ route('category.edit',$c->slug) }}" class="btn btn-primary">Edit</a>
               <form action="{{ route('category.destroy',$c->slug) }}" class="d-inline" method="post" onsubmit="return confirm('Are you sure to delete?');">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="Delete" class="btn btn-danger">
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
    </table>
    {{ $categories->links() }}
@endsection