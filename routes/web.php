<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['fr', 'nl' , 'en'])) {
        abort(400);
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('lang.switch');

Route::middleware([SetLocale::class])->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('animals', function () {
        return view('animals');
    })->name('animals');

    Route::get('details', function () {
        return view('details');
    })->name('details');
});


Route::middleware('auth')->group(function () {
    Route::livewire('admin/animals', 'pages::animal.index')->name('admin.animals');
    Route::livewire('admin/planning', 'pages::planning.index')->name('admin.planning');
    Route::livewire('admin/dashboard', 'pages::dashboard.index')->name('admin.dashboard');
    Route::livewire('admin/messages', 'pages::messages.index')->name('admin.messages');
});

