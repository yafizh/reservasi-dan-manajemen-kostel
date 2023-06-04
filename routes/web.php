<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.pages.dashboard.index');
});

Route::resource('/admin', AdminController::class);
Route::resource('/employees', EmployeeController::class);
Route::resource('/check-ins', CheckInController::class);
Route::resource('/check-outs', CheckOutController::class)->except('create');
Route::resource('/reservations', ReservationController::class);

Route::prefix('/room-types')->group(function () {
    Route::post('uploads/process', [UploadFileController::class, 'process']);
    
    Route::get('/rooms', [RoomTypeController::class, 'index']);
    Route::resource('/{roomType}/rooms', RoomController::class);
});
Route::resource('/room-types', RoomTypeController::class);

Route::prefix('/report')->controller(ReportController::class)->group(function () {
    Route::get('/reservations', 'reservation');
    Route::get('/check-ins', 'checkIn');
    Route::get('/check-outs', 'checkOut');
    Route::get('/available-rooms', 'availableRoom');
    Route::get('/reservation-chart', 'reservationChart');
    Route::get('/check-in-chart', 'checkInChart');
});