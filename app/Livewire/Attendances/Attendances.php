<?php

namespace App\Livewire\Attendances;

use App\Models\Attendance;
use App\Models\Subscription;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Attendances extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';


    // public $logPerPage = 5;
    public $logSearch = '';


    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField)
        {
            $this->sortDir = ($this->sortDir === 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {


        $attendees = Subscription::with(['member', 'program', 'transactions', 'attendance'])
        ->whereHas('transactions', function ($query) {
            $query->where('isPaid', 1);
        })
        ->where('start_date', '<=', Carbon::today())
        ->where('end_date', '>=', Carbon::today())
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

        $attendanceLogs = Attendance::with([
            'subscription.member',
            'subscription.program',
            'subscription.transactions',
        ])
        ->search($this->logSearch)
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
        

        return view('livewire.attendances.attendances', [
            'attendees' => $attendees,
            'attendanceLogs' => $attendanceLogs,
        ]);
    }

    public function timeIn($subscriptionId)
    {
        Attendance::create([
            'subscription_id' => $subscriptionId,
            'date' => Carbon::today(),
            'isPresent' => 1,
            'timeIn' => now(),
        ]);

        LivewireAlert::title('Member Time in Successfully!')
        ->success()
        ->show();
    }

    public function timeOut($attendanceId)
    {
        $attendance = Attendance::find($attendanceId);

        if ($attendance && !$attendance->timeout) {
            $attendance->update([
                'timeOut' => now(),
            ]);

            LivewireAlert::title('Member Time out Successfully!')
            ->success()
            ->show();
        }
    }
}
