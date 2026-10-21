<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // Create Super Admin user
        User::updateOrCreate(
            ['email' => 'superadmin@dental.com'], // unique check
            [
                'name'              => 'Super Admin',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create Admin user
        User::updateOrCreate(
            ['email' => 'admin@dental.com'], // unique check
            [
                'name'              => 'Admin User',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Keep original demo user for backward compatibility
        User::updateOrCreate(
            ['email' => 'demo@demo.com'], // unique check
            [
                'name'              => $faker->name,
                'password'          => Hash::make('demo'),
                'email_verified_at' => now(),
            ]
        );
    }
}
