<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Workbook;
use App\Livewire\Schedule;
use App\Livewire\Analysis;
use App\Livewire\Home\Home;

Route::get('/', Home::class);
Route::get('/workbook', Workbook::class);
Route::get('/schedule', Schedule::class);
Route::get('/analysis', Analysis::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
