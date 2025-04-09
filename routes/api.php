<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\api\OpeningHourController;
use App\Http\Controllers\api\SelectController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\PricingController;
use App\Http\Controllers\api\PaymentMethodController;
use App\Http\Controllers\api\MapController;
use App\Http\Controllers\api\CalendarController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FieldTypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;

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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Public Routes
Route::get('/venue/get-location',[VenueController::class, 'getLocation']);
Route::get('/venue/get-image',[VenueController::class, 'getImage']);
Route::delete('/venue/{id}/destroy-image',[VenueController::class, 'destroyImage']);
Route::get('/venue',[VenueController::class, 'getData']);
Route::get('/field',[FieldController::class, 'getData']);
Route::get('/admin',[AdminController::class, 'getData']);
Route::get('/owner',[OwnerController::class, 'getData']);
Route::get('/customer',[CustomerController::class, 'getData']);
Route::get('/field-type',[FieldTypeController::class, 'getData']);
Route::get('/facility',[FacilityController::class, 'getData']);
Route::get('/venue/opening-hour',[OpeningHourController::class, 'getData']);
Route::get('/venue/opening-hour/day',[OpeningHourController::class, 'getDay']);
Route::post('/venue/opening-hour',[OpeningHourController::class, 'storeData']);
Route::get('/select/field/{id}',[SelectController::class, 'getDataField']);
Route::get('/select/schedule',[SelectController::class, 'getDataSchedule']);
Route::get('/select/editSchedule',[SelectController::class, 'editDataSchedule']);
Route::get('/booking',[BookingController::class, 'getData']);//Message
Route::get('/booking/extend',[BookingController::class, 'extend']);//Message
Route::get('/booking/apiEdit',[BookingController::class, 'apiEdit']);//Message
Route::get('/message/send_message',[MessageController::class, 'sendMessage'])->name('message.sendMessage');
Route::get('/history',[HistoryController::class, 'getData']);

Route::post('/pricing/set-price', [PricingController::class, 'setPrice']);
Route::post('/payment/add-paymentMethod', [PaymentMethodController::class, 'addPaymentMethod']);
Route::post('/map/get-venueAround', [MapController::class, 'getVenueAround']);

Route::get('/get-calendar', [CalendarController::class, 'getCalendar']);
