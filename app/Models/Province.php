<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    // Quan hệ one-to-many với Districts (Province có nhiều Districts)
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    // Quan hệ one-to-many với Properties (Province có nhiều Properties)
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
