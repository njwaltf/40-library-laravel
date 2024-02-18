<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Book;
use App\Models\User;

class BookingSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            // Get random book ID
            $bookId = Book::inRandomOrder()->first()->id;

            // Create a new booking
            Booking::create([
                'booking_code' => Booking::generateBookingCode(),
                'book_id' => $bookId,
                'user_id' => 2,
                'status' => 'Diajukan', // Set initial status as 'Diajukan'
                'return_date' => null, // Set return date as null initially
                'expired_date' => null, // Set expired date as null initially
                'isDenda' => 0, // Set isDenda as null initially
                'book_at' => now(), // Set booking date to current timestamp
                // You can set other fields as needed
            ]);
        }
    }
}
