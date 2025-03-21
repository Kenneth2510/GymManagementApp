<?php

namespace App\Livewire\Programs;

use App\Models\Program;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Programs extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public $selectedProgram;


    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField)
        {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }


    #[On('reloadPrograms')]
    public function render()
    {
        return view('livewire.programs.programs', [
            'programs' => Program::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->paginate($this->perPage),
        ]);
    }


    public function edit($id)
    {
        $this->dispatch('editProgram', $id);
    }

    public function delete($id)
    {
        $this->selectedProgram = Program::find($id);

        Flux::modal('delete-program')->show();
    }

    public function destroy()
    {
        $this->selectedProgram->delete();
        Flux::modal('delete-program')->close();
        $this->dispatch('reloadProgram');
    }
}
