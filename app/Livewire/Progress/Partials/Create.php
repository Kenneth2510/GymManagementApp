<?php

namespace App\Livewire\Progress\Partials;

use App\Models\Member;
use App\Models\Progress;
use Carbon\Carbon;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $member_id;
    public $height, $weight, $bmi, $bmi_remark;

    protected $rules = [
        'height' => 'required|numeric|min:0.5|max:3',
        'weight' => 'required|numeric|min:10|max:500'
    ];

    public function checkBmiRemarks($bmi)
    {
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    public function render()
    {
        return view('livewire.progress.partials.create');
    }

    #[On('add_progress')]
    public function add_progress($member_id)
    {
        $member = Member::findOrFail($member_id);
        $this->member_id = $member->id;

        Flux::modal("add-progress")->show();
    }

    public function submit()
    {
        $this->validate();
        
        $bmi = $this->weight / ($this->height ** 2);
        $bmi_remarks = $this->checkBmiRemarks($bmi);

        Progress::create([
            'member_id' => $this->member_id,
            'date_record' => Carbon::today(),
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $bmi,
            'bmi_remarks' => $bmi_remarks,
        ]);

        $this->resetForm();

        $this->dispatch('progress' , $this->member_id);

        Flux::modal('add-progress')->close();

    }

    public function resetForm()
    {
        $this->height = '';
        $this->weight = '';
    }
}
