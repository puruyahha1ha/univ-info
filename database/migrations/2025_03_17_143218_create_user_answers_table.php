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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_session_id')->nullable()->constrained()->onDelete('set null');
            $table->string('selected_answer')->comment('選択した回答（例：ア）');
            $table->boolean('is_correct')->comment('正誤');
            $table->integer('points_earned')->default(0)->comment('獲得点数');
            $table->integer('answer_time')->nullable()->comment('回答にかかった時間（秒）');
            $table->boolean('viewed_explanation')->default(false)->comment('解説を閲覧したか');
            $table->boolean('marked_for_review')->default(false)->comment('見直し用にマークしたか');
            $table->timestamps();

            // インデックス
            $table->index(['user_id', 'question_id']);
            $table->index(['user_id', 'exam_session_id']);
            $table->index('is_correct');
        });
    }

    /**
     * マイグレーションのロールバック
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
