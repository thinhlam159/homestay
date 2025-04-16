<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class Property extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'owner_id',
        'name',
        'property_type',
        'address',
        'description',
        'short_description',
        'images',
        'videos',
        'rule',
        'service',
        'amenities',
        'room_quantity',
        'standard_people_quantity',
        'category_id', // Thêm category_id vào fillable
        'province_id',  // Thêm province_id vào fillable
        'district_id',  // Thêm district_id vào fillable
        'ward_id',      // Thêm ward_id vào fillable
        'is_featured',
        'is_popular',
        'is_discounted',
        'checkin_time',
        'checkout_time',
        'deposit_percentage',
        'deposit_amount',
        'cancellation_policy',
        // ... các trường khác
    ];

    protected $casts = [
        'images' => 'json',
        'videos' => 'json',
        'service' => 'json',
        'amenities' => 'json',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
        'is_discounted' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Ulid::generate();
            }
        });
    }

    // Quan hệ many-to-many với Tags (qua bảng trung gian property_tags)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'property_tags');
    }

    // Quan hệ belongsTo với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ belongsTo với Province
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    // Quan hệ belongsTo với District
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // Quan hệ belongsTo với Ward
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * The collaborators that belong to the property.
     */
    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'property_collaborator', 'property_id', 'user_id');
    }
}
