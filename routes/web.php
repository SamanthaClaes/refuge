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

Route::get('voluntary', function (){
    return view('admin.voluntary');
});

Route::get('animals', function (){
    return view('animals');
});

Route::get('details', function (){
    return view('details');
});
