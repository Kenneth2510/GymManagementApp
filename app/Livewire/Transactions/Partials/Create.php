<?php

namespace App\Livewire\Transactions\Partials;

use App\Models\Subscription;
use App\Models\Transaction;
use Flux\Flux;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{

    public $subscription;
    public $transaction;
    public $transactionID;


    #[On('createTransaction')]
    public function createTransaction($transaction_id)
    {
        $this->subscription = Subscription::with(['member', 'program', 'transactions'])
        ->whereHas('transactions', function($query) use ($transaction_id) {
            $query->where('id', $transaction_id);
        })
        ->first();

        $this->transactionID = $this->subscription->transactions->first()->id;

        Flux::modal('create-transaction')->show();
    }

    public function render()
    {
        return view('livewire.transactions.partials.create');
    }

    public function markPaid()
    {
        $this->transaction = Transaction::find($this->transactionID);
        $this->transaction->isPaid = 1;

        $this->transaction->save();

        Flux::modal('create-transaction')->close();

        LivewireAlert::title('Payment Updated Successfully!')
        ->success()
        ->show();

        $this->dispatch('reloadSubscriptions');
    }


    public function markUnpaid()
    {
        $this->transaction = Transaction::find($this->transactionID);
        $this->transaction->isPaid = 0;

        $this->transaction->save();

        Flux::modal('create-transaction')->close();

        LivewireAlert::title('Payment Updated Successfully!')
        ->success()
        ->show();

        $this->dispatch('reloadSubscriptions');
    }
}
