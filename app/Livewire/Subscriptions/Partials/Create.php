<?php

namespace App\Livewire\Subscriptions\Partials;

use App\Models\Member;
use App\Models\Program;
use App\Models\Subscription;
use Carbon\Carbon;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Create extends Component
{

    public $memberList = [];
    public $programList = [];
    public $memberSearch = '';

    public $selectedMember = null;
    public $selectedMemberId;
    public $selectedProgram;
    public $programDescription, $programPrice, $numOfDays;
    public $subscription;
    public $start_date, $end_date;

    protected $rules = [
        'memberSearch'  => 'required',
        'selectedMember' => 'required',
        'selectedProgram' => 'required',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ];
      
    public function updatedMemberSearch()
    {
        if(strlen($this->memberSearch) > 1) {
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
        $this->programDescription = $program->description;
        $this->numOfDays = $program->numOfDays;
        $this->programPrice = $program->price;
    }

    public function submit()
    {
        $this->validate();

        $date_difference = (int) Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    
        if($this->numOfDays != $date_difference) {
            $this->addError('end_date', 'End date must be ' . $this->numOfDays . ' days from start date');
            return;
        }

        $this->subscription = Subscription::create([
            'member_id' => $this->selectedMember->id,
            'program_id' => $this->selectedProgram,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => 'pending',
        ]);

        $this->subscription->transactions()->create([
            'amount' => $this->programPrice,
            'transaction_reference' => now()->toDateTimeString() . '-' . $this->selectedMemberId . $this->selectedProgram,
            'isPaid' => 0,
        ]);

        $this->resetForm();

        Flux::modal('create-subscription')->close();

        
        LivewireAlert::title('Subscription Added Successfully!')
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
        return view('livewire.subscriptions.partials.create');
    }
}
