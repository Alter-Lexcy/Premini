<?php

use App\Http\Controllers\SponsorController;
use App\Http\Controllers\attendeController;
use App\Http\Controllers\venueController;
use App\Http\Controllers\artisController;

use App\Http\Controllers\CategoriController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();


Route::middleware(['auth'])->group(function (){
Route::get('/', function () {return view('dasboard');});
Route::resource('sponsors',SponsorController::class);
Route::resource('attendes', attendeController::class);
Route::resource('venues', venueController::class);
Route::resource('artiss', artisController::class);
Route::resource('categoris', CategoriController::class);
Route::resource('event',EventController::class);
Route::resource('tiket',TiketController::class);
Route::resource('roadmap', RoadmapController::class);
});

