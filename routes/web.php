<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();


// Auth routes
Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/reservation', 'ReservationController@index');
});

// Auth and Admin routes
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/material', 'MaterialController@index');
});