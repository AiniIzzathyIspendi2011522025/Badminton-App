<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FieldTypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommerceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ExtendController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PromoController;

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
    return redirect()->route('landing.index');
});

Route::get('/admin', function () {
    return view('auth.login');
});

Route::get('/forgot-password', function () {
    return view('auth.passwords.reset');
});
Route::post('/forgot-password/send', [AuthController::class, 'forgetPasswordAct']);
Route::get('/forgot-password/validate/{token}', [AuthController::class, 'forgetPasswordValidate']);
Route::post('/forgot-password/validate-act', [AuthController::class, 'forgetPasswordValidateAct']);

Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/landing/{id}/sortType', [LandingPageController::class, 'sortType'])->name('landing.sortType');
Route::get('/landing/index', [LandingPageController::class, 'index'])->name('landing.index');
Route::post('/landing/find', [LandingPageController::class, 'find'])->name('landing.find');
Route::get('/landing/commerce', [CommerceController::class, 'index'])->name('commerce.index');
Route::get('/landing/{id}/commerce', [CommerceController::class, 'show'])->name('commerce.show');
Route::get('/landing/commerce/sortByName', [LandingPageController::class, 'sortByName'])->name('commerce.sortByName');
Route::post('/landing/commerce/sortByAround', [LandingPageController::class, 'sortByAround'])->name('commerce.sortByAround');
Route::get('/landing/commerce/sortByType', [LandingPageController::class, 'sortByType'])->name('commerce.sortByType');

//membership
Route::get('/membership/{id}', [MembershipController::class, 'index'])->name('membership.index');
Route::post('/membership/{id}', [MembershipController::class, 'pay'])->name('membership.pay');

Route::prefix('admin')->middleware(['auth', 'auth.thisAdmin'])->name('admin.')->group(function () {
    Route::resource('/admin', AdminController::class);
    Route::resource('/owner', OwnerController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/facility', FacilityController::class);
    Route::resource('/field-type', FieldTypeController::class);
    //venue
    Route::get('/venue/index-admin', [VenueController::class, 'index_admin'])->name('venue.index.admin');
    Route::patch('/venue/{id}/confirm', [VenueController::class, 'confirm'])->name('venue.confirm');
    Route::patch('/venue/{id}/reject', [VenueController::class, 'reject'])->name('venue.reject');
    Route::get('/venue/{id}/show-index', [VenueController::class, 'show_index'])->name('venue.show-index');

    Route::get('/venue/index1-admin', [VenueController::class, 'index1_admin'])->name('venue.index1.admin');
    Route::get('/venue/{id}/show1-index', [VenueController::class, 'show1_index'])->name('venue.show1-index');

    Route::get('/venue/index2-admin', [VenueController::class, 'index2_admin'])->name('venue.index2.admin');
    Route::get('/venue/{id}/show2-index', [VenueController::class, 'show2_index'])->name('venue.show2-index');

    Route::get('/booking/index-admin', [BookingController::class, 'index_admin'])->name('booking.index.admin');

    Route::resource('/profil', ProfilController::class);
});

Route::prefix('owner')->middleware(['auth', 'auth.thisOwner'])->name('owner.')->group(function () {
    Route::resource('/venue', VenueController::class);
    Route::resource('/field', FieldController::class);
    Route::resource('/booking', BookingController::class);
    Route::patch('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    Route::resource('/history', HistoryController::class);
    Route::get('/history/{id}/show', [HistoryController::class, 'show'])->name('history.show');
    Route::get('/booking/{id}/show', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{id}/finish', [BookingController::class, 'finish'])->name('booking.finish');
    Route::patch('/booking/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::patch('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::patch('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    Route::resource('/admin', AdminController::class);
    Route::resource('/profil', ProfilController::class);
    Route::get('/report/index', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/preview', [ReportController::class, 'preview'])->name('report.preview');
    Route::post('/report/print', [ReportController::class, 'print'])->name('report.print');
    //Field
    Route::get('/venue/{id}/field-create', [FieldController::class, 'fieldCreate'])->name('venue.field.create');
    Route::post('/venue/{id}/field-store', [FieldController::class, 'fieldStore'])->name('venue.field.store');
    Route::patch('/venue/{id}/field-update', [FieldController::class, 'fieldUpdate'])->name('venue.field.update');
    Route::get('/venue/{id}/field-show', [FieldController::class, 'fieldShow'])->name('venue.field-show');
    Route::get('/venue/{id}/fieldSchedule-edit', [FieldController::class, 'fieldScheduleEdit'])->name('venue.fieldScheduleEdit');
    Route::patch('/venue/{id}/fieldSchedule-update', [FieldController::class, 'fieldScheduleUpdate'])->name('venue.fieldScheduleUpdate');

    Route::get('/chat/index-owner', [ChatController::class, 'index_owner'])->name('chat.index.owner');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');

    Route::post('/extend/{id}/extendBooking', [ExtendController::class, 'extendBooking'])->name('extend.extendBooking');

    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('auth.changePassword');
    Route::post('/change-password/store', [AuthController::class, 'storeChangePassword'])->name('auth.changePassword.store');

    Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
    Route::get('/promo/create', [PromoController::class, 'create'])->name('promo.create');
    Route::post('/promo', [PromoController::class, 'store'])->name('promo.store');
    Route::get('/promo/{promo}', [PromoController::class, 'destroy'])->name('promo.destroy');
    Route::get('/promo/{promo}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/promo/{promo}', [PromoController::class, 'update'])->name('promo.update');

    //membership
    Route::get('/membership', [MembershipController::class, 'owner'])->name('membership.owner');
    Route::get('/membership/{id}', [MembershipController::class, 'show'])->name('membership.show');
    Route::get('/membership/{id}/confirm', [MembershipController::class, 'confirm'])->name('membership.confirm');
    Route::get('/membership/{id}/reject', [MembershipController::class, 'reject'])->name('membership.reject');
});

Route::prefix('customer')->middleware(['auth', 'auth.thisCustomer'])->name('customer.')->group(function () {
    Route::resource('/venue', VenueController::class);
    Route::resource('/field', FieldController::class);
    Route::resource('/booking', BookingController::class);
    Route::resource('/history', HistoryController::class);
    Route::resource('/payment', PaymentController::class);
    Route::get('/payment/{id}/detail-payment', [PaymentController::class, 'detailPayment'])->name('payment.detailPayment');
    Route::post('/payment/booking', [PaymentController::class, 'booking'])->name('payment.booking');
    Route::post('/payment/{id}/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::resource('/commerce', CommerceController::class);
    Route::resource('/chat', ChatController::class);
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::resource('/profil', ProfilController::class);

    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('auth.changePassword');
    Route::post('/change-password/store', [AuthController::class, 'storeChangePassword'])->name('auth.changePassword.store');

    //Route check diskon
    Route::post('/diskon', [PromoController::class, 'check'])->name('promo.check');
    Route::get('/diskon/hapus', [PromoController::class, 'delete'])->name('promo.delete');
});

//Route Cetak Laporan
Route::get('/booking/{id}/cetak', [CetakController::class, 'booking'])->name('booking.cetak');
