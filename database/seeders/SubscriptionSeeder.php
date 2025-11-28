<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for the subscriptions
        $users = User::limit(5)->get();
        
        if ($users->isEmpty()) {
            // Create some users if none exist
            $users = User::factory(5)->create();
        }

        $plans = [
            ['type' => 'monthly', 'price' => 999.00],
            ['type' => 'yearly', 'price' => 1999.00],
            ['type' => 'onetime', 'price' => 4999.00]
        ];

        $statuses = ['active', 'expired', 'cancelled'];
        
        foreach (range(1, 5) as $index) {
            $user = $users->random();
            $plan = $plans[array_rand($plans)];
            $status = $statuses[array_rand($statuses)];
            
            Subscription::create([
                'user_id' => $user->id,
                'plan_type' => $plan['type'],
                'price' => $plan['price'],
                'currency' => 'INR',
                'status' => $status,
                'started_at' => now()->subDays(rand(30, 365)),
                'expires_at' => now()->addDays(rand(30, 365)),
            ]);
        }
    }
}