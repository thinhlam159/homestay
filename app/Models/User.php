<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'phone',
        'fb',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Quan hệ với PropertyOwner (one-to-one)
    public function propertyOwner()
    {
        return $this->hasOne(PropertyOwner::class);
    }

    // Quan hệ với Collaborator (one-to-many) - User có thể là cộng tác viên cho nhiều service owner
    public function collaborators()
    {
        return $this->hasMany(Collaborator::class);
    }

    // Quan hệ many-to-many với Roles (qua bảng trung gian role_user)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Kiểm tra xem User có vai trò cụ thể không
    public function hasRole($roles)
    {
        return $this->roles()->whereIn('slug', (array) $roles)->exists();
    }

    // Kiểm tra xem User có quyền hạn cụ thể không (thông qua vai trò)
    public function hasPermission($permissions)
    {
        return $this->roles->flatMap->permissions->whereIn('slug', (array) $permissions)->isNotEmpty();
    }

    public function collaboratorProperty() {
        return $this->belongsToMany(Property::class, 'property_user', 'user_id', 'property_id');
    }
}
