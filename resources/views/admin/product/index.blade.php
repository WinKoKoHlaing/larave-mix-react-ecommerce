@extends('admin.layout.master')
@section('content')
    <div>
      <a href="{{ route('product.create') }}" class="btn btn-success">Create Product</a>
    </div>

    <table class="table table-striped">
      <thead>
         <tr>
            <td>Image</td>
            <td>Name</td>
            <td>Remain Quantity</td>
            <td>Add or Remove</td>
            <td>Action</td>
         </tr>
      </thead>
      <tbody>
         @foreach ($products as $p)
         <tr>
            <td><img src="{{ asset('/images/'.$p->image) }}" style="width:100px" class="img-thumbnail"></td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->total_quantity }}</td>
            <td>
               <a href="{{ url('/admin/product-remove/'.$p->slug) }}" class="btn btn-warning">-</a>
               <a href="{{ url('/admin/product-add/'.$p->slug) }}" class="btn btn-warning">+</a>
            </td>
            <td>
               <a href="{{ route('product.edit',$p->slug) }}" class="btn btn-primary">Edit</a>
               <form action="{{ route('product.destroy',$p->slug) }}" class="d-inline" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger dele-confirm">Delete</button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
    </table>
    {{ $products->links() }}
@endsection