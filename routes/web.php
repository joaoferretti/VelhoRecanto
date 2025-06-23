<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DesenhosController;
use App\Http\Controllers\DesafiosController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return view('desenhos.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DesenhosController::class, 'index'])->name('desenhos.index');
    Route::resource('desenhos', DesenhosController::class);
    Route::resource('desafios', DesafiosController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
