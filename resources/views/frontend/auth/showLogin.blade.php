@extends('frontend.layout.master')
@section('content')
    <div class="container">
      <div class="row my-4">
         <div class="col-6 offset-3">
            <form action="{{ url('/login') }}" method="POST">
               @csrf
               <div class="card">
                  <div class="card-header bg-warning text-white text-center">
                     Login Form
                  </div>
                  <div class="card-body">
                     <!-- error message -->
                     @include('Alert.alert')
                     
                     <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control">
                     </div>
                     <input type="submit" value="Login" class="btn btn-warning">
                  </div>
               </div>
            </form>
         </div>
      </div>
    </div>
@endsection