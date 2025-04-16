<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'code',
    ];

    // Quan hệ belongsTo với Province (one-to-many ngược lại)
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Quan hệ one-to-many với Wards (District có nhiều Wards)
    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    // Quan hệ one-to-many với Properties (District có nhiều Properties)
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
