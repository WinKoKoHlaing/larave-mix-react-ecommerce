@extends('admin.layout.master')
@section('content')
    <div class="mb-5">
      <a href="" class="btn btn-outline-success">Add Transaction</a>
      <a href="" class="btn btn-success">Remove Transaction</a>
    </div>
    <table class="table table-striped">
      <thead>
         <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Total Quantity</th>
            <th>Remove Date</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($transaction as $t)
         <tr>
            <td>
               <img src="{{ asset('images/'.$t->product->image) }}" class="img-thumbnail" style="width:100px">
            </td>
            <td>{{ $t->product->name }}</td>
            <td>{{ $t->total_quantity }}</td>
            <td>{{ $t->created_at }}</td>
         </tr>             
         @endforeach
      </tbody>
    </table>
    {{ $transaction->links() }}
@endsection