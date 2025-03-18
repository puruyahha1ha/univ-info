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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->comment('問題の年度');
            $table->integer('number')->comment('問題番号');
            $table->string('category')->comment('カテゴリ（アルゴリズム、データベースなど）');
            $table->tinyInteger('difficulty')->default(3)->comment('難易度（1-5）');
            $table->integer('points')->comment('配点');
            $table->text('question_text')->comment('問題文（HTML形式可）');
            $table->string('image_path')->nullable()->comment('画像パス（あれば）');
            $table->json('choices')->comment('選択肢（JSON形式で保存）');
            $table->string('correct_answer')->comment('正解（選択肢のキー、例：ア）');
            $table->text('explanation')->comment('解説（HTML形式可）');
            $table->json('tags')->nullable()->comment('タグ（JSON形式、検索用）');
            $table->boolean('is_active')->default(true)->comment('アクティブ状態（表示/非表示）');
            $table->timestamps();

            // インデックス
            $table->index('year');
            $table->index('category');
            $table->index(['year', 'number']);
        });
    }

    /**
     * マイグレーションのロールバック
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
