<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Borrowing;
use App\Models\Book;

class UserBorrowingSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $quantidade = rand(1, 5);
            for ($i = 0; $i < $quantidade; $i++) {
                Borrowing::factory()->create([
                    'user_id' => $user->id,
                    'book_id' => Book::inRandomOrder()->first()->id,
                ]);
            }
        });
    }
}