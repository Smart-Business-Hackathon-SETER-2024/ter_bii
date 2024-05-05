<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Role::factory()->create([
            'id' => 1,
            'nomRole' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'last_name' => 'faye',
            'first_name' => 'mouha',
            'telephone' => '123456789',
            'estActived' => true,
            'email' => 'faye@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo_profile' => null, // Assuming there's no default value provided
            'roles_id' => 1, // Assuming the role ID for this user
        ]);
    }
}
