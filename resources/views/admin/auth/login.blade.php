<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin Login</title>
   <link rel="stylesheet" href="{{ asset('backend/assets/css/argon.css') }}">
   <!-- tostify.css  -->
   <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> -->
   <link rel="stylesheet" href="{{ asset('toastify/toastify.min.css') }}">
</head>
<body>
   <div class="container mt-5">
      <div class="row">
         <div class="col-4 offset-4">
            <div class="card">
               <div class="card-header bg-primary text-white">
                  Admin Login
               </div>
               <div class="card-body">
                  <!-- alert -->
                  @include('Alert.alert')
                  
                  <form action="{{ url('admin/login') }}" method="post">
                     @csrf
                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                     </div>
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                     </div>
                     <input type="submit" value="Login" class="btn btn-primary text-center">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- tostify.js -->
   <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->
   <script src="{{ asset('toastify/toastify.min.js') }}"></script>
   <style>
      .toastify{
         background-image: unset;
      }
   </style>
   @if (session()->has('error'))
   <script>
      Toastify({
         text: "{{ session('error') }}",
         className: "bg-danger",
         position: "center",
      }).showToast();
   </script>       
   @endif
</body>
</html>