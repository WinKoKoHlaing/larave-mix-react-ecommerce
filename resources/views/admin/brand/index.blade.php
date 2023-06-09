@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('brand.create') }}" class="btn btn-success">Create Brand</a>
    </div>
    <table class="table table-striped">
      <thead>
         <tr>
            <td>Name</td>
            <td>Action</td>
         </tr>
      </thead>
      <tbody>
         @foreach ($brands as $b)
             <tr>
               <td>{{ $b->name }}</td>
               <td>
                  <a href="{{ route('brand.edit',$b->slug) }}" class="btn btn-primary">Edit</a>
                  <form action="{{ route('brand.destroy',$b->slug) }}" method="post" class="d-inline" >
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger dele-confirm">Delete</button>
                  </form>
               </td>
             </tr>
         @endforeach
      </tbody>
    </table>
    {{ $brands->links() }}
@endsection
