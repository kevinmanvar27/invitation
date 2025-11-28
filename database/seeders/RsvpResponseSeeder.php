<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RsvpResponse;
use App\Models\User;
use App\Models\SharedInvitation;

class RsvpResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for the RSVP responses
        $users = User::limit(15)->get();
        
        if ($users->isEmpty()) {
            // Create some users if none exist
            $users = User::factory(15)->create();
        }

        // Get or create a shared invitation
        $sharedInvitation = SharedInvitation::first();
        if (!$sharedInvitation) {
            // If no shared invitation exists, we can't create RSVP responses
            return;
        }

        $responses = ['attending', 'not_attending', 'maybe'];
        $dietaryPreferences = ['Vegetarian', 'Vegan', 'Gluten-Free', 'None', 'Halal', 'Kosher'];

        foreach (range(1, 15) as $index) {
            $user = $users->random();
            $response = $responses[array_rand($responses)];
            $dietary = $dietaryPreferences[array_rand($dietaryPreferences)];
            
            RsvpResponse::create([
                'shared_invitation_id' => $sharedInvitation->id,
                'guest_name' => $user->name,
                'guest_email' => $user->email,
                'guest_phone' => '+91' . rand(1000000000, 9999999999),
                'response' => $response,
                'plus_ones_count' => rand(1, 10),
                'meal_preference' => $dietary,
                'special_requests' => '',
                'responded_at' => now()->subDays(rand(1, 30)),
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()
            ]);
        }
    }
}