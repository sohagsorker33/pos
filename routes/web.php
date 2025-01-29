<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CustomerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Web Backend Api Route

Route::post('/user-register',[UserController::class, 'userRegistration']);

Route::post('/user-login',[UserController::class, 'userLogin']);

Route::post('/send-otp',[UserController::class, 'sendOTPCode']);

Route::post('/verify-otp',[UserController::class, 'verifyOTPCode']);
/* verify-otp */
Route::post('/reset-password',[UserController::class, 'resetPassword'])
->middleware([TokenVerificationMiddleware::class]);


//  Frontend Page Route


Route::get('/register-page',[UserController::class, 'registerPage']);

Route::get('/login-page',[UserController::class, 'loginPage']);

Route::get('/send-otp-page',[UserController::class, 'sendOTPPage']);

Route::get('/verify-otp-page',[UserController::class, 'verifyOTPPage']);

Route::get('/reset-password-page',[UserController::class, 'resetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/dashboard-page',[UserController::class, 'dashboardPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/profile-page',[UserController::class, 'ProfilePage'])->name('profile-page')->middleware([TokenVerificationMiddleware::class]);

Route::get('/category-page',[CategorieController::class, 'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/customer-page',[CustomerController::class, 'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);





// Logout Route

Route::get('/logout',[UserController::class, 'UserLogout'])->name('logout');

Route::get('/user-profile',[UserController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-profile',[UserController::class, 'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);


// Category web api route

Route::post('/create-category',[CategorieController::class, 'CreateCategory'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/category-list',[CategorieController::class, 'CategoryList'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/delete-category',[CategorieController::class, 'DeleteCategory'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-category',[CategorieController::class, 'UpdateCategory'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/category-by-id',[CategorieController::class, 'CategoryByID'])->middleware([TokenVerificationMiddleware::class]);



// Customer Web api route

Route::post('/create-customer',[CustomerController::class, 'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/customer-list',[CustomerController::class, 'CustomerList'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-customer',[CustomerController::class, 'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/delete-customer',[CustomerController::class, 'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/customer-by-id',[CustomerController::class, 'CustomerById'])->middleware([TokenVerificationMiddleware::class]);