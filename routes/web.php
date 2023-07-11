<?php

use App\Http\Controllers\dynamicPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\tableController;

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
    return redirect()->route('table.index');
});

Route::get('/chartjs', function (){
    return view('chartjs');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
Route::get('/dynamicViews', [dynamicPage::class, 'index'])->name('dynamic.index');
Route::post('/dynamicViews/create',[dynamicPage::class, 'create'])->name('dynamic.create');
Route::get('/dynamicViews/index2', [dynamicPage::class, 'index2'])->name('dynamic.index2'); //debug

Route::get('/table/analytic', [tableController::class, 'analytic'])->name('table.analytic')->middleware('auth');
Route::post('/table/analyse', [tableController::class, 'analyse'])->name('table.analyse')->middleware('auth');
Route::resource('/table', tableController::class)->middleware('auth'); //Dynamic Table
Route::post('/table/create', [tableController::class, 'create2'])->name('table.create')->middleware('auth');
