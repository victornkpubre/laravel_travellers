<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [AuthController::class, 'index'])->name('login.view');
Route::post('login', [AuthController::class, 'postLogin'])->name('login');
Route::get('registration', [AuthController::class, 'registration'])->name('register.view');
Route::post('registration', [AuthController::class, 'postRegistration'])->name('register');
Route::post('logout', [AuthController::class, 'signOut'])->name('logout');
Route::get('/user/email/verify/{token}', [AuthController::class, "verifyAccountEmail"])->name("user.verify.email");
Route::get('/client/email/verify/{token}', [AuthController::class, "verifyClientAccountEmail"])->name("client.verify.email");

//Notifications
Route::get('notification/email/invoice', [NotificationController::class, 'sendInvoiceEmail']);

//Google Auth
Route::get('/login/google', [GoogleController::class, "redirectToGoogle"])->name("login.google");
Route::get('/public/login/google/callback', [GoogleController::class, "handleGoogleRedirect"]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'email_verified'])->group(function () {
    Route::get( "{any}", function() {
        return view("backend.dashboard");
    })->where("any", ".*");
});



