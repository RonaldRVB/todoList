<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');  // Affiche la liste des tâches
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Ajoute une nouvelle tâche
    Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update'); // Met à jour le statut d'une tâche (complétée ou non)
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Supprime une tâche
});

require __DIR__.'/auth.php';






