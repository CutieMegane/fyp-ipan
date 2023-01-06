<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrafficDataController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('users/import/', [UsersController::class, 'import']);
Route::resource('/users', UserController::class);
Route::resource('/traffics', TrafficDataController::class);
Route::post('/import', [TrafficDataController::class, 'import'])->name('traffic.import');
Route::get('/traffics/index',[TrafficDataController::class, 'import'])->name('traffic.index');

