<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingAddress;
use App\Models\User;
use Carbon\Carbon;

class ShippingAddressesTableSeeder extends Seeder
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

        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Ahmedabad', 'Pune', 'Surat', 'Jaipur'];
        $states = ['Maharashtra', 'Delhi', 'Karnataka', 'Tamil Nadu', 'West Bengal', 'Telangana', 'Gujarat', 'Maharashtra', 'Gujarat', 'Rajasthan'];

        $addresses = [];
        for ($i = 0; $i < 12; $i++) {
            $user = $users->random();
            $cityIndex = array_rand($cities);
            $city = $cities[$cityIndex];
            $state = $states[$cityIndex];
            
            $addresses[] = [
                'user_id' => $user->id,
                'full_name' => $user->name,
                'phone' => '+91' . rand(1000000000, 9999999999),
                'address_line1' => 'Address Line 1, ' . $city,
                'address_line2' => rand(0, 1) ? 'Address Line 2, ' . $city : null,
                'city' => $city,
                'state' => $state,
                'postal_code' => rand(100000, 999999),
                'country' => 'India',
                'is_default' => $i % 3 == 0 ? true : false, // Every 3rd address is default
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30)),
            ];
        }

        foreach ($addresses as $address) {
            ShippingAddress::create($address);
        }
    }
}