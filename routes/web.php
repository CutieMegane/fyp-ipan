<?php

use App\Http\Controllers\dynamicPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\tableController;
use App\Http\Controllers\trafficAnalyze;

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
    if (env('APP_ROUTEPATH')  == 2)
        return redirect()->route('new.home');
    else
        return redirect()->route('table.index');
});

/*
Route::get('/chartjs', function (){
    return view('chartjs');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Legacy
Route::get('/users/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');  //for what?
Route::get('/dynamicViews', [dynamicPage::class, 'index'])->name('dynamic.index');
Route::post('/dynamicViews/create',[dynamicPage::class, 'create'])->name('dynamic.create');
Route::get('/dynamicViews/index2', [dynamicPage::class, 'index2'])->name('dynamic.index2');     //debug
*/

#Auth
Auth::routes();

#table upload, and listing.
Route::get('/table/analytic', [tableController::class, 'analytic'])->name('table.analytic')->middleware('auth');
Route::post('/table/analyse', [tableController::class, 'analyse'])->name('table.analyse')->middleware('auth');
Route::post('/table/create', [tableController::class, 'create2'])->name('table.create')->middleware('auth');
Route::resource('/table', tableController::class)->middleware('auth'); 

#Users
Route::resource('/users', UserController::class);

#New flow, set .env APP_ROUTEPATH=2
Route::get('/home', [trafficAnalyze::class, 'index'])->name('new.home')->middleware('auth');
Route::get('/upload', [trafficAnalyze::class, 'upload'])->name('new.upload')->middleware('auth');
Route::post('/upload', [trafficAnalyze::class, 'create'])->name('new.create')->middleware('auth');
Route::get('/tabel', [trafficAnalyze::class, 'table'])->name('new.table')->middleware('auth');
Route::match(['get', 'post'], '/analyze', [trafficAnalyze::class, 'analyze'])->name('new.analyze')->middleware('auth');