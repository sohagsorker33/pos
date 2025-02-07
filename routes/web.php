<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/product-page',[ProductController::class, 'ProductPage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/invoice-page',[InvoiceController::class, 'InvoicePage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/seles-page',[InvoiceController::class, 'SelesPage'])->middleware([TokenVerificationMiddleware::class]);

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



// Product Web api route

Route::post('/create-product',[ProductController::class, 'ProductCreate'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/product-list',[ProductController::class, 'ProductList'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/update-product',[ProductController::class, 'ProductUpdate'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/delete-product',[ProductController::class, 'ProductDelete'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/product-by-id',[ProductController::class, 'ProductById'])->middleware([TokenVerificationMiddleware::class]);


// Invoice Web Api Route

Route::post('/create-invoice',[InvoiceController::class, 'InvoiceCreate'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/invoice-select',[InvoiceController::class, 'InvoiceSelect'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/invoice-details',[InvoiceController::class, 'InvoiceDetails'])->middleware([TokenVerificationMiddleware::class]);

Route::post('/invoice-delete',[InvoiceController::class, 'InvoiceDelete'])->middleware([TokenVerificationMiddleware::class]);