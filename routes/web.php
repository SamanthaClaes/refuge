<?php

use App\Http\Controllers\PublicAnimalController;
use App\Http\Livewire\Pages\Animal\AnimalPages;
use App\Http\Livewire\Pages\Dashboard\Dashboard;
use App\Http\Livewire\Pages\DashboardMessage;
use App\Http\Livewire\Pages\Volunteer;
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
    Route::get('/', [PublicAnimalController::class, 'welcome']);
    Route::get('animals', [PublicAnimalController::class, 'index'])->name('animals.index');
    Route::get('/animals/{animal}', [PublicAnimalController::class, 'show'])->name('animals.show');


});


Route::middleware('auth')->group(function () {
    Route::livewire('admin/animals', AnimalPages::class)->name('admin.animals');
    Route::livewire('admin/planning', Volunteer::class)->name('admin.planning');
    Route::livewire('admin/dashboard', \App\Http\Livewire\Pages\Dashboard::class)
        ->name('admin.dashboard');
    Route::livewire('admin/messages', DashboardMessage::class )->name('admin.messages');
});

