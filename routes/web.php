<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobCardController;

Route::get('/', [JobCardController::class, 'index'])->name('job_cards.index');

Route::get('/create', [JobCardController::class, 'create'])->name('job_cards.create');

Route::post('/store', [JobCardController::class, 'store'])->name('job_cards.store');

Route::get('/job-cards/{id}', [JobCardController::class, 'show'])->name('job_cards.show');

Route::get('/job-cards/{id}/edit', [JobCardController::class, 'edit'])->name('job_cards.edit');

Route::put('/job-cards/{id}', [JobCardController::class, 'update'])->name('job_cards.update');

Route::delete('/job-cards/{id}', [JobCardController::class, 'destroy'])->name('job_cards.destroy');
