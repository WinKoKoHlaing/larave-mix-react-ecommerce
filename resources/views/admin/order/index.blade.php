@extends('admin.layout.master')
@section('script')
   <style>
      .user-table th,.user-table td{
         padding:0.8rem !important;
      }
   </style>
@endsection
@section('content')
   <div class="mb-4">
      <a href="{{url('admin/order')}}" class="btn btn-dark">All</a>
      <a href="{{url('admin/order?status=success')}}" class="btn btn-success">Success</a>
      <a href="{{url('admin/order?status=pending')}}" class="btn btn-warning">Pending</a>
      <a href="{{url('admin/order?status=cancel')}}" class="btn btn-danger">Cancel</a>
   </div>
   <table class="table table-striped">
      <thead>
         <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>status</th>
            <th>User Info</th>
            <th>Option</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($orders as $order)
            <tr>
               <td>
                  <img src="{{$order->product->image_url}}" class="img-thumbnail" width="70">
               </td>
               <td>{{$order->product->name}}</td>
               <td>{{$order->total_qty}}</td>
               <td>{{$order->product->sale_price}}</td>
               <td>
                  @if($order->status === 'pending')
                     <p class="badge badge-warning">pending</p>
                  @elseif($order->status === 'success')
                     <p class="badge badge-success">success</p>
                     @else
                     <p class="badge badge-danger">cancel</p>
                  @endif
               </td>
               <td>
                  {{-- loop user-info --}}
                  <table class="table table-bordered user-table">
                     <tr>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Phone</td>
                        <td>Address</td>
                     </tr>
                     <tr>
                        <td>
                           <img src="{{$order->user->image_url}}" class="img-thumbnail" width="50">
                        </td>
                        <td>{{$order->user->name}}</td>
                        <td>09123456789</td>
                        <td>Pathein</td>
                     </tr>
                  </table>
               </td>
               <td>
                  <a href="{{url('admin/order-status?id='.$order->id.'&status=pending')}}" class="btn btn-sm btn-outline-warning">Pending</a>
                  <a href="{{url('admin/order-status?id='.$order->id.'&status=success')}}" class="btn btn-sm btn-outline-success">Success</a>                      
                  @if ($order->status !== 'success')
                     <a href="{{url('admin/order-status?id='.$order->id.'&status=cancel')}}" class="btn btn-sm btn-outline-danger">Cancel</a>
                  @endif
               </td>
            </tr>                
         @endforeach
      </tbody>
   </table>
   {{ $orders->links() }}
@endsection