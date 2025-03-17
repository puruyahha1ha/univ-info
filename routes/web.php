<?php

use Illuminate\Support\Facades\Route;
// use App\Livewire\Workbook;
use App\Livewire\Workbook\Workbook;
use App\Livewire\Schedule;
use App\Livewire\Analysis;
use App\Livewire\Home\Home;

Route::get('/', Home::class);
Route::get('/workbook', Workbook::class)->name('workbook');
Route::get('/schedule', Schedule::class);
Route::get('/analysis', Analysis::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

// 年度別問題ページ
Route::get('/workbook/{year}', \App\Livewire\Workbook\YearQuestions::class)
    ->name('workbook.year');

// 模擬試験ページ
Route::get('/workbook/mock', \App\Livewire\Workbook\MockExam::class)
    ->name('workbook.mock');

// カスタム試験ページ
Route::get('/workbook/custom', \App\Livewire\Workbook\CustomExam::class)
    ->name('workbook.custom');

// 弱点克服ページ
Route::get('/workbook/weakness', \App\Livewire\Workbook\WeaknessTraining::class)
    ->name('workbook.weakness');

// 結果表示ページ
Route::get('/workbook/result/{year}', \App\Livewire\Workbook\ResultDisplay::class)
    ->name('workbook.result');
