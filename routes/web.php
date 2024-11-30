<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SendMailController;


//login
Route::get('/',[LoginController::class, 'index'])->name('login');
Route::get('register',[LoginController::class, 'register'])->name('register');

Route::post('process_register', [AuthController::class, 'proccess_register'])->name('process_register');
Route::post('process_login', [AuthController::class, 'proccess_login']);

Route::get('home',[AuthController::class, 'home'])->name('home')->middleware('auth')->middleware('can:access-home');
Route::get('hr',[AuthController::class, 'hr_dashboard'])->name('hr_dashboard')->middleware('auth')->middleware('can:access-hr');
Route::get('official',[AuthController::class, 'official_dashboard'])->name('official_dashboard')->middleware('auth')->middleware('can:access-official');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('users',[UserController::class, 'index'])->name('users.index');
Route::get('add-user',[UserController::class, 'create'])->name('users.add');
Route::post('add-user',[UserController::class, 'store'])->name('users.store');
Route::get('user-details/{id}',[UserController::class, 'details'])->name('users.details');
Route::post('update-user/{id}',[UserController::class, 'update'])->name('users.update');
Route::post('disable-user/{id}',[UserController::class, 'disable'])->name('users.disable');


Route::get('clearances',[ClearanceController::class, 'index'])->name('clearance.index');

Route::get('requests',[RequestController::class, 'index'])->name('request.index');




Route::post('send_email', [SendMailController::class, 'Send_email'])->name('send_email');;



