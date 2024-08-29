<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('sponsors',SponsorController::class);
});
