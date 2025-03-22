<?php

namespace App\Livewire\Home;

use Livewire\Component;

class FeaturesSection extends Component
{
    public $features = [];

    public function mount()
    {
        $this->features = [
            [
                'title' => '豊富な入試情報',
                'description' => '最新の入試情報を随時更新。大学の詳細情報や受験科目などを簡単に確認できます。学習計画の立案に役立ちます。',
                'icon' => 'numbered-list',
                'color' => 'indigo'
            ],
            [
                'title' => '個別学習プラン',
                'description' => '一人ひとりの目標や弱点に合わせた学習プランを自動提案。効率的に勉強を進められます。',
                'icon' => 'book-open',
                'color' => 'purple'
            ],
            [
                'title' => 'カスタムテスト機能',
                'description' => '過去問や模試を自由に組み合わせ、あなた専用の模擬試験を作成。弱点克服に役立ちます。',
                'icon' => 'document-magnifying-glass',
                'color' => 'yellow'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.home.features-section');
    }
}