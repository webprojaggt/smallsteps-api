<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::create([
            'news_category_id' => 1,
            'created_by' => 1,
            'title' => "Friedliche & inklusive Gesellschaften",
            'desc' => fake()->text(),
        ]);
        News::create([
            'news_category_id' => 4,
            'created_by' => 1,
            'title' => "Friedliche & inklusive Gesellschaften",
            'desc' => fake()->text(),
        ]);
        News::create([
            'news_category_id' => 4,
            'created_by' => 1,
            'title' => "Friedliche & inklusive Gesellschaften",
            'desc' => fake()->text(),
        ]);
        News::create([
            'news_category_id' => 4,
            'created_by' => 1,
            'title' => "Friedliche & inklusive Gesellschaften",
            'desc' => fake()->text(),
        ]);
    }
}
