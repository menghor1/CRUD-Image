<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){

Route::get('/',[StudentsController::class,'index']);
Route::get('/add',[StudentsController::class,'openAdd']);
Route::post('/add',[StudentsController::class,'add']);
Route::get('/view',[StudentsController::class,'view']);
Route::get('/update/{id}',[StudentsController::class,'openUpdate']);
Route::put('/update',[StudentsController::class,'update']);
Route::delete('/delete',[StudentsController::class,'delete']);
Route::get('/search',[StudentsController::class,'search']);

Route::get('/logout',[UserController::class,'openlogout']);
Route::post('/logout',[UserController::class,'logout']);



});

Route::get('/login',[UserController::class,'openlogin'])->name('login');
Route::post('/login',[UserController::class,'login']);
Route::get('/register',[UserController::class,'openRegister']);
Route::post('/register',[UserController::class,'register']);