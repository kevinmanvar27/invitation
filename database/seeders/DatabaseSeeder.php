<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            TemplateSeeder::class,
            AdminUserSeeder::class,
            TagSeeder::class,
            FontSeeder::class,
            SubscriptionSeeder::class,
            SharedInvitationSeeder::class,
            RsvpResponseSeeder::class,
            RsvpSettingSeeder::class,
            PrintOrderSeeder::class,
            FontsTableSeeder::class,
            SubscriptionsTableSeeder::class,
            PaymentsTableSeeder::class,
            DownloadsTableSeeder::class,
            SharedInvitationsTableSeeder::class,
            RSVPResponsesTableSeeder::class,
            RSVPSettingsTableSeeder::class,
            PrintOrdersTableSeeder::class,
            CouponsTableSeeder::class,
            ReferralsTableSeeder::class,
            ShippingAddressesTableSeeder::class,
            UserProfilesTableSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}