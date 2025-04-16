<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'collaborator_id',
        'date',
        'price',
        'deposit',
        'note',
        'booking_status',
        'deposit_payment_status',
        'customer_id',
        'customer_phone',
        'customer_info',
        'customer_cccd',
        'customer_images',
        'booking_code',
        'adults',
        'children',
        'checkin_date',
        'checkout_date',
        'discount_code_id',
        'total_amount',
        // ... các trường khác
    ];

    protected $casts = [
        'customer_images' => 'array', // Cast customer_images thành array (JSON)
    ];

    // Quan hệ belongsTo với Property (one-to-many ngược lại)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Quan hệ belongsTo với Customer (one-to-many ngược lại)
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Quan hệ one-to-one với Rating (BookedProperty có một rating)
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
