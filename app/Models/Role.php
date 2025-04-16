<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Ulid::generate(); // Generate ULID and cast to string
            }
        });
    }

    // Quan hệ many-to-many với Users (qua bảng trung gian role_user)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    // Quan hệ many-to-many với Permissions (qua bảng trung gian permission_role)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
