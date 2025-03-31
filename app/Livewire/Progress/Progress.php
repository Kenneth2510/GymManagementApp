<?php

namespace App\Livewire\Progress;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Progress as ModelsProgress;
use App\Models\Subscription;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Progress extends Component
{

    public $memberid;
    public $selectedProgress;

    public $fname, $mname, $lname, $bday;
    public $email, $phone, $created_at;
    public $photo;
    public $progresses = [];
    public $subscriptions = [];
    public $attendances = [];

    #[On('reload_progress')]
    public function render()
    {
        return view('livewire.progress.progress');
    }

    #[On('progress')]
    public function view_progress($id)
    {
        $this->getMemberData($id);
        $this->getProgressData();
        $this->getSubscriptionsData();
        $this->getAttendanceData();

        Flux::modal('view-progress')->show();
    }

    public function getMemberData($id)
    {
        $member = Member::find($id);
        $this->memberid = $member->id;
        $this->fname = $member->fname;
        $this->mname = $member->mname;
        $this->lname = $member->lname;
        $this->bday = $member->bday;
        $this->email = $member->email;
        $this->phone = $member->phone;
        $this->photo = $member->photo;
        $this->created_at = $member->created_at;
    }

    public function getProgressData()
    {
        $this->progresses = ModelsProgress::where('member_id', $this->memberid)->orderBy('date_record', 'DESC')->get();
    }

    public function getSubscriptionsData()
    {
        $this->subscriptions = Subscription::with(['transactions', 'program'])->where('member_id', $this->memberid)->orderBy('start_date', 'ASC')->get();
    }

    public function getAttendanceData()
    {
        $this->attendances = Attendance::with([
            'subscription.program',
            'subscription.member',
        ])
        ->whereHas('subscription', function ($query) {
            $query->where('member_id', $this->memberid);
        })
        ->orderBy('date', 'DESC')
        ->get();
    }

    public function add_progress($member_id)
    {
        $this->dispatch('add_progress', $member_id);
    }

    public function edit($id)
    {
        $this->dispatch('edit', $id);
    }

    public function delete($id)
    {
        $this->selectedProgress = ModelsProgress::find($id);
        $this->memberid = $this->selectedProgress->member_id;

        Flux::modal('delete-progress')->show();
    }

    public function destroy()
    {
        $this->selectedProgress->delete();

        $this->dispatch('progress' , $this->memberid);

        Flux::modal('delete-progress')->close();
    }
}
