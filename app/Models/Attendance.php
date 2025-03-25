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

    public function scopeSearch($query, $value)
    {
        $query->where('id', 'like', "%{$value}%")
            ->orWhere('start_date', 'like', "%{$value}%")
            ->orWhere('end_date', 'like', "%{$value}%")
            ->orWhere('status', 'like', "%{$value}%")
            ->orWhereHas('member', function ($q) use ($value) {
                $q->where('fname', 'like', "%{$value}%")
                ->orWhere('mname', 'like', "%{$value}%")
                ->orWhere('lname', 'like', "%{$value}%");
            })
            ->orWhereHas('program', function ($q) use ($value) {
                $q->where('title', 'like', "%{$value}%");
            })
            ->orWhereHas('transactions', function ($q) use ($value) {
                $q->where('isPaid', 'like', "%{$value}%");
            });

        return $query;
    }
}
