<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RsvpSetting;
use App\Models\UserDesign;
use App\Models\User;
use Carbon\Carbon;

class RSVPSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a user design
        $userDesign = UserDesign::first();
        if (!$userDesign) {
            // If no user design exists, we can't create RSVP settings
            return;
        }

        // Get a user
        $user = User::first();
        if (!$user) {
            // If no user exists, we can't create RSVP settings
            return;
        }

        // Create default RSVP settings
        RsvpSetting::firstOrCreate(
            ['design_id' => $userDesign->id],
            [
                'user_id' => $user->id,
                'rsvp_enabled' => true,
                'deadline' => now()->addDays(7),
                'max_guests_per_invite' => 5,
                'collect_meal_preferences' => true,
                'custom_questions' => json_encode([
                    ['question' => 'Any special requests?', 'type' => 'text'],
                    ['question' => 'Will you be bringing children?', 'type' => 'checkbox']
                ]),
                'created_at' => Carbon::now()->subDays(60),
                'updated_at' => Carbon::now()->subDays(60),
            ]
        );
    }
}