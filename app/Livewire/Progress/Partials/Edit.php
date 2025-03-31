<?php

namespace App\Livewire\Progress\Partials;

use App\Models\Progress;
use Carbon\Carbon;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $member_id;
    public $progress_id;
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
        return view('livewire.progress.partials.edit');
    }

    #[On('edit')]
    public function edit($id)
    {
        $progress = Progress::find($id);
        $this->progress_id = $progress->id;
        $this->height = $progress->height;
        $this->weight = $progress->weight;

        Flux::modal('edit-progress')->show();
    }

    public function update()
    {
        $this->validate();

        $bmi = $this->weight / ($this->height ** 2);
        $bmi_remarks = $this->checkBmiRemarks($bmi);

        $progress = Progress::find($this->progress_id);

        $progress->update([
            'date_record' => Carbon::today(),
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $bmi,
            'bmi_remarks' => $bmi_remarks,
        ]);

        $this->resetForm();

        $this->dispatch('progress' , $progress->member_id);

        Flux::modal('edit-progress')->close();

    }

    public function resetForm()
    {
        $this->height = '';
        $this->weight = '';
    }
}
