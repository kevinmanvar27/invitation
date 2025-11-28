<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;

class ReferralsTableSeeder extends Seeder
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

        $statuses = ['Pending', 'Completed'];
        $referralCodes = ['REF100', 'REF200', 'REF300', 'REF400', 'REF500', 'REF600', 'REF700', 'REF800', 'REF900', 'REF1000'];

        $referrals = [];
        for ($i = 0; $i < 10; $i++) {
            $referrer = $users->random();
            // Make sure referrer and referred are different users
            $referred = $users->where('id', '!=', $referrer->id)->random();
            $status = $statuses[array_rand($statuses)];
            $referralCode = $referralCodes[array_rand($referralCodes)];
            
            $referrals[] = [
                'referrer_user_id' => $referrer->id,
                'referred_user_id' => $referred->id,
                'reward_earned' => rand(50, 500),
                'status' => $status,
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ];
        }

        foreach ($referrals as $referral) {
            Referral::create($referral);
        }
    }
}