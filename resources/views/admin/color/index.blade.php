@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('color.create') }}" class="btn btn-success">Create Color</a>
    </div>
    <table class="table table-striped">
      <thead>
         <tr>
            <td>Name</td>
            <td>Action</td>
         </tr>
      </thead>
      <tbody>
         @foreach ($colors as $c)
             <tr>
               <td>{{ $c->name }}</td>
               <td>
                  <a href="{{ route('color.edit',$c->slug) }}" class="btn btn-primary">Edit</a>
                  <form action="{{ route('color.destroy',$c->slug) }}" method="post" class="d-inline" >
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger dele-confirm">Delete</button>
                  </form>
               </td>
             </tr>
         @endforeach
      </tbody>
    </table>
    {{ $colors->links() }}
@endsection
