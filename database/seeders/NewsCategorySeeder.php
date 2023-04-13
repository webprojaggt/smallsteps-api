<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsCategory::create(["name" => "Esse & trinken", "icon" => "utensils"]);
        NewsCategory::create(["name" => "Strom", "icon" => "plug"]);
        NewsCategory::create(["name" => "Wasser", "icon" => "droplet"]);
        NewsCategory::create(["name" => "Transport", "icon" => "car-side"]);
    }
}
