<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;


//login
Route::get('/',[LoginController::class, 'index'])->name('login');

Route::get('register',[LoginController::class, 'register']);
Route::post('process_register', [AuthController::class, 'proccess_register'])->name('process_register');
Route::post('process_login', [AuthController::class, 'proccess_login']);
Route::get('home',[AuthController::class, 'home'])->name('home')->middleware('auth')->middleware('can:access-home');
Route::get('official',[AuthController::class, 'official_dashboard'])->name('official_dashboard')->middleware('auth')->middleware('can:access-official');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('users',[UserController::class, 'index'])->name('users.index');
Route::get('add-user',[UserController::class, 'create'])->name('users.add');
Route::post('add-user',[UserController::class, 'store'])->name('users.store');
Route::get('user-details/{id}',[UserController::class, 'details'])->name('users.details');
Route::post('update-user/{id}',[UserController::class, 'update'])->name('users.update');
Route::post('disable-user/{id}',[UserController::class, 'disable'])->name('users.disable');


Route::get('clearances',[ClearanceController::class, 'index'])->name('clearance.index');
Route::post('clearance-store',[ClearanceController::class, 'store'])->name('clearance.store');
Route::get('clearance-update/{id}',[ClearanceController::class, 'update'])->name('clearance.update');

Route::get('requests',[RequestController::class, 'index'])->name('request.index');





