<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Quan hệ many-to-many với Properties (qua bảng trung gian property_tags)
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_tags');
    }
}
