<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Font;

class FontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fonts = [
            'Great Vibes',
            'Playfair Display',
            'Lora',
            'Montserrat',
            'Crimson Text',
            'Dancing Script',
            'Cormorant',
            'Alex Brush',
            'Cinzel',
            'Satisfy'
        ];

        foreach ($fonts as $fontName) {
            Font::firstOrCreate([
                'font_name' => $fontName,
                'font_family' => $fontName,
                'font_file_path' => null,
                'is_premium' => false
            ]);
        }
    }
}