<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('students.index');
});

Route::get('/add',function(){
    return view('students.add');
});
