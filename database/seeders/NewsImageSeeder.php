<?php

namespace Database\Seeders;

use App\Models\NewsImage;
use Illuminate\Database\Seeder;

class NewsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsImage::create([
            'news_id' => 1,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);
        NewsImage::create([
            'news_id' => 1,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);
        NewsImage::create([
            'news_id' => 1,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);

        NewsImage::create([
            'news_id' => 2,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);
        NewsImage::create([
            'news_id' => 2,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);
        NewsImage::create([
            'news_id' => 2,
            'image_path' => 'https://placehold.co/260x240.png'
        ]);
    }
}
