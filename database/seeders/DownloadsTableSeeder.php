<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Download;
use App\Models\User;
use App\Models\UserDesign;
use Carbon\Carbon;

class DownloadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users
        $users = User::limit(10)->get();
        
        if ($users->isEmpty()) {
            // Create some users if none exist
            $users = User::factory(10)->create();
        }

        // Get or create a user design
        $userDesign = UserDesign::first();
        if (!$userDesign) {
            // If no user design exists, we can't create downloads
            return;
        }

        $formats = ['PDF', 'PNG', 'JPG'];

        $downloads = [];
        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();
            $format = $formats[array_rand($formats)];
            
            $downloads[] = [
                'user_id' => $user->id,
                'design_id' => $userDesign->id,
                'file_type' => $format,
                'resolution' => '1920x1080',
                'file_size' => rand(100, 5000), // in KB
                'file_path' => '/downloads/' . uniqid() . '.' . strtolower($format),
                'download_count' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 10)),
            ];
        }

        foreach ($downloads as $download) {
            Download::create($download);
        }
    }
}