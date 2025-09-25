<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;

// routes/web.php
Route::get('/', fn() => redirect()->route('movies.index'));



Route::middleware(['auth'])->group(function () {
    Route::resource('movies', MovieController::class);
    Route::patch('/movies/{movie}/toggle-watched', [MovieController::class, 'toggleWatched'])->name('movies.toggleWatched');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';