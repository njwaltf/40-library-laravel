<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Fiction is a literary genre that typically deals with imaginative and fictional stories. It often explores themes, characters, and settings that are not based on real events or people.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Science fiction is a genre of speculative fiction that typically deals with imaginative and futuristic concepts such as advanced science and technology, space exploration, time travel, parallel universes, and extraterrestrial life.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mystery',
                'description' => 'Mystery fiction is a genre of fiction that revolves around the solution of a crime or puzzle. It often involves a detective, amateur sleuth, or private investigator who solves the mystery through deductive reasoning, intuition, or forensic science.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Romance',
                'description' => 'Romance fiction is a genre of fiction that focuses on romantic love and emotional relationships between characters. It often explores themes of love, passion, intimacy, and commitment.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thriller',
                'description' => 'Thriller fiction is a genre of fiction that creates intense excitement, suspense, and anticipation in the reader. It often involves danger, suspenseful plots, and high-stakes situations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
