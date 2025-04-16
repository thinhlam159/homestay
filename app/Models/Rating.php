<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'booked_property_id',
        'review',
        'star_quantity',
        'user_id', // Có thể là người dùng admin hoặc customer đánh giá
        'rating_date',
    ];

    // Quan hệ belongsTo với BookedProperty (one-to-one ngược lại)
    public function bookedProperty()
    {
        return $this->belongsTo(BookedProperty::class);
    }

    // Quan hệ belongsTo với User (nếu muốn biết user nào đánh giá - tùy chọn)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
