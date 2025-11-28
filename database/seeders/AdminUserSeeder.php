<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the user already exists
        $user = User::where('email', 'rektech.uk@gmail.com')->first();
        
        if (!$user) {
            User::create([
                'name' => 'RekTech',
                'email' => 'rektech.uk@gmail.com',
                'password' => Hash::make('RekTech@27'),
            ]);
        } else {
            // Update the existing user's password
            $user->update([
                'password' => Hash::make('RekTech@27'),
            ]);
        }
    }
}