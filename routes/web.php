<?php

use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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
    Route::group(['prefix'=>'Owner','middleware'=>['auth']], function(){
        Route::get('/user/{User}', 'show')->name('profile');
        Route::get('/account/{User}', 'indexUser');
        Route::get('/getProfile/{User}/{redirect}', 'showUser');
        Route::get('/getRole/{User}', 'indexRole');
        Route::group(['prefix'=>'Root','middleware'=>['auth', 'role:admin']], function(){
            Route::get('/root', 'show')->name('profile.admin');
            Route::get('/rootDatatable', 'indexDatatable');
            Route::get('/getAllRoles', function (){
                return Role::all()->pluck('name');
            });
            Route::get('/users/{redirect}', 'showUsers');
            Route::post('/createProfile', 'store');
            Route::post('/editProfile/{User}', 'update');
            Route::delete('/deleteProfile/{User}', 'destroy');
        });
    });
});

Route::group(['prefix'=>'Shops', 'controller'=>FactureController::class], function(){
    Route::get('/shop/{User}', 'show');
    Route::group(['prefix'=>'Confirm','middleware'=>['auth']], function(){
        Route::get('/buy/{User}', 'indexUser');
        Route::get('/xx/{User}', 'indexRole');
        Route::group(['prefix'=>'Root','middleware'=>['auth', 'role:admin']], function(){
            Route::get('/shopsAdmin/{redirect}', 'showFactures');
            Route::get('/shopsAdminDatatable', 'indexDatatable');
            Route::post('/createFacture', 'store');
            Route::post('/editFacture/{Facture}', 'update');
            Route::delete('/deleteFacture/{Facture}', 'destroy');
        });
    });
});

Route::group(['prefix'=>'Bought', 'middleware'=>['auth'],  'controller'=>ShopController::class], function(){
    Route::get('/list/{User}', 'show');
});

Route::group(['prefix'=>'Promotions', 'controller'=>PromotionController::class], function(){
    Route::get('/allPromotions', 'index');
    Route::get('/PromotionContent/{Promotion}', 'indexProductsByPromotion');
    Route::group(['prefix'=>'Root', 'middleware'=>['auth', 'role:admin']], function(){
        Route::get('/promotionsAdmin/{redirect}', 'showPromotions');
        Route::get('/promotionsAdminDatatable', 'indexDatatable');
        Route::post('/createPromotion', 'store');
        Route::post('/editPromotion/{Promotion}', 'update');
        Route::delete('/deletePromotion/{Promotion}', 'destroy');
    });
});

Route::group(['prefix'=>'Categories', 'controller'=>CategoryController::class], function(){
    Route::get('/allCategories', 'index');
    Route::get('/CategoriesContent', 'indexProductsByCategories');
    Route::get('/CategoryContent', 'indexProductsByCategory');
    Route::get('/viewCategory', 'show');
    Route::group(['prefix'=>'User', 'middleware'=>['auth']], function(){
        Route::get('/view/{Category}/{redirect}', 'showCategory');
    });
    Route::group(['prefix'=>'Root', 'middleware'=>['auth', 'role:admin']], function(){
        Route::get('/categoriesAdmin/{redirect}', 'showCategories');
        Route::get('/categoriesAdminDatatable', 'indexDatatable');
        Route::post('/createCategory', 'store');
        Route::post('/editCategory/{Category}', 'update');
        Route::delete('/deleteCategory/{Category}', 'destroy');
    });
});

Route::group(['prefix'=>'Product', 'controller'=>ProductController::class], function(){
    Route::get('/product/{Product}', 'show');
    Route::get('/productByCategory', 'indexProductsByCategory');
    Route::get('/getProduct/{Product}', 'indexProduct');
    Route::get('/showProduct/{Product}', 'showProduct');
});

Route::group(['prefix'=>'Search', 'controller'=>ProductController::class], function(){
    Route::get('/products', 'index');
    Route::get('/getProduct', 'indexProduct')->name('search');
    Route::group(['prefix'=>'Root', 'middleware'=>['auth', 'role:admin']], function(){
        Route::get('/productsAdmin/{redirect}', 'showProducts');
        Route::get('/productsAdminDatatable', 'indexDatatable');
        Route::post('/createProduct', 'store');
        Route::post('/editProduct/{Product}', 'update');
        Route::delete('/deleteProduct/{Product}', 'destroy');
    });
});

Route::get('/', function () {
    return view('home');
});

//Auth::routes();
Route::group(['prefix'=>'login',  'controller'=>LoginController::class], function (){
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});
// Registration Routes...
Route::group(['prefix'=>'register',  'controller'=>RegisterController::class], function (){
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::get('/create', 'store')->name('register.create');
});
// Password Reset Routes...
Route::group(['prefix'=>'forgot',  'controller'=>ForgotPasswordController::class], function () {
    Route::get('/password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
});
Route::group(['prefix'=>'reset', 'middleware'=>['auth'], 'controller'=>ResetPasswordController::class], function () {
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('/password/reset', 'reset')->name('password.update');
});
Route::group(['prefix'=>'confirm', 'middleware'=>['auth'], 'controller'=>ConfirmPasswordController::class], function () {
    Route::get('/password/confirm', 'showConfirmForm')->name('password.confirm');
    Route::post('/password/confirm', 'confirm');
});

Route::group(['prefix'=>'verificate', 'middleware'=>['auth'], 'controller'=>VerificationController::class], function () {
    Route::get('/email/verify', 'show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
