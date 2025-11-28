<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Font;
use Carbon\Carbon;

class FontsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fonts = [
            [
                'font_name' => 'Great Vibes',
                'font_family' => 'Great Vibes, cursive',
                'font_file_path' => null,
                'is_premium' => true,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'font_name' => 'Playfair Display',
                'font_family' => 'Playfair Display, serif',
                'font_file_path' => null,
                'is_premium' => true,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'font_name' => 'Lora',
                'font_family' => 'Lora, serif',
                'font_file_path' => null,
                'is_premium' => false,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'font_name' => 'Montserrat',
                'font_family' => 'Montserrat, sans-serif',
                'font_file_path' => null,
                'is_premium' => false,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'font_name' => 'Dancing Script',
                'font_family' => 'Dancing Script, cursive',
                'font_file_path' => null,
                'is_premium' => true,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'font_name' => 'Pacifico',
                'font_family' => 'Pacifico, cursive',
                'font_file_path' => null,
                'is_premium' => false,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'font_name' => 'Alex Brush',
                'font_family' => 'Alex Brush, cursive',
                'font_file_path' => null,
                'is_premium' => true,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'font_name' => 'Sacramento',
                'font_family' => 'Sacramento, cursive',
                'font_file_path' => null,
                'is_premium' => false,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($fonts as $font) {
            Font::create($font);
        }
    }
}