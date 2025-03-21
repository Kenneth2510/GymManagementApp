<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'numOfDays',
        'price',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function scopeSearch($query, $value)
    {
        $query->where('title', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%")
            ->orWhere('numOfDays', 'like', "%{$value}%")
            ->orWhere('price', 'like', "%{$value}%");
    }
}
