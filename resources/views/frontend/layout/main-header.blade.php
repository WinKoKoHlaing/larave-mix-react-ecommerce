<div class="header">
   <div class="w-80">
       <!-- navigation -->
       <div class="nav d-flex justify-content-between pt-3">
           <div class="nav-first d-flex justify-content-between align-items-center">
               <img src="{{asset('frontend/assets/images/logo.png')}}" width="50" alt="">
               <div class="nav-item-group ml-5">

                <a href="{{url('/')}}" class="text-white btn btn btn-outline-warning">{{__('site.home')}}</a>
                <a href="{{url('/product')}}" class="text-white btn btn btn-outline-dark">{{__('site.product')}}</a>
                <a href="{{url('/profile')}}" class="text-white btn btn btn-outline-dark ">{{__('site.profile')}}</a>
                <a href="" class="text-white btn btn btn-outline-dark ">{{__('site.about')}}</a>

                   <a href="{{url('/profile')}}" class="btn btn-outline-dark cart-container">

                       <i class="fas text-danger  fa-shopping-basket fs-1"></i>
                       <span class="cart-no bg-danger text-white" id="cartCount">{{ $cartCount }}</span>
                   </a>

               </div>
           </div>
           <div class="d-flex jusity-content-center">
               <div class=" d-flex justify-content-center align-items-center">
                   <div class="dropdown">
                       <button class="btn btn-dark text-white dropdown-toggle" type="button"
                           id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                           Account
                       </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @guest
                            <a class="dropdown-item" href="{{url('/login')}}">login</a>
                            <a class="dropdown-item" href="{{url('/register')}}">register</a>
                        @endguest
                        @auth
                            <a class="dropdown-item" href="{{url('/profile')}}">profile</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">logout</a>
                        @endauth
                       </div>
                   </div>
               </div>
               <div class=" d-flex justify-content-center align-items-center">
                   <div class="dropdown">
                       <button class="btn btn-dark text-white dropdown-toggle" type="button"
                           id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                           Language
                       </button>
                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item @if (app()->getLocale() === 'mm')
                               disabled bg-secondary
                           @endif" href="{{url('/locale/mm')}}">မြန်မာ</a>
                           <a class="dropdown-item @if (app()->getLocale() === 'en')
                            disabled bg-secondary
                        @endif" href="{{url('/locale/en')}}">English</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="mt-5 text-center p-5">
       <h1 class="text-center text-white">{{__('site.title')}}</h1>
       <small class="">{{__('site.description')}}</small>

       <div class="mt-5">
           <a href="{{url('/login')}}" class="btn btn-dark">{{__('site.login')}}</a>
           <a href="{{url('/register')}}" class="btn btn-outline-dark text-white">{{__('site.register')}}</a>
       </div>
   </div>
</div>