<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AcoesController;
use App\Http\Controllers\CampanhasController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return view('acoes.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [AcoesController::class, 'index'])->name('acoes.index');
Route::resource('acoes', AcoesController::class)->parameters([
    'acoes' => 'acao'
]);
Route::resource('campanhas', CampanhasController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
