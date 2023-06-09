<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Commerce</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Padauk:wght@400;700&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <!-- Fontawesome -->
    <link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
    <!-- Toastify -->
    <link rel="stylesheet" href="{{asset('toastify/toastify.min.css')}}">
    <style>
        .toastify{
            background-image: unset;
        }
    </style>
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/argon.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    @yield('style')
</head>

<body>    
    <!-- header -->
    @if (request()->is('/'))
        @include('frontend.layout.main-header')
    @else
        @include('frontend.layout.header')
    @endif

    <!-- content -->
    @yield('content')

    <!-- footer -->
    <div class="bg-dark p-5 text-center text-white">
        Develop By <a href="https://mmcoder.com" class="text-success">MM-Coder</a>
    </div>
    
    <!--jquery-->
    <script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
    <!--popper-->
    <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
    <!--bootstrap-->
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
    <script src="{{asset('frontend/assets/js/argon.min.js')}}"></script>
    <!--toastify-->
    <script src="{{asset('toastify/toastify.min.js')}}"></script>
    @if (session()->has('success'))
        <script>
            Toastify({
            text:"{{session('success')}}",
            className: "success",
            position:"center",
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
            }).showToast();
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
            text: "{{session('error')}}",
            className: "danger",
            position:"center",
            style: {
                background: "linear-gradient(to right, #ff606d, #ffc071)",
            }
            }).showToast();
        </script>
    @endif
    <!--Global-variable-->
    <script>
        window.updateCart = cart => {
            let cartCount = document.getElementById('cartCount');
            cartCount.innerText = cart;
        }
        // window.updateCart(0);

        window.auth = @json(auth()->user());
        window.locale = "{{app()->getLocale()}}"

        const showToast = (message,type="success") => {
            Toastify({
            text:message,
            position:"center",
            className:[type==="success"?"bg-success":"bg-danger"]
            }).showToast();
        }
    </script>
    @yield('script')
</body>

</html>
