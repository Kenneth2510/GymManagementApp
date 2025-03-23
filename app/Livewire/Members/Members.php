<?php

namespace App\Livewire\Members;

use App\Models\Member;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Members extends Component
{
    use WithPagination;
    public $selectedMember;
    public $perPage = 5;

    public $search = '';

    public $sortBy = 'created_at';
    public $sortDir = 'DESC';


    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    #[On('reloadMembers')]
    public function render()
    {
        return view('livewire.members.members', [
            'members' => Member::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage),
        ]);
    }

    public function edit($id)
    {
        $this->dispatch("editMember", $id);
    }

    public function delete($id)
    {
        $this->selectedMember = Member::find($id);
        Flux::modal('delete-member')->show();
    }

    public function destroy()
    {
        $this->selectedMember->delete();
        Flux::modal('delete-member')->close();
        
        LivewireAlert::title('Member Deleted Successfully!')
        ->success()
        ->show();
        
        $this->dispatch('reloadMembers');
    }

}
