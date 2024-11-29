<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


//login
Route::get('/',[LoginController::class, 'index'])->name('login');
Route::get('register',[LoginController::class, 'register']);

Route::post('process_register', [AuthController::class, 'proccess_register'])->name('process_register');
Route::post('process_login', [AuthController::class, 'proccess_login']);

//user route by roles
Route::get('home',[AuthController::class, 'home'])->name('home')->middleware('auth')->middleware('can:access-home');
Route::get('official',[AuthController::class, 'official_dashboard'])->name('official_dashboard')->middleware('auth')->middleware('can:access-official');

Route::get('users',[UserController::class, 'index'])->name('users');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');



