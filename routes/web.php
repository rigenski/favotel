<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HotelFacilityController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomFacilityController;
use Illuminate\Support\Facades\Route;

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

// HOME
Route::get('/', [Front\IndexController::class, 'index'])->name('home');
Route::get('/rooms', [Front\RoomController::class, 'index'])->name('rooms');
Route::get('/hotel-facilities', [Front\HotelFacilityController::class, 'index'])->name('hotel-facilities');

// AUTH GUEST
Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');
Route::post('/register/post', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'indexLogin'])->name('login');
Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');

Route::group(['middleware' => ['auth', 'checkRole:guest']], function () {
  // GUEST AREA
  Route::get('/guest', [Front\GuestController::class, 'index'])->name('guest');
  Route::post('/guest/update', [Front\GuestController::class, 'update'])->name('guest.update');
  Route::get('/checkout', [Front\CheckoutController::class, 'index'])->name('checkout');
  Route::post('/checkout/store', [Front\CheckoutController::class, 'store'])->name('checkout.store');
  Route::get('/result', [Front\ResultController::class, 'index'])->name('result');
  Route::get('/result/{id}/print', [Front\ResultController::class, 'print'])->name('result.print');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
  // ROOMS
  Route::get('/admin/rooms', [RoomController::class, 'index'])->name('admin.rooms');
  Route::post('/admin/rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
  Route::post('/admin/rooms/{id}/update', [RoomController::class, 'update'])->name('admin.rooms.update');
  Route::get('/admin/rooms/{id}/destroy', [RoomController::class, 'destroy'])->name('admin.rooms.destroy');

  // ROOM FACILITIES
  Route::get('/admin/room-facilities', [RoomFacilityController::class, 'index'])->name('admin.room-facilities');
  Route::post('/admin/room-facilities/store', [RoomFacilityController::class, 'store'])->name('admin.room-facilities.store');
  Route::post('/admin/room-facilities/{id}/update', [RoomFacilityController::class, 'update'])->name('admin.room-facilities.update');
  Route::get('/admin/room-facilities/{id}/destroy', [RoomFacilityController::class, 'destroy'])->name('admin.room-facilities.destroy');

  // HOTEL FACILITIES
  Route::get('/admin/hotel-facilities', [HotelFacilityController::class, 'index'])->name('admin.hotel-facilities');
  Route::post('/admin/hotel-facilities/store', [HotelFacilityController::class, 'store'])->name('admin.hotel-facilities.store');
  Route::post('/admin/hotel-facilities/{id}/update', [HotelFacilityController::class, 'update'])->name('admin.hotel-facilities.update');
  Route::get('/admin/hotel-facilities/{id}/destroy', [HotelFacilityController::class, 'destroy'])->name('admin.hotel-facilities.destroy');

  // GUESTS
  Route::get('/admin/guests', [GuestController::class, 'index'])->name('admin.guests');
  Route::get('/admin/guests/{id}/destroy', [GuestController::class, 'destroy'])->name('admin.guests.destroy');

  // RECEPTIONIST
  Route::get('/admin/receptionists', [ReceptionistController::class, 'index'])->name('admin.receptionists');
  Route::post('/admin/receptionists/store', [ReceptionistController::class, 'store'])->name('admin.receptionists.store');
  Route::post('/admin/receptionists/{id}/update', [ReceptionistController::class, 'update'])->name('admin.receptionists.update');
  Route::get('/admin/receptionists/{id}/destroy', [ReceptionistController::class, 'destroy'])->name('admin.receptionists.destroy');

  // HOTEL
  Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting');
  Route::post('/admin/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
});


Route::group(['middleware' => ['auth', 'checkRole:receptionist']], function () {
  // RESERVATIONS
  Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations');
  Route::post('/admin/reservations/{id}/update', [ReservationController::class, 'update'])->name('admin.reservations.update');
  Route::get('/admin/reservations/{id}/destroy', [ReservationController::class, 'destroy'])->name('admin.reservations.destroy');
  Route::get('/admin/reservations/{id}/print', [ReservationController::class, 'print'])->name('admin.reservations.print');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,receptionist']], function () {
  // ADMIN
  Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,receptionist,guest']], function () {
  // AUTH
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
