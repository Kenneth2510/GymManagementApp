<?php

namespace App\Livewire\Programs\Partials;

use App\Models\Program;
use Flux\Flux;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Create extends Component
{

    public $title, $description, $price, $numOfDays;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'price' => 'required',
        'numOfDays' => 'required'
    ];

    public function render()
    {
        return view('livewire.programs.partials.create');
    }

    public function submit()
    {
        $this->validate();

        Program::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'numOfDays' => $this->numOfDays
        ]);

        $this->resetForm();

        Flux::modal('create-program')->close();

        
        LivewireAlert::title('Program Added Successfully!')
        ->success()
        ->show();

        $this->dispatch('reloadPrograms');
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->numOfDays = '';
    }
}
