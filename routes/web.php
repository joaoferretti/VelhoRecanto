<?php

use App\Http\Controllers\DesenhoController;
use App\Http\Controllers\DesafioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('desenhos');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('desenhos', DesenhoController::class);
    Route::resource('desafios', DesafioController::class);
});
