<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'code',
    ];

    // Quan hệ belongsTo với District (one-to-many ngược lại)
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Quan hệ one-to-many với Properties (Ward có nhiều Properties)
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
