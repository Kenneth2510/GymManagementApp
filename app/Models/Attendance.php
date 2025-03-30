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
        return $query->where('id', 'like', "%{$value}%")
            ->orWhere('timeIn', 'like', "%{$value}%")
            ->orWhere('timeOut', 'like', "%{$value}%")
            ->orWhere('date', 'like', "%{$value}%")
            ->orWhereDate('created_at', 'like', "%{$value}%")
            ->orWhereHas('subscription', function ($q) use ($value) {
                $q->where('status', 'like', "%{$value}%")
                    ->orWhere('start_date', 'like', "%{$value}%")
                    ->orWhere('end_date', 'like', "%{$value}%")
                    ->orWhereHas('member', function ($q) use ($value) {
                        $q->where('fname', 'like', "%{$value}%")
                          ->orWhere('mname', 'like', "%{$value}%")
                          ->orWhere('lname', 'like', "%{$value}%");
                    })
                    ->orWhereHas('program', function ($q) use ($value) {
                        $q->where('title', 'like', "%{$value}%");
                    });
            });
    }
}
