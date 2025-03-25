<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'program_id',
        'status',
        'start_date',
        'end_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }           

    public function attendance()
    {
        return $this->hasOne(Attendance::class)->whereDate('created_at', Carbon::today());
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
