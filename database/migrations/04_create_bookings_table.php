<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up() : void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('return_date')->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->enum('status', ['Diajukan', 'Dipinjam', 'Dikembalikan', 'Dikembalikan Terlambat', 'Ditolak']);
            $table->integer('isDenda')->nullable();
            $table->timestamp('book_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('bookings');
    }
};
