<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class PaymentsTableSeeder extends Seeder
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

        $paymentMethods = ['Credit Card', 'UPI', 'Wallet', 'Net Banking'];
        $gateways = ['Razorpay', 'Stripe', 'PayPal', 'Paytm'];
        $statuses = ['pending', 'completed', 'failed', 'refunded'];

        $payments = [];
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random();
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $gateway = $gateways[array_rand($gateways)];
            $status = $statuses[array_rand($statuses)];
            
            $payments[] = [
                'user_id' => $user->id,
                'amount' => rand(299, 2999),
                'payment_method' => $paymentMethod,
                'payment_gateway_id' => $gateway,
                'status' => $status,
                'created_at' => Carbon::now()->subDays(rand(1, 90)),
                'updated_at' => Carbon::now()->subDays(rand(1, 10)),
            ];
        }

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}