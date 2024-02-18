<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'publisher' => 'HarperCollins Publishers',
                'category_id' => 1, // Replace with the actual category ID
                'stock' => '15',
                'publish_date' => '1960-07-11',
                'image' => 'book-images/to_kill_a_mockingbird.jpg',
                'desc' => 'To Kill a Mockingbird is a novel by Harper Lee published in 1960. It was immediately successful, winning the Pulitzer Prize, and has become a classic of modern American literature.',
                'writer' => 'Harper Lee',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'publisher' => 'Secker & Warburg',
                'category_id' => 2, // Replace with the actual category ID
                'stock' => '20',
                'publish_date' => '1949-06-08',
                'image' => 'book-images/1984.jpg',
                'desc' => '1984 is a dystopian social science fiction novel by George Orwell. It was published in June 1949 by Secker & Warburg as Orwell\'s ninth and final book completed in his lifetime.',
                'writer' => 'George Orwell',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Great Gatsby',
                'publisher' => 'Charles Scribner\'s Sons',
                'category_id' => 3, // Replace with the actual category ID
                'stock' => '12',
                'publish_date' => '1925-04-10',
                'image' => 'book-images/the_great_gatsby.jpg',
                'desc' => 'The Great Gatsby is a 1925 novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island, the novel depicts narrator Nick Carraway\'s interactions with mysterious millionaire Jay Gatsby and Gatsby\'s obsession to reunite with his former lover, Daisy Buchanan.',
                'writer' => 'F. Scott Fitzgerald',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pride and Prejudice',
                'publisher' => 'T. Egerton, Whitehall',
                'category_id' => 4, // Replace with the actual category ID
                'stock' => '18',
                'publish_date' => '1813-01-28',
                'image' => 'book-images/pride_and_prejudice.jpg',
                'desc' => 'Pride and Prejudice is a romantic novel of manners written by Jane Austen in 1813. The novel follows the character development of Elizabeth Bennet, the dynamic protagonist of the book who learns about the repercussions of hasty judgments and eventually comes to appreciate the difference between superficial goodness and actual goodness.',
                'writer' => 'Jane Austen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Catcher in the Rye',
                'publisher' => 'Little, Brown and Company',
                'category_id' => 5, // Replace with the actual category ID
                'stock' => '10',
                'publish_date' => '1951-07-16',
                'image' => 'book-images/the_catcher_in_the_rye.jpg',
                'desc' => 'The Catcher in the Rye is a novel by J. D. Salinger, partially published in serial form in 1945–1946 and as a novel in 1951. A classic novel originally published for adults, it has since become popular with adolescent readers for its themes of teenage angst and alienation.',
                'writer' => 'J. D. Salinger',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('books')->insert($books);
    }
}
