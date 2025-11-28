<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SharedInvitation;
use App\Models\User;
use App\Models\UserDesign;
use Carbon\Carbon;

class SharedInvitationsTableSeeder extends Seeder
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

        // Get or create some user designs
        $designs = UserDesign::limit(10)->get();
        if ($designs->isEmpty()) {
            // We'll create shared invitations with design_id = 1 for now
            $designId = 1;
        } else {
            $designId = $designs->first()->id;
        }

        $platforms = ['WhatsApp', 'Email', 'Facebook', 'Twitter', 'Instagram'];

        $invitations = [];
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $platform = $platforms[array_rand($platforms)];
            
            $invitations[] = [
                'design_id' => $designId,
                'user_id' => $user->id,
                'share_token' => uniqid(),
                'share_method' => $platform,
                'recipient_email' => $user->email,
                'recipient_phone' => '+91' . rand(1000000000, 9999999999),
                'view_count' => rand(0, 100),
                'sent_at' => Carbon::now()->subDays(rand(1, 30)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 5)),
            ];
        }

        foreach ($invitations as $invitation) {
            SharedInvitation::create($invitation);
        }
    }
}