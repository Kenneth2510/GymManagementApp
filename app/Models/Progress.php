<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'member_id',
        'date_record',
        'height',
        'weight',
        'bmi',
        'bmi_remarks'
    ];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
