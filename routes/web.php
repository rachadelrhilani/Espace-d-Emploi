<?php

use App\Http\Controllers\AmitieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
        // routes/web.php
Route::post('/friends/request', [AmitieController::class, 'send'])
    ->name('friends.request');

Route::get('/friends/status/{user}', [AmitieController::class, 'status'])
    ->name('friends.status');

    Route::post('/amis/{user}', [AmitieController::class, 'store'])
    ->name('amis.add');
    Route::get('/invitations', [AmitieController::class, 'invitations'])
    ->name('amis.invitations');

Route::post('/amis/{amitie}/accept', [AmitieController::class, 'accept'])
    ->name('amis.accept');

Route::post('/amis/{amitie}/reject', [AmitieController::class, 'reject'])
    ->name('amis.reject');


    Route::get('/profil/{user}', [ProfileController::class, 'show'])
        ->name('users.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
