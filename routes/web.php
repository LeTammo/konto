<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetUserLocale;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', SetUserLocale::class])->name('dashboard');

Route::middleware(['auth', SetUserLocale::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/locale/{lang}', [ProfileController::class, 'changeLanguage'])->name('profile.language');
});

require __DIR__.'/auth.php';
