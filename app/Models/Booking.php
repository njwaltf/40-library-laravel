<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public static function generateBookingCode($length = 8)
    {
        // Define characters to use in the random string
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Get the total length of the character set
        $charLength = strlen($characters);

        // Initialize the booking code variable
        $bookingCode = '';

        // Generate random characters for the booking code
        for ($i = 0; $i < $length; $i++) {
            $randomChar = $characters[rand(0, $charLength - 1)];
            $bookingCode .= $randomChar;
        }

        return $bookingCode;
    }

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    use HasFactory;

    // Scope method to filter by status
    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope method to search by booking code
    public function scopeSearchByBookingCode($query, $keyword)
    {
        return $query->where('booking_code', $keyword);
    }
}
