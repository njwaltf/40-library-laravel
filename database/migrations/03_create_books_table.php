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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('publisher');
            $table->foreignId('category_id')->constrained('books')->onDelete('cascade');
            $table->string('stock');
            $table->string('publish_date');
            $table->string('image');
            $table->text('desc');
            $table->string('writer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('books');
    }
};
