<?php

namespace App\Livewire\Subscriptions;

use App\Models\Attendance;
use App\Models\Member;
use App\Models\Program;
use App\Models\Subscription;
use Carbon\Carbon;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Subscriptions extends Component
{
    use WithPagination;
    public $perPage = 5;
    public $search ='';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $program = '';
    public $selectedSubscription;

    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField)
        {
            $this->sortDir = ($this->sortDir === 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }


    public function updateProgramStatus()
    {
        Subscription::with(['transactions'])
        ->whereHas('transactions', function($query) {
            $query->where('isPaid', 1);
        })
        ->where('start_date', '<=' , Carbon::today())
        ->where('end_date', '>=', Carbon::today())
        ->update([
            'status' => 'active'
        ]);
    }

    public function updateProgramStatusInactive()
    {
        Subscription::where('end_date', '<', Carbon::today())
        ->update([
            'status' => 'expired'
        ]);
    }


    #[On('reloadSubscriptions')]
    public function render()
    {
        $this->updateProgramStatus();
        $this->updateProgramStatusInactive();
        
        return view('livewire.subscriptions.subscriptions', [
            'programs' => Program::all(),
            'subscriptions' => Subscription::query()
            ->select('subscriptions.*') // Select main table columns
            ->leftJoin('members', 'subscriptions.member_id', '=', 'members.id')
            ->leftJoin('programs', 'subscriptions.program_id', '=', 'programs.id')
            ->when($this->sortBy === 'member->fname', function ($query) {
                return $query->orderBy('members.fname', $this->sortDir);
            })
            ->when($this->sortBy === 'program->title', function ($query) {
                return $query->orderBy('programs.title', $this->sortDir);
            })
            ->when(!in_array($this->sortBy, ['member->fname', 'program->title']), function ($query) {
                return $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->with(['member', 'program', 'transactions'])
            ->paginate(10),
        ]);
    }

    public function edit($id)
    {
        $this->dispatch('editSubscription', $id);
    }


    public function delete($id)
    {
        $this->selectedSubscription = Subscription::find($id);

        Flux::modal('delete-subscription')->show();
    }

    public function destroy()
    {
        $this->selectedSubscription->delete();

        Flux::modal('delete-subscription')->close();

        LivewireAlert::title('Subscription Deleted Successfully!')
        ->success()
        ->show();
        
        $this->dispatch('reloadSubscriptions');
    }


    public function transact($transaction_id)
    {
        $this->dispatch('createTransaction', $transaction_id);
    }

}
