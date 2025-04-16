<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'zalo',
        'fb',
    ];

    // Quan hệ one-to-many với BookedProperty (Customer có nhiều booking)
    public function bookedProperties()
    {
        return $this->hasMany(BookedProperty::class);
    }
}
