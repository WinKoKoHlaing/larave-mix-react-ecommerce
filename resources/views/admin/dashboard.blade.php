@extends('admin.layout.master')
@section('style')
    <style>
      .dashboard-i{
         font-size: 50px !important;
      }
    </style>
@endsection
@section('content')
   <div class="row">
      <div class="col-3">
         <div class="card bg-success p-3">
            <div class="d-flex">
               <div class="p-3 d-flex justify-content-center align-items-center">
                  <i class="fas fa-user text-white dashboard-i"></i>
               </div>
               <div class="p-3 d-flex justify-content-center align-items-center flex-column">
                  <h5 class="text-white">Today Income</h5>
                  <h2 class="text-white">{{ $todayIncome }} Ks</h2>
               </div>
            </div>
         </div>
      </div>
      <div class="col-3">
         <div class="card bg-danger p-3">
            <div class="d-flex">
               <div class="p-3 d-flex justify-content-center align-items-center">
                  <i class="fas fa-user text-white dashboard-i"></i>
               </div>
               <div class="p-3 d-flex justify-content-center align-items-center flex-column">
                  <h5 class="text-white">Today Outcome</h5>
                  <h2 class="text-white">{{ $todayOutcome }} Ks</h2>
               </div>
            </div>
         </div>
      </div>
      <div class="col-3">
         <div class="card bg-primary p-3">
            <div class="d-flex">
               <div class="p-3 d-flex justify-content-center align-items-center">
                  <i class="fas fa-user text-white dashboard-i"></i>
               </div>
               <div class="p-3 d-flex justify-content-center align-items-center flex-column">
                  <h5 class="text-white">Total Users</h5>
                  <h2 class="text-white">{{ $user_count }}</h2>
               </div>
            </div>
         </div>
      </div>
      <div class="col-3">
         <div class="card bg-warning p-3">
            <div class="d-flex">
               <div class="p-3 d-flex justify-content-center align-items-center">
                  <i class="fas fa-user text-white dashboard-i"></i>
               </div>
               <div class="p-3 d-flex justify-content-center align-items-center flex-column">
                  <h5 class="text-white">All Products</h5>
                  <h2 class="text-white">{{ $product_count }}</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-6">
         <div class="card">
           <div class="card-body">
             <h4>Sale Data <span class="text-muted">(Unit - Items Count)</span></h4>
             <canvas id="bar-chart"></canvas>
           </div>
         </div>
      </div>
      <div class="col-6">
         <div class="card">
           <div class="card-body">
             <h4>Income & Outcome <span class="text-muted">(Unit - Kyats)</span></h4>
             <canvas id="line-chart"></canvas>
           </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-5">
         <div class="card">
            <div class="card-body">
               <h4>Latest Users</h4>
               <ul class="list-group">
                  @foreach ($latest_users as $user)
                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        <img src="{{$user->image_url}}" class="rounded-circle" width="50px">
                        <small>{{$user->email}}</small>
                        <small class="badge badge-danger">{{$user->name}}</small>
                     </li>
                  @endforeach
               </ul>
            </div>
         </div>
      </div>
      <div class="col-7">
         <div class="card">
            <div class="card-body">
               <h4>Items - under 3 count</h4>
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($under_three_products as $product)
                         <tr>
                           <td>
                              <img src="{{$product->image_url}}" class="rounded-circle" width="50px">
                           </td>
                           <td>{{$product->name}}</td>
                           <td>{{$product->total_quantity}}</td>
                         </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('script')
    <script src="{{ asset('chart/chart4.min.js') }}"></script>
    <script>
      const bar = document.getElementById('bar-chart');
      new Chart(bar, {
      type: 'bar',
      data: {
         labels: @json($months),
         datasets: [{
            label: 'sale data',
            data: @json($sale_count),
            borderWidth: 1,
            backgroundColor: [
               '#5e72e4',
               '#2dce89',
               '#f5365c',
               '#fb6340',
               '#E91E63',
               '#673AB7',
               '#FFC107'
            ],
            borderColor: [
               '#5e72e4',
               '#2dce89',
               '#f5365c',
               '#fb6340',
               '#E91E63',
               '#673AB7',
               '#FFC107'
            ],
         }]
      },
      options: {
         scales: {
            y: {
            beginAtZero: true
            }
         }
      }
      });

      //line-chart
      const line = document.getElementById('line-chart');

      new Chart(line, {
      type: 'line',
      data: {
         labels: @json($day_months),
         datasets: [
         {
            label: 'income',
            data: @json($incomes),
            borderWidth: 1,
            backgroundColor: '#2dce89',
            borderColor: '#2dce89',
         },
         {
            label: 'outcome',
            data: @json($outcomes),
            borderWidth: 1,
            backgroundColor: '#f5365c',
            borderColor: '#f5365c',
         }
      ]
      },
      options: {
         scales: {
            y: {
            beginAtZero: true
            }
         }
      }
      });
    </script>
@endsection