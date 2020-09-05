<?php

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Material;
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
    Route::get('/material', 'MaterialController@index');
});

// Auth and Admin routes
Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/material', 'Admin\MaterialController@index');
});

/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
| Restful API
|
*/

// Auth routes
Route::prefix('resources')->middleware('auth')->group(function () {
    // user
    Route::get('/me', function() {
        return Auth::user();
    });
    
    // categories
    Route::get('/categories', function () {
        return Category::all();
    });

    // materials
    Route::get('/materials', function () {
        return Material::all();
    });
});

// Auth and Admin routes
Route::prefix('resources')->middleware(['auth', 'admin:api'])->group(function () {
    
});