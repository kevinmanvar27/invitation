<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Wedding',
            'Birthday',
            'Anniversary',
            'Sangeet',
            'Mehndi',
            'Reception',
            'Baby Shower',
            'Engagement',
            'House Warming',
            'Diwali',
            'Navratri',
            'Holi'
        ];

        $tagRecords = [];
        foreach ($tags as $tagName) {
            $tagRecords[] = [
                'name' => $tagName,
                'slug' => Str::slug($tagName),
                'color_code' => '#' . substr(md5($tagName), 0, 6),
                'usage_count' => rand(5, 50),
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ];
        }

        foreach ($tagRecords as $tag) {
            Tag::create($tag);
        }
    }
}