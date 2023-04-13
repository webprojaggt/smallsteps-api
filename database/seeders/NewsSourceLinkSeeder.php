<?php

namespace Database\Seeders;

use App\Models\NewsSourceLink;
use Illuminate\Database\Seeder;

class NewsSourceLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "TEXT",
            'title' => "Das Fahrrad - eine Liebesgeschichte",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "TEXT",
            'title' => "Städteentwicklung auf dem Prüfst …",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "TEXT",
            'title' => "5 Wege zum gesünderen Leben",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "VIDEO",
            'title' => "Fahrrad Null Komma Nix",
            'link' => "https://www.youtube.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "VIDEO",
            'title' => "5 Wege zum gesünderen Leben",
            'link' => "https://www.youtube.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 1,
            'type' => "VIDEO",
            'title' => "Der große Fahrrad Report",
            'link' => "https://www.youtube.com/"
        ]);

        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "TEXT",
            'title' => "Das Fahrrad - eine Liebesgeschichte",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "TEXT",
            'title' => "Städteentwicklung auf dem Prüfst …",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "TEXT",
            'title' => "5 Wege zum gesünderen Leben",
            'link' => "https://www.google.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "VIDEO",
            'title' => "Fahrrad Null Komma Nix",
            'link' => "https://www.youtube.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "VIDEO",
            'title' => "5 Wege zum gesünderen Leben",
            'link' => "https://www.youtube.com/"
        ]);
        NewsSourceLink::create([
            'news_id' => 2,
            'type' => "VIDEO",
            'title' => "Der große Fahrrad Report",
            'link' => "https://www.youtube.com/"
        ]);
    }
}
