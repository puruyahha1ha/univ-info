<?php

namespace App\Livewire;

use Livewire\Component;

class Schedule extends Component
{

    public $schedules = [];
    public $newSchedule = '';

    // スケジュール追加のメソッド
    public function addSchedule()
    {
        if($this->newSchedule) {
            $this->schedules[] = $this->newSchedule;
            $this->newSchedule = '';
        }
    }

    public function render()
    {
        return view('livewire.schedule');
    }
}
