<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'bday',
        'email',
        'phone',
        'photo',
    ];


    public function getFullNameAttribute()
    {
        return "{$this->fname} {$this->mname} {$this->lname}";
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }


    public function scopeSearch($query, $value)
    {
        $query->where('fname', 'like', "%{$value}%")
            ->orWhere('mname', 'like', "%{$value}%")
            ->orWhere('lname', 'like', "%{$value}%")
            ->orWhere('email', 'like', "%{$value}%")
            ->orWhere('phone', 'like', "%{$value}%");
    }
}
