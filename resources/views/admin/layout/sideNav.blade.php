<style>
  .bg-active{
    background: #5e72e4 !important;
    color: #ffffff !important;
  }
  .bg-active i{
    color: #ffffff !important;
  }
</style>
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
   <div class="scrollbar-inner">
     <!-- Brand -->
     <div class="sidenav-header  align-items-center">
       <a class="navbar-brand" href="javascript:void(0)">
         <img src="{{asset('backend/assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
       </a>
     </div>
     <div class="navbar-inner">
       <!-- Collapse -->
       <div class="collapse navbar-collapse" id="sidenav-collapse-main">
         <!-- Nav items -->
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link active {{request()->is('admin') ? 'bg-active' : ''}}" href="{{ url('/admin') }}">
               <i class="ni ni-tv-2 text-primary"></i>
               <span class="nav-link-text">Dashboard</span>
             </a>
           </li>
           <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/color*') ? 'bg-active' : ''}}" href="{{ route('color.index') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Color</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/category*') ? 'bg-active' : ''}}" href="{{ route('category.index') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/brand*') ? 'bg-active' : ''}}" href="{{ route('brand.index') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Brand</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/product*') ? 'bg-active' : ''}}" href="{{ route('product.index') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Product</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/order') ? 'bg-active' : ''}}" href="{{ url('admin/order') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Order</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/add-product-transaction') ? 'bg-active' : ''}}" href="{{ url('admin/add-product-transaction') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Product Add Transaction</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/remove-product-transaction') ? 'bg-active' : ''}}" href="{{ url('admin/remove-product-transaction') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Product Remove Transaction</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/income*') ? 'bg-active' : ''}}" href="{{ url('admin/income') }}">
              <i class="ni ni-planet text-danger"></i>
              <span class="nav-link-text">Income</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{request()->is('admin/outcome*') ? 'bg-active' : ''}}" href="{{ url('admin/outcome') }}">
              <i class="ni ni-planet text-danger"></i>
              <span class="nav-link-text">Outcome</span>
            </a>
          </li>
         </ul>
         <!-- Divider -->
         <!-- <hr class="my-3"> -->
         <!-- Heading -->
         <!-- <h6 class="navbar-heading p-0 text-muted">
           <span>Products</span>
         </h6> -->
         <!-- Navigation -->
         <!-- <ul class="navbar-nav mb-md-3">
           <li class="nav-item">
             <a class="nav-link"
               href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html"
               target="_blank">
               <i class="ni ni-spaceship"></i>
               <span class="nav-link-text">Getting started</span>
             </a>
           </li>
         </ul> -->
       </div>
     </div>
   </div>
 </nav>