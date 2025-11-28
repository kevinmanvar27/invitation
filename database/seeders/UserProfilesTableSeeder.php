<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProfile;
use App\Models\User;
use Carbon\Carbon;

class UserProfilesTableSeeder extends Seeder
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

        $profiles = [];
        foreach ($users as $user) {
            $profiles[] = [
                'user_id' => $user->id,
                'profile_picture' => null,
                'wedding_date' => Carbon::now()->addMonths(rand(6, 12)),
                'partner_name' => 'Partner ' . rand(1, 100),
                'preferences' => json_encode([
                    'theme' => 'wedding',
                    'color_scheme' => 'gold',
                    'notifications' => true
                ]),
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ];
        }

        foreach ($profiles as $profile) {
            UserProfile::create($profile);
        }
    }
}