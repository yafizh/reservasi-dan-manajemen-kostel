<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PrintController;
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

Route::prefix('check-outs')->controller(CheckOutController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/{checkIn}', 'store');
    Route::get('/{checkOut}', 'show');
    Route::delete('/{checkOut}', 'destroy');
});

Route::resource('/reservations', ReservationController::class);
Route::patch('/reservations/cancel/{reservation}', [ReservationController::class, 'cancelReservation']);
Route::patch('/reservations/missing-client/{reservation}', [ReservationController::class, 'missingClient']);

Route::prefix('/room-types')->group(function () {
    Route::post('uploads/process', [UploadFileController::class, 'process']);

    Route::get('/rooms', [RoomTypeController::class, 'index']);
    Route::resource('/{roomType}/rooms', RoomController::class);
});
Route::resource('/room-types', RoomTypeController::class);

Route::prefix('/report')->controller(ReportController::class)->group(function () {
    Route::get('/employees', 'employee');

    Route::get('/reservations', 'reservation');
    Route::post('/reservations', 'reservation');
    
    Route::get('/check-ins', 'checkIn');
    Route::post('/check-ins', 'checkIn');

    Route::get('/check-outs', 'checkOut');
    Route::post('/check-outs', 'checkOut');

    Route::get('/available-rooms', 'availableRoom');
    Route::post('/available-rooms', 'availableRoom');

    Route::get('/reservation-chart', 'reservationChart');
    Route::get('/check-in-chart', 'checkInChart');
});

Route::prefix('/print')->controller(PrintController::class)->group(function () {
    Route::get('/employees', 'employee');
    Route::get('/reservations', 'reservation');
    Route::get('/check-ins', 'checkIn');
    Route::get('/check-outs', 'checkOut');
    Route::get('/available-rooms', 'availableRoom');
});
