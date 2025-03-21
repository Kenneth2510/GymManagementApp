<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'date',
        'isPresent',
        'timeIn',
        'timeOut',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
