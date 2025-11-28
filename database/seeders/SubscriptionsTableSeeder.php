<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users
        $users = User::limit(5)->get();
        
        if ($users->isEmpty()) {
            // Create some users if none exist
            $users = User::factory(5)->create();
        }

        $plans = [
            ['type' => 'monthly', 'price' => 299.00],
            ['type' => 'yearly', 'price' => 2999.00],
            ['type' => 'onetime', 'price' => 999.00]
        ];

        $statuses = ['active', 'cancelled', 'expired'];
        
        $subscriptions = [];
        for ($i = 0; $i < 5; $i++) {
            $user = $users->random();
            $plan = $plans[array_rand($plans)];
            $status = $statuses[array_rand($statuses)];
            
            $subscriptions[] = [
                'user_id' => $user->id,
                'plan_type' => $plan['type'],
                'price' => $plan['price'],
                'currency' => 'INR',
                'status' => $status,
                'started_at' => Carbon::now()->subDays(rand(30, 180)),
                'expires_at' => Carbon::now()->addDays(rand(30, 180)),
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 10)),
            ];
        }

        foreach ($subscriptions as $subscription) {
            Subscription::create($subscription);
        }
    }
}