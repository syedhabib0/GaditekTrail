<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(10)->create();

        Product::factory(20)->create();

        Review::factory(30)->create();

        Keyword::factory(10)->create();

        $keywords = ['love', 'amazing', 'like', 'good'];
        foreach ($keywords as $keyword) {
            Keyword::create(["name" => $keyword]);
        }
    }
}
