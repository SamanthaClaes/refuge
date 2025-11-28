<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function (){
    return view('admin.dashboard');
});
Route::get('messages', function (){
    return view('admin.messages');
});

Route::get('animal', function (){
    return view('admin.animal');
});

Route::get('planning', function (){
    return view('admin.planning');
});

Route::get('animals', function (){
    return view('animals');
});

Route::get('details', function (){
    return view('details');
});
