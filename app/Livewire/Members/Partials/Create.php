<?php

namespace App\Livewire\Members\Partials;

use App\Models\Member;
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
    public $photo;

    protected $rules = [
        'fname' => 'required',
        'mname' => 'required',
        'lname' => 'required',
        'bday' => 'required',
        'email' => 'required|email|unique:members,email',
        'phone' => 'required',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

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

        Member::create([
            'fname' => $this->fname,
            'mname' => $this->mname,
            'lname' => $this->lname,
            'bday' => $this->bday,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $photoPath,

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
    }
}
