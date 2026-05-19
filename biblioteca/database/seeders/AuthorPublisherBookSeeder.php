<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class AuthorPublisherBookSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = Publisher::factory(20)->create();

        Author::factory(100)->create()->each(function ($author) use ($publishers) {

            $author->books()->createMany(
                Book::factory(10)->make([
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'publisher_id' => $publishers->random()->id,
                ])->toArray()
            );
        });
    }
}