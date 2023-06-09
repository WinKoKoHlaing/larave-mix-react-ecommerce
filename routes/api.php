<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

##Home-Product-Review##
Route::get('/home','Api\HomeApi@home');
Route::get('/product/{slug}','Api\ProductApi@productDetail');
Route::post('/make-review/{slug}','Api\ReviewApi@makeReview');

##CartApi##
Route::get('/login','Api\CartApi@NotaddToCart');
Route::post('/add-to-cart/{slug}','Api\CartApi@addToCart');
Route::get('/carts','Api\CartApi@showCart');
Route::post('/store-carts','Api\CartApi@storeCart');
Route::post('/destroy-carts','Api\CartApi@destroyCart');
Route::get('/checkout','Api\CartApi@checkOut');
Route::get('/orders','Api\CartApi@showOrder');

Route::post('/update-profile','Api\ProfileApi@updateProfile');
Route::post('/change-password','Api\AuthApi@changePassword');