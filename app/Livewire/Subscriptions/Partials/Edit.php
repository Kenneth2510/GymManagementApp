<?php

namespace App\Livewire\Subscriptions\Partials;

use App\Models\Member;
use App\Models\Program;
use App\Models\Subscription;
use Carbon\Carbon;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{

    public $memberList = [];
    public $programList = [];
    public $memberSearch = '';

    public $selectedMember = null;
    public $selectedMemberId;
    public $selectedProgram;
    public $programDescription, $programPrice, $numOfDays;
    public $subscription, $subscriptionId;
    public $start_date, $end_date, $status;

    protected $rules = [
        'memberSearch'  => 'required',
        'selectedMember' => 'required',
        'selectedProgram' => 'required',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ];

    public function updatedMemberSearch()
    {
        if (strlen($this->memberSearch) > 1) {
            $this->memberList = Member::where('fname', 'like', '%' . $this->memberSearch . '%')
                ->orWhere('lname', 'like', '%' . $this->memberSearch . '%')
                ->orWhere('mname', 'like', '%' . $this->memberSearch . '%')
                ->limit(10)
                ->get();
        } else {
            $this->memberList = Member::all();
        }
    }

    public function selectMember($id)
    {
        $this->selectedMember = Member::find($id);
        $this->selectedMemberId = $id;
        $this->memberSearch = $this->selectedMember->fname . ' ' . $this->selectedMember->mname . ' ' . $this->selectedMember->lname;
        $this->memberList = [];
    }

    public function updatedSelectedProgram()
    {
        $program = Program::find($this->selectedProgram);

        if ($program) {
            $this->programDescription = $program->description;
            $this->numOfDays = $program->numOfDays;
            $this->programPrice = $program->price;
        }

        if ($this->start_date) {
            $this->setStartDate();
        }
    }

    public function updatedStartDate()
    {
        $this->setStartDate();
    }

    public function setStartDate()
    {
        if ($this->selectedProgram && $this->start_date && $this->numOfDays) {
            $this->end_date = Carbon::parse($this->start_date)->addDays($this->numOfDays)->toDateString();
        }
    }

    #[On('editSubscription')]
    public function editSubscription($id)
    {
        $subscription = Subscription::find($id);

        $this->subscriptionId = $subscription->id;
        $this->selectedMember = $subscription->member;
        $this->memberSearch = $subscription->member->fname . ' ' . $subscription->member->mname . ' ' . $subscription->member->lname;
        $this->selectedProgram = $subscription->program->id;
        $this->selectedMemberId = $subscription->member->id;
        $this->start_date = $subscription->start_date;
        $this->end_date = $subscription->end_date;
        $this->status = $subscription->status;

        Flux::modal('edit-subscription')->show();
    }


    public function update()
    {
        $this->validate();

        $subsciption = Subscription::find($this->subscriptionId);

        // $overlappingSubscription = Subscription::where('member_id', $this->selectedMember->id)
        //     ->where(function ($query) {
        //         $query->whereBetween('start_date', [$this->start_date, $this->end_date])
        //             ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
        //             ->orWhere(function ($q) {
        //                 $q->where('start_date', '<=', $this->start_date)
        //                     ->where('end_date', '>=', $this->end_date);
        //             });
        //     })->exists();

        // if ($overlappingSubscription) {
        //     $this->addError('start_date', 'This member already has an active subscription within the selected date range.');
        //     return;
        // }

        $subsciption->update([
            'member_id' => $this->selectedMember->id,
            'program_id' => $this->selectedProgram,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status
        ]);

        Flux::modal('edit-subscription')->close();

        LivewireAlert::title('Subscription Updated Successfully!')
            ->success()
            ->show();

        $this->dispatch('reloadSubscriptions');
    }



    public function resetForm()
    {
        $this->memberSearch = '';
        $this->selectedMember = null;
        $this->selectedMemberId = null;
        $this->selectedProgram = null;
        $this->programDescription = '';
        $this->programPrice = '';
        $this->numOfDays = '';
        $this->start_date = '';
        $this->end_date = '';
    }

    public function mount()
    {
        $this->programList = Program::all();
    }

    public function render()
    {
        return view('livewire.subscriptions.partials.edit');
    }
}
