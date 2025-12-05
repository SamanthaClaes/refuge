<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('admin.login');
})->name('login');

Route::get('dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('messages', function () {
    return view('admin.messages');
})->name('messages');

Route::livewire('admin/animals', 'pages::animal.index')->name('admin.animals');

Route::get('planning', function () {
    return view('admin.planning');
})->name('planning');

Route::get('animals', function () {
    return view('animals');
})->name('animals');

Route::get('details', function () {
    return view('details');
})->name('details');
