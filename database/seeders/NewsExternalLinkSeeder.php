<?php

namespace Database\Seeders;

use App\Models\NewsExternalLink;
use Illuminate\Database\Seeder;

class NewsExternalLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsExternalLink::create([
            'news_id' => 1,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name der App",
            'description' => "Beschreibung der App",
            'link' => "https://www.google.com/"
        ]);
        NewsExternalLink::create([
            'news_id' => 1,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name des Produkts",
            'description' => "Beschreibung des Produkts",
            'link' => "https://www.google.com/"
        ]);
        NewsExternalLink::create([
            'news_id' => 1,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name des Services",
            'description' => "Beschreibung des Services",
            'link' => "https://www.google.com/"
        ]);
        
        NewsExternalLink::create([
            'news_id' => 2,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name der App",
            'description' => "Beschreibung der App",
            'link' => "https://www.google.com/"
        ]);
        NewsExternalLink::create([
            'news_id' => 2,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name des Produkts",
            'description' => "Beschreibung des Produkts",
            'link' => "https://www.google.com/"
        ]);
        NewsExternalLink::create([
            'news_id' => 2,
            'image_url' => 'https://placehold.co/100.png',
            'title' => "Name des Services",
            'description' => "Beschreibung des Services",
            'link' => "https://www.google.com/"
        ]);
    }
}
