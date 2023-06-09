@extends('frontend.layout.master')
@section('content')
    <div class="container">
      <div class="row my-4">
         <div class="col-6 offset-3">
            <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="card">
                  <div class="card-header bg-warning text-white text-center">
                     Register Form
                  </div>
                  <div class="card-body">
                     <!-- error message -->
                     @include('Alert.alert')
                     
                     <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="email" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Enter Phone</label>
                        <input type="number" name="phone" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="com_password" class="form-control">
                     </div>
                     <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                     </div>
                     <input type="submit" value="Register" class="btn btn-warning">
                  </div>
               </div>
            </form>
         </div>
      </div>
    </div>
@endsection