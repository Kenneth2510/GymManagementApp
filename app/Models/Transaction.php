<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'amount',
        'isPaid',
        'transaction_reference',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
