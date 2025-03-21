<?php

namespace App\Livewire\Programs\Partials;

use App\Models\Program;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $title, $description, $numOfDays, $price, $programId;

    public function render()
    {
        return view('livewire.programs.partials.edit');
    }

    #[On('editProgram')]
    public function editProgram($id)
    {
        $program = Program::find($id);

        $this->programId = $program->id;
        $this->title = $program->title;
        $this->description = $program->description;
        $this->numOfDays = $program->numOfDays; 
        $this->price = $program->price; 

        Flux::modal('edit-program')->show();
    }

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'price' => 'required',
        'numOfDays' => 'required'
    ];

    public function update()
    {
        $this->validate();

        $program = Program::find($this->programId);
        $program->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'numOfDays' => $this->numOfDays
        ]);

        Flux::modal('edit-program')->close();

        $this->dispatch('reloadPrograms');
    }

}
