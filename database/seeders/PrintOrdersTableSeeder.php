<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PrintOrder;
use App\Models\User;
use App\Models\UserDesign;
use Carbon\Carbon;

class PrintOrdersTableSeeder extends Seeder
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
            // If no user design exists, we can't create print orders
            return;
        }

        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
        $paperTypes = ['Glossy', 'Matte', 'Textured'];
        $sizes = ['A4', 'A5'];

        $orders = [];
        for ($i = 0; $i < 8; $i++) {
            $user = $users->random();
            $status = $statuses[array_rand($statuses)];
            $paperType = $paperTypes[array_rand($paperTypes)];
            $size = $sizes[array_rand($sizes)];
            
            $orders[] = [
                'user_id' => $user->id,
                'design_id' => $userDesign->id,
                'quantity' => rand(10, 100),
                'paper_type' => $paperType,
                'finish' => 'Glossy',
                'size' => $size,
                'orientation' => 'portrait',
                'unit_price' => 2.99,
                'total_price' => 2.99 * rand(10, 100),
                'discount' => 0.00,
                'status' => $status,
                'ordered_at' => Carbon::now()->subDays(rand(1, 30)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(1, 5)),
            ];
        }

        foreach ($orders as $order) {
            PrintOrder::create($order);
        }
    }
}