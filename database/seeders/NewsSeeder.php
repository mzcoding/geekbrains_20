<?php

namespace Database\Seeders;

use App\Enums\News\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('news')->insert($this->getData());
    }

    public function getData(): array
    {
        $quantityNews = 10;
        $news = [];
        for ($i=0; $i < $quantityNews; $i++) {
            $news[] = [
                'category_id' => 1,
                'title' => fake()->jobTitle(),
                'author' => fake()->userName(),
                'image'  => fake()->imageUrl(200, 150),
                'status' => Status::ACTIVE->value,
                'description' => fake()->text(100) ,
                'created_at' => now(),
            ];
        }

        return $news;
    }
}
