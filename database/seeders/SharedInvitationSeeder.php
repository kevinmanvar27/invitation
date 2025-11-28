<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SharedInvitation;
use App\Models\User;
use App\Models\UserDesign;
use App\Models\Template;
use Illuminate\Support\Str;

class SharedInvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for the shared invitations
        $users = User::limit(10)->get();
        
        if ($users->isEmpty()) {
            // Create some users if none exist
            $users = User::factory(10)->create();
        }

        // Get or create a template
        $template = Template::first();
        if (!$template) {
            // If no template exists, we can't create user designs
            return;
        }

        // Create a user design if none exist
        $userDesign = UserDesign::first();
        if (!$userDesign) {
            $userDesign = UserDesign::create([
                'user_id' => $users->first()->id,
                'template_id' => $template->id,
                'design_name' => 'Sample Wedding Invitation',
                'canvas_data' => json_encode([]),
                'is_completed' => true,
                'status' => 'completed',
            ]);
        }

        $methods = ['Email', 'WhatsApp', 'Facebook', 'SMS'];
        $titles = [
            'John & Jane\'s Wedding',
            'Mike & Sarah\'s Anniversary',
            'David & Lisa\'s Engagement',
            'Robert & Emma\'s Reception',
            'James & Olivia\'s Ceremony'
        ];

        foreach (range(1, 10) as $index) {
            $user = $users->random();
            $method = $methods[array_rand($methods)];
            $title = $titles[array_rand($titles)];
            
            SharedInvitation::create([
                'design_id' => $userDesign->id,
                'user_id' => $user->id,
                'share_token' => Str::random(10),
                'share_method' => $method,
                'recipient_email' => $user->email,
                'recipient_phone' => '+91' . rand(1000000000, 9999999999),
                'view_count' => rand(0, 100),
                'sent_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}