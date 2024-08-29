<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\attendeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('sponsors',SponsorController::class);
Route::resource('attende', attendeController::class);

});
