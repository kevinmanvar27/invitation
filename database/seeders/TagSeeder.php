<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TemplateTag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Traditional',
            'Modern',
            'Floral',
            'Elegant',
            'Minimalist',
            'Vintage',
            'Rustic',
            'Royal',
            'Contemporary',
            'Bohemian'
        ];

        foreach ($tags as $tagName) {
            // Since TemplateTag is a pivot table, we can't use firstOrCreate with slug
            // We'll just create sample template tags without worrying about duplicates for now
            TemplateTag::create([
                'template_id' => 1, // Assuming template with ID 1 exists
                'tag_name' => $tagName,
            ]);
        }
    }
}