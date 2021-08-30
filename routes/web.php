<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrossSectionController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cross-sections/',                      [CrossSectionController::class,'index'])->name('cross_sections.index')->middleware('auth');;
Route::get('/cross-sections/create',                [CrossSectionController::class,'create'])->name('cross_sections.create')->middleware('auth');
Route::get('/cross-sections/edit/{crosssection}',   [CrossSectionController::class,'edit'])->name('cross_sections.edit')->middleware('auth');
Route::post('/cross-sections',                      [CrossSectionController::class,'store'])->name('cross_sections.store')->middleware('auth');
Route::post('/cross-sections/{crosssection}',       [CrossSectionController::class,'update'])->name('cross_sections.update')->middleware('auth');
Route::delete('/cross-sections/{crosssection}',     [CrossSectionController::class,'destroy'])->name('cross_sections.delete')->middleware('auth');

