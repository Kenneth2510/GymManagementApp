<?php

namespace App\Livewire\Members\Partials;

use App\Models\Member;
use App\Models\Progress;
use Carbon\Carbon;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{
    use WithFileUploads;

    public $fname, $mname, $lname, $bday;
    public $email, $phone;
    public $height, $weight;
    public $photo;

    protected $rules = [
        'fname' => 'required',
        'mname' => 'nullable',
        'lname' => 'required',
        'bday' => 'required',
        'email' => 'required|email|unique:members,email',
        'phone' => 'required|string|max:12',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'height' => 'required|numeric|min:0.5|max:3',
        'weight' => 'required|numeric|min:10|max:500',
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
        return view('livewire.members.partials.create');
    }

    public function submit()
    {
        $this->validate();

        $folderName = Str::slug("{$this->fname} {$this->mname} {$this->lname}");
        $photoPath = $this->photo
            ? $this->photo->store("members/{$folderName}", 'public')
            : null;

        $member = Member::create([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'bday' => $this->bday,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $photoPath,

        ]);

        $bmi = $this->weight / ($this->height ** 2);
        $bmi_remarks = $this->checkBmiRemarks($bmi);

        Progress::create([
            'member_id' => $member->id,
            'date_record' => Carbon::today(),
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $bmi,
            'bmi_remarks' => $bmi_remarks,
        ]);

        $this->resetForm();

        Flux::modal('create-member')->close();
                
        LivewireAlert::title('Member Added Successfully!')
        ->success()
        ->show();

        $this->dispatch('reloadMembers');
    }

    public function resetForm()
    {
        $this->fname = '';
        $this->mname = '';
        $this->lname = '';
        $this->bday = '';
        $this->email = '';
        $this->phone = '';
        $this->photo = '';
        $this->height = '';
        $this->weight = '';
    }
}
