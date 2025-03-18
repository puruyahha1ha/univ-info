<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * マイグレーションの実行
     */
    public function up(): void
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->comment('セッションのタイトル');
            $table->enum('type', ['year', 'mock', 'custom', 'weakness'])->comment('試験の種類');
            $table->integer('year')->nullable()->comment('年度（年度別の場合）');
            $table->enum('status', ['in_progress', 'completed', 'abandoned'])->default('in_progress')->comment('セッションの状態');
            $table->integer('total_questions')->default(0)->comment('問題総数');
            $table->integer('correct_answers')->default(0)->comment('正解数');
            $table->integer('total_points')->default(0)->comment('獲得点数');
            $table->integer('max_points')->default(0)->comment('満点');
            $table->timestamp('started_at')->nullable()->comment('開始時間');
            $table->timestamp('completed_at')->nullable()->comment('完了時間');
            $table->integer('time_spent')->default(0)->comment('所要時間（秒）');
            $table->json('settings')->nullable()->comment('試験の設定（カテゴリ制限や時間制限など）');
            $table->timestamps();

            // インデックス
            $table->index(['user_id', 'status']);
            $table->index('type');
            $table->index('year');
        });

        // 中間テーブル: 試験セッションと問題の関連付け
        Schema::create('exam_session_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_session_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->integer('order')->comment('問題の表示順序');
            $table->timestamps();

            // ユニーク制約
            $table->unique(['exam_session_id', 'question_id']);

            // インデックス
            $table->index(['exam_session_id', 'order']);
        });
    }

    /**
     * マイグレーションのロールバック
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_session_questions');
        Schema::dropIfExists('exam_sessions');
    }
};
