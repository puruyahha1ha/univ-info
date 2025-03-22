<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Home\Home;
use App\Livewire\Workbook\WorkbookIndex;
use App\Livewire\Schedule\ScheduleIndex;
use App\Livewire\Analysis\AnalysisIndex;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 公開ページ
Route::get('/', Home::class)->name('home');

// 認証が必要なページ
Route::middleware(['auth', 'verified'])->group(function () {
    // ダッシュボード
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // 過去問一問一答
    Route::get('/workbook', WorkbookIndex::class)->name('workbook');
    
    // スケジュール管理
    Route::get('/schedule', ScheduleIndex::class)->name('schedule');
    
    // 成績分析
    Route::get('/analysis', AnalysisIndex::class)->name('analysis');
    
    // プロフィール関連
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 認証関連のルート（Laravel Breezeが提供）
require __DIR__.'/auth.php';