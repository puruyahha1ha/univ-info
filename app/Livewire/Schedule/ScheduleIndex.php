<?php
// app/Livewire/Schedule/ScheduleIndex.php
namespace App\Livewire\Schedule;

use Livewire\Component;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleIndex extends Component
{
    public $events = [];
    public $viewMode = 'month';
    public $currentDate;
    public $selectedDate = null;
    public $showEventModal = false;
    
    // イベント作成用の変数
    public $eventId = null;
    public $title = '';
    public $content = '';
    public $startDateTime = '';
    public $endDateTime = '';
    public $repeatType = 'none';
    public $notificationMinutes = 30;
    public $learningMethod = null;
    
    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'startDateTime' => 'required|date',
        'endDateTime' => 'required|date|after_or_equal:startDateTime',
        'repeatType' => 'required|in:none,daily,weekly,monthly',
        'notificationMinutes' => 'nullable|integer|min:0',
        'learningMethod' => 'nullable|in:pomodoro,spaced_repetition,intensive,output_focused',
    ];
    
    public function mount()
    {
        $this->currentDate = Carbon::now();
        $this->loadEvents();
    }
    
    public function loadEvents()
    {
        $userId = Auth::id();
        $startOfView = Carbon::parse($this->currentDate)->startOfMonth();
        $endOfView = Carbon::parse($this->currentDate)->endOfMonth();
        
        if ($this->viewMode === 'week') {
            $startOfView = Carbon::parse($this->currentDate)->startOfWeek();
            $endOfView = Carbon::parse($this->currentDate)->endOfWeek();
        } elseif ($this->viewMode === 'day') {
            $startOfView = Carbon::parse($this->currentDate)->startOfDay();
            $endOfView = Carbon::parse($this->currentDate)->endOfDay();
        }
        
        $this->events = Schedule::where('user_id', $userId)
            ->whereBetween('start_datetime', [$startOfView, $endOfView])
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'content' => $event->content,
                    'start' => $event->start_datetime->format('Y-m-d\TH:i:s'),
                    'end' => $event->end_datetime->format('Y-m-d\TH:i:s'),
                    'status' => $event->status,
                    'learning_method' => $event->learning_method,
                ];
            })
            ->toArray();
    }
    
    public function changeView($mode)
    {
        $this->viewMode = $mode;
        $this->loadEvents();
    }
    
    public function nextPeriod()
    {
        if ($this->viewMode === 'month') {
            $this->currentDate = Carbon::parse($this->currentDate)->addMonth();
        } elseif ($this->viewMode === 'week') {
            $this->currentDate = Carbon::parse($this->currentDate)->addWeek();
        } else {
            $this->currentDate = Carbon::parse($this->currentDate)->addDay();
        }
        
        $this->loadEvents();
    }
    
    public function prevPeriod()
    {
        if ($this->viewMode === 'month') {
            $this->currentDate = Carbon::parse($this->currentDate)->subMonth();
        } elseif ($this->viewMode === 'week') {
            $this->currentDate = Carbon::parse($this->currentDate)->subWeek();
        } else {
            $this->currentDate = Carbon::parse($this->currentDate)->subDay();
        }
        
        $this->loadEvents();
    }
    
    public function today()
    {
        $this->currentDate = Carbon::now();
        $this->loadEvents();
    }
    
    public function selectDate($date)
    {
        $this->selectedDate = $date;
        $this->resetEventForm();
        $this->startDateTime = Carbon::parse($date . ' 09:00')->format('Y-m-d\TH:i');
        $this->endDateTime = Carbon::parse($date . ' 10:00')->format('Y-m-d\TH:i');
        $this->showEventModal = true;
    }
    
    public function resetEventForm()
    {
        $this->eventId = null;
        $this->title = '';
        $this->content = '';
        $this->startDateTime = '';
        $this->endDateTime = '';
        $this->repeatType = 'none';
        $this->notificationMinutes = 30;
        $this->learningMethod = null;
    }
    
    public function createEvent()
    {
        $this->validate();
        
        Schedule::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'content' => $this->content,
            'start_datetime' => $this->startDateTime,
            'end_datetime' => $this->endDateTime,
            'repeat_type' => $this->repeatType,
            'notification_minutes' => $this->notificationMinutes,
            'status' => 'scheduled',
            'learning_method' => $this->learningMethod,
        ]);
        
        $this->showEventModal = false;
        $this->loadEvents();
        
        // Googleカレンダー連携があれば実装
        // $this->syncWithGoogleCalendar();
    }
    
    public function editEvent($eventId)
    {
        $event = Schedule::findOrFail($eventId);
        
        $this->eventId = $event->id;
        $this->title = $event->title;
        $this->content = $event->content;
        $this->startDateTime = $event->start_datetime->format('Y-m-d\TH:i');
        $this->endDateTime = $event->end_datetime->format('Y-m-d\TH:i');
        $this->repeatType = $event->repeat_type;
        $this->notificationMinutes = $event->notification_minutes;
        $this->learningMethod = $event->learning_method;
        
        $this->showEventModal = true;
    }
    
    public function updateEvent()
    {
        $this->validate();
        
        $event = Schedule::findOrFail($this->eventId);
        
        $event->update([
            'title' => $this->title,
            'content' => $this->content,
            'start_datetime' => $this->startDateTime,
            'end_datetime' => $this->endDateTime,
            'repeat_type' => $this->repeatType,
            'notification_minutes' => $this->notificationMinutes,
            'learning_method' => $this->learningMethod,
        ]);
        
        $this->showEventModal = false;
        $this->loadEvents();
        
        // Googleカレンダー連携の更新
        // $this->syncWithGoogleCalendar($event);
    }
    
    public function deleteEvent()
    {
        $event = Schedule::findOrFail($this->eventId);
        $event->delete();
        
        $this->showEventModal = false;
        $this->loadEvents();
        
        // Googleカレンダーから削除
        // $this->deleteFromGoogleCalendar($event);
    }
    
    public function markAsCompleted($eventId)
    {
        $event = Schedule::findOrFail($eventId);
        $event->update(['status' => 'completed']);
        
        $this->loadEvents();
    }
    
    public function render()
    {
        return view('livewire.schedule.schedule-index', [
            'currentDateDisplay' => $this->viewMode === 'month' 
                ? $this->currentDate->format('Y年n月') 
                : ($this->viewMode === 'week' 
                    ? $this->currentDate->startOfWeek()->format('Y年n月j日') . ' - ' . $this->currentDate->endOfWeek()->format('j日')
                    : $this->currentDate->format('Y年n月j日')),
        ]);
    }
}