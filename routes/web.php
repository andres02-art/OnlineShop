<?php

use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
/Promotions/allPromotions
|
 */

Route::group(['prefix'=>'Profile', 'controller'=>UserController::class], function(){
    Route::get('/view/{User}', 'show')->name('profile');
});

Route::group(['prefix'=>'Promotions', 'controller'=>PromotionController::class], function(){
    Route::get('/allPromotions', 'index');
    Route::get('/PromotionContent/{Promotion}', 'getProductsByPromotion');
});

Route::group(['prefix'=>'Search', 'controller'=>ProductController::class], function(){
    Route::get('/products', 'index');
    Route::get('/product', 'getProduct')->name('search');
});

Route::get('/', function () {
    return view('home');
});

//Auth::routes();
Route::group(['prefix'=>'login', 'middleware'=>[], 'controller'=>LoginController::class], function (){
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});
// Registration Routes...
Route::group(['prefix'=>'register', 'middleware'=>[], 'controller'=>RegisterController::class], function (){
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
});
// Password Reset Routes...
Route::group(['prefix'=>'forgot', 'middleware'=>[], 'controller'=>ForgotPasswordController::class], function () {
    Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
});
Route::group(['prefix'=>'reset', 'middleware'=>[], 'controller'=>ResetPasswordController::class], function () {
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.update');
});

Route::group(['prefix'=>'confirm', 'middleware'=>[], 'controller'=>ConfirmPasswordController::class], function () {
    Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'confirm');
});

Route::group(['prefix'=>'verificate', 'middleware'=>[], 'controller'=>VerificationController::class], function () {
    Route::get('email/verify', 'show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('email/resend', 'resend')->name('verification.resend');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
