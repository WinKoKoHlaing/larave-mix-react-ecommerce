<?php


use App\Models\User;
use Illuminate\Support\Facades\Route;

## frontend ##
Route::get('/','PageController@home');
Route::get('/product/{slug}','ProductController@detail');
Route::get('/product','PageController@allProduct');

## user-auth ##
Route::middleware(['RedirectIfAuth'])->group(function () {
   Route::get('/login','AuthController@showLogin');
   Route::post('/login','AuthController@postLogin');
   Route::get('/register','AuthController@showRegister');
   Route::post('/register','AuthController@postRegister');    
});

Route::middleware(['RedirectIfNotAuth'])->group(function () {
   Route::get('/logout','AuthController@logout');
   Route::get('/profile','PageController@showProfile');    
});


## user-manual-auth ##
Route::get('/authUser',function(){
   $user =  User::find(1);
   auth()->login($user);
   return auth()->user();
});

## backend ##
Route::get('admin/login','Admin\PageController@showLogin');
Route::post('admin/login','Admin\PageController@login');

Route::group(['prefix'=>"admin" , 'namespace'=>"Admin" ,'middleware'=>["AdminMiddleware"]],function(){
   Route::post('/logout','PageController@logout');
   Route::get('/','PageController@showDashboard');

   Route::resource('/category','CategoryController');
   Route::resource('/brand','BrandController');
   Route::resource('/color','ColorController');

   Route::resource('/product','ProductController');
   Route::get('/product-add/{slug}','ProductController@createProduct');
   Route::post('/product-add/{slug}','ProductController@storeProduct');
   Route::get('/add-product-transaction','ProductController@productAddTransaction');

   Route::get('/product-remove/{slug}','ProductController@removeProduct');
   Route::post('/product-remove/{slug}','ProductController@destroyProduct');
   Route::get('/remove-product-transaction','ProductController@productRemoveTransaction');

   Route::get('/order','OrderController@showOrder');
   Route::get('/order-status','OrderController@statusOrder');

   Route::resource('/income','IncomeController');
   Route::resource('/outcome','OutcomeController');

   //ajax-image-upload
   Route::post('product-upload','ProductController@imageUpload');
});

Route::get('locale/{locale}', function ($locale) {
   //  return $locale;
   session()->put('locale',$locale);//mm en
   return redirect()->back()->with('success','Language Switched.');
});
