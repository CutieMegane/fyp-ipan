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
/*
Route::get('/analysis', function (){
    return view('analysis');
});*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);
Route::get('/dynamicViews', [dynamicPage::class, 'index'])->name('dynamic.index');
Route::post('/dynamicViews/create',[dynamicPage::class, 'create'])->name('dynamic.create');
Route::get('/dynamicViews/index2', [dynamicPage::class, 'index2'])->name('dynamic.index2'); //debug


Route::resource('/table', tableController::class)->middleware('auth'); //Dynamic Table
Route::post('/table/create', [tableController::class, 'create2'])->name('table.create')->middleware('auth');
//Route::get('/table/edit', [tableController::class, 'edit'])->name('table.edit');
Route::get('/table/pagekosong', [tableController::class, 'pagekosong'])->name('table.pagekosong')->middleware('auth');