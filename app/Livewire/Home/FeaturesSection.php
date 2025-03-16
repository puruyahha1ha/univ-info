<?php

namespace App\Livewire\Home;

use Livewire\Component;

class FeaturesSection extends Component
{
    public array $features = [
        [
            'icon' => 'user-circle',
            'color' => 'indigo',
            'title' => '豊富な入試情報',
            'description' => '最新の入試情報を随時更新。大学の詳細情報や受験科目などを簡単に確認できます。学習計画の立案に役立ちます。'
        ],
        [
            'icon' => 'user-circle',
            'color' => 'purple',
            'title' => '個別学習プラン',
            'description' => '一人ひとりの目標や弱点に合わせた学習プランを自動提案。効率的に勉強を進められます。'
        ],
        [
            'icon' => 'user-circle',
            'color' => 'yellow',
            'title' => 'カスタムテスト機能',
            'description' => '過去問や模試を自由に組み合わせ、あなた専用の模擬試験を作成。弱点克服に役立ちます。'
        ]
    ];

    public function render()
    {
        return view('livewire.home.features-section');
    }
}