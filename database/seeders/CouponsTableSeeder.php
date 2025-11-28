<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percentage',
                'discount_value' => 10.00,
                'min_purchase' => 500.00,
                'valid_from' => Carbon::now()->subDays(10),
                'valid_until' => Carbon::now()->addDays(30),
                'usage_limit' => 100,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'code' => 'WEDDING50',
                'discount_type' => 'fixed',
                'discount_value' => 50.00,
                'min_purchase' => 1000.00,
                'valid_from' => Carbon::now()->subDays(5),
                'valid_until' => Carbon::now()->addDays(60),
                'usage_limit' => 50,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'code' => 'PREMIUM20',
                'discount_type' => 'percentage',
                'discount_value' => 20.00,
                'min_purchase' => 1500.00,
                'valid_from' => Carbon::now()->subDays(15),
                'valid_until' => Carbon::now()->addDays(45),
                'usage_limit' => 25,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'code' => 'FESTIVE30',
                'discount_type' => 'percentage',
                'discount_value' => 30.00,
                'min_purchase' => 2000.00,
                'valid_from' => Carbon::now()->subDays(20),
                'valid_until' => Carbon::now()->addDays(30),
                'usage_limit' => 75,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'code' => 'NEWYEAR15',
                'discount_type' => 'percentage',
                'discount_value' => 15.00,
                'min_purchase' => 750.00,
                'valid_from' => Carbon::now()->subDays(25),
                'valid_until' => Carbon::now()->addDays(90),
                'usage_limit' => 150,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'code' => 'LOVE500',
                'discount_type' => 'fixed',
                'discount_value' => 500.00,
                'min_purchase' => 5000.00,
                'valid_from' => Carbon::now()->subDays(30),
                'valid_until' => Carbon::now()->addDays(120),
                'usage_limit' => 10,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'code' => 'HAPPY100',
                'discount_type' => 'fixed',
                'discount_value' => 100.00,
                'min_purchase' => 1000.00,
                'valid_from' => Carbon::now()->subDays(35),
                'valid_until' => Carbon::now()->addDays(75),
                'usage_limit' => 200,
                'created_at' => Carbon::now()->subDays(35),
                'updated_at' => Carbon::now()->subDays(30),
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}