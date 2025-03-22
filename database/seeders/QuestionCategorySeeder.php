<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'アルゴリズムとプログラミング',
                'description' => 'プログラミング言語の基礎や、アルゴリズム的思考に関する問題',
                'display_order' => 1,
            ],
            [
                'name' => 'コンピュータの仕組み',
                'description' => 'コンピュータのハードウェアや基本的な仕組みに関する問題',
                'display_order' => 2,
            ],
            // 他のカテゴリも追加
        ];

        foreach ($categories as $category) {
            QuestionCategory::create($category);
        }
    }
}