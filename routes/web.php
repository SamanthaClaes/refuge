<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('animals', function () {
    return view('animals');
})->name('animals');

Route::get('details', function () {
    return view('details');
})->name('details');

Route::livewire('admin/animals', 'pages::animal.index')->name('admin.animals');
Route::livewire('admin/planning', 'pages::planning.index')->name('admin.planning');
Route::livewire('admin/dashboard', 'pages::dashboard.index')->name('admin.dashboard');
Route::livewire('admin/login', 'pages::login.index')->name('admin.login');
Route::livewire('admin/messages', 'pages::messages.index')->name('admin.messages');



