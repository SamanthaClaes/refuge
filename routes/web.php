<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PublicAnimalController;
use App\Http\Livewire\Pages\Dashboard\Dashboard;
use App\Http\Livewire\Pages\DashboardMessage;
use App\Http\Livewire\Pages\Volunteer;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use livewire\pages\animal\⚡index\AnimalPages;


Route::get('/admin/dashboard/pdf', [DashBoardController::class, 'downloadPdf'])
    ->name('admin.dashboard.pdf');
Route::post('/logout', [LogOutController::class, 'index'])->name('logout');
Route::get('/lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['fr', 'nl', 'en'])) {
        abort(400);
    }

    Session::put('locale', $locale);

    return redirect()->back();
})->name('lang.switch');

<<<<<<< Updated upstream
Route::middleware([SetLocale::class])->group(function (){
    Route::get('/', [PublicAnimalController::class, 'welcome'])->name('welcome');
=======
Route::middleware([SetLocale::class])->group(function () {
    Route::get('/', [PublicAnimalController::class, 'welcome']);
>>>>>>> Stashed changes
    Route::get('animals', [PublicAnimalController::class, 'index'])->name('animals.index');
    Route::get('/animals/{animal}', [PublicAnimalController::class, 'show'])->name('animals.show');
});


Route::middleware('auth')->group(function () {
<<<<<<< Updated upstream
    Route::livewire('admin/animals',  'pages::animals.index')->name('admin.animals');
=======
    Route::livewire('admin/animals', 'pages::animals.index')->name('admin.animals');
>>>>>>> Stashed changes
    Route::livewire('admin/planning', 'pages::volunteer')->name('admin.planning');
    Route::livewire('admin/dashboard', 'pages::dashboard.index')->name('admin.dashboard');
    Route::livewire('admin/messages', 'pages::dashboard.messages')->name('admin.messages');
});

