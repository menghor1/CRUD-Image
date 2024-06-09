<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
Route::get('/getstudent',[StudentController::class,'getAllStudent']);
Route::get('/getstudent/{id}',[StudentController::class,'getStudentByID']);
Route::post('/addstudent',[StudentController::class,'addStudent']);
Route::put('/update/{id}',[StudentController::class,'updateStudent']);
Route::delete('/delete/{id}',[StudentController::class,'deleteStudent']);

});


Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);