<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
Route::get('/', [PageController::class, 'home'])->name('home');

use App\Http\Controllers\BookingController;
Route::get('/booking/form', [BookingController::class, 'form'])->name('booking.form');
Route::post('/booking/form', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/thank-you', function () {
    return view('booking.thankyou');
})->name('booking.thankyou');



