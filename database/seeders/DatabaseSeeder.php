<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\BookingSeeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        // \App\Models\User::factory(10)->create();

        $admin_random_id = strval(rand(1000000000, 9999999999)); // Generates a random 10-digit number for admin
        $member_random_id = strval(rand(1000000000, 9999999999)); // Generates a random 10-digit number for member
        $librarian_random_id = strval(rand(1000000000, 9999999999)); // Generates a random 10-digit number for librarian

        User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'role' => 'admin',
            'username' => 'admin1',
            'id_no' => $admin_random_id,
            'password' => bcrypt('admin1')
        ]);

        User::create([
            'name' => 'Member 1',
            'email' => 'member1@gmail.com',
            'role' => 'member',
            'username' => 'member1',
            'id_no' => $member_random_id,
            'password' => bcrypt('member1')
        ]);

        User::create([
            'name' => 'Librarian 1',
            'email' => 'librarian1@gmail.com',
            'role' => 'librarian',
            'username' => 'librarian1',
            'id_no' => $librarian_random_id,
            'password' => bcrypt('librarian1')
        ]);
        $this->call(CategorySeeder::class);
        $this->call(BookSeeder::class);
        $this->call(BookingSeeder::class);
    }
}
