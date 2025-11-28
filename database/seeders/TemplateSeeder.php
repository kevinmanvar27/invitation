<?php

namespace Database\Seeders;

use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create template categories
        $categories = [
            ['name' => 'Indian/Hindu', 'slug' => 'indian-hindu', 'description' => 'Traditional Indian and Hindu wedding invitations'],
            ['name' => 'Christian', 'slug' => 'christian', 'description' => 'Christian wedding invitations'],
            ['name' => 'Muslim', 'slug' => 'muslim', 'description' => 'Muslim wedding invitations'],
            ['name' => 'Jewish', 'slug' => 'jewish', 'description' => 'Jewish wedding invitations'],
            ['name' => 'Chinese', 'slug' => 'chinese', 'description' => 'Chinese wedding invitations'],
            ['name' => 'Mexican', 'slug' => 'mexican', 'description' => 'Mexican wedding invitations'],
            ['name' => 'Spanish', 'slug' => 'spanish', 'description' => 'Spanish wedding invitations'],
        ];

        foreach ($categories as $categoryData) {
            TemplateCategory::create($categoryData);
        }

        // Create some sample templates
        $templates = [
            [
                'name' => 'Elegant Gold Foil',
                'slug' => 'elegant-gold-foil',
                'description' => 'Beautiful gold foil design with floral elements',
                'category_id' => 1,
                'theme' => 'indian',
                'style' => 'elegant',
                'orientation' => 'portrait',
                'is_premium' => true,
                'price' => 3.49,
                'thumbnail_path' => 'thumbnails/gold-foil.jpg',
                'preview_path' => 'previews/gold-foil.jpg',
                'template_data' => [],
                'downloads_count' => 0,
                'usage_count' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Minimalist Modern',
                'slug' => 'minimalist-modern',
                'description' => 'Clean and modern design with simple typography',
                'category_id' => 2,
                'theme' => 'christian',
                'style' => 'minimalist',
                'orientation' => 'landscape',
                'is_premium' => false,
                'price' => null,
                'thumbnail_path' => 'thumbnails/minimalist.jpg',
                'preview_path' => 'previews/minimalist.jpg',
                'template_data' => [],
                'downloads_count' => 0,
                'usage_count' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Floral Romance',
                'slug' => 'floral-romance',
                'description' => 'Romantic floral design with soft pastel colors',
                'category_id' => 3,
                'theme' => 'muslim',
                'style' => 'floral',
                'orientation' => 'portrait',
                'is_premium' => true,
                'price' => 2.99,
                'thumbnail_path' => 'thumbnails/floral.jpg',
                'preview_path' => 'previews/floral.jpg',
                'template_data' => [],
                'downloads_count' => 0,
                'usage_count' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($templates as $templateData) {
            Template::create($templateData);
        }
    }
}
