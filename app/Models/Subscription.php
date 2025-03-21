<?php

namespace App\Models;

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
}
