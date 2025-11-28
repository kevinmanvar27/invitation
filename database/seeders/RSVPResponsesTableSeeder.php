<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RsvpResponse;
use App\Models\SharedInvitation;
use Carbon\Carbon;

class RSVPResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a shared invitation
        $sharedInvitation = SharedInvitation::first();
        if (!$sharedInvitation) {
            // If no shared invitation exists, we can't create RSVP responses
            return;
        }

        $responses = ['attending', 'not_attending', 'maybe'];
        $dietaryPreferences = ['Vegetarian', 'Vegan', 'Gluten-Free', 'None', 'Halal', 'Kosher'];

        $rsvpResponses = [];
        for ($i = 0; $i < 20; $i++) {
            $response = $responses[array_rand($responses)];
            $dietary = $dietaryPreferences[array_rand($dietaryPreferences)];
            
            $rsvpResponses[] = [
                'shared_invitation_id' => $sharedInvitation->id,
                'guest_name' => 'Guest ' . ($i + 1),
                'guest_email' => 'guest' . ($i + 1) . '@example.com',
                'guest_phone' => '+91' . rand(1000000000, 9999999999),
                'response' => $response,
                'plus_ones_count' => rand(1, 10),
                'meal_preference' => $dietary,
                'special_requests' => '',
                'responded_at' => Carbon::now()->subDays(rand(1, 30)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 5)),
            ];
        }

        foreach ($rsvpResponses as $rsvpResponse) {
            RsvpResponse::create($rsvpResponse);
        }
    }
}