<?php

namespace App\Livewire\Members\Partials;

use App\Models\Member;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Edit extends Component
{
    use WithFileUploads;
    public $memberid;
    public $fname, $mname, $lname, $bday;
    public $email, $phone;
    public  $photo;

    public function render()
    {
        return view('livewire.members.partials.edit');
    }

    #[On('editMember')]
    public function editMember($id)
    {
        $member = Member::find($id);
        $this->memberid = $member->id;
        $this->fname = $member->fname;
        $this->mname = $member->mname;
        $this->lname = $member->lname;
        $this->bday = $member->bday;
        $this->email = $member->email;
        $this->phone = $member->phone;

        Flux::modal('edit-member')->show();
    }

    protected $rules = [
        'fname' => 'required',
        'mname' => 'required',
        'lname' => 'required',
        'bday' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function update()
    {
        $this->validate();

        if($this->photo)
        {
            $folderName = Str::slug("{$this->fname} {$this->mname} {$this->lname}");
            $photoPath = $this->photo
                ? $this->photo->store("members/{$folderName}", 'public')
                : null;
        }

        $member = Member::find($this->memberid);
        $member->fname = $this->fname;
        $member->mname = $this->mname;
        $member->lname = $this->lname;
        $member->bday = $this->bday;
        $member->email = $this->email;
        $member->phone = $this->phone;
        $member->photo = $photoPath ?? $member->photo;

        $member->save();

        Flux::modal('edit-member')->close();

        LivewireAlert::title('Member Updated Successfully!')
        ->success()
        ->show();

        $this->dispatch('reloadMembers');
    }

}
