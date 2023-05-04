<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ApiController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\PlacesController;
use App\Http\Controllers\Backend\BookingController;
use App\Http\Controllers\Backend\EmotionController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\FestivalController;
use App\Http\Controllers\Backend\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//CMS Endpoints
//Main Endpoints
Route::apiResource('places', PlacesController::class);
Route::apiResource('festivals', FestivalController::class);
Route::apiResource('emotions', EmotionController::class);
Route::apiResource('activities', ActivityController::class);
//Utility
Route::get('locations', [LocationController::class, "index"]);
Route::post('places/add/activity', [PlacesController::class, "addActivity"]);
Route::post('places/remove/activity', [PlacesController::class, "removeActivity"]);
Route::post('festivals/add/activity', [FestivalController::class, "addActivity"]);
Route::post('festivals/remove/activity', [FestivalController::class, "removeActivity"]);
Route::post('emotions/remove/relation', [EmotionController::class, "removeAssociation"]);

//Admin
Route::apiResource('users', UserController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('bookings', BookingController::class);

//Mobile Endpoints
//Auth
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/reset', [AuthController::class, 'reset']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);

//SMS Verification
Route::post('/auth/user/verified', [AuthController::class, 'userVerified']);
Route::post('/auth/verify/phone', [AuthController::class, 'verifyPhone']);
Route::post('/auth/verify/otp', [AuthController::class, 'verifyOtp']);

//Notification
Route::post('notification/sms', [NotificationController::class, 'sendSMS']);
Route::post('notification/email', [NotificationController::class, 'sendEmail']);


//Utility
Route::get('home/data', [ApiController::class, "getData"]);
Route::post('client/place', [ApiController::class, "favoritePlaces"]);
Route::post('client/place/add', [ApiController::class, "addFavoritePlace"]);
Route::post('client/place/remove', [ApiController::class, "removeFavoritePlace"]);
Route::post('client/festival', [ApiController::class, "favoriteFestivals"]);
Route::post('client/festival/add', [ApiController::class, "addFavoriteFestival"]);
Route::post('client/festival/remove', [ApiController::class, "removeFavoriteFestival"]);

Route::post('bookings/create', [BookingController::class, "storeMobile"]);
Route::get('bookings', [BookingController::class, "index"]);
Route::get('bookings/client/{id}', [ApiController::class, "getClientBookings"]);
