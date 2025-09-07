<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::factory()->create([
            "name" => "Különleges Ember",
            "email" => 'superadmin@gmail.com',
            "password" => Hash::make("superadmin"),
            "phone" => "063030303030"
        ]);

        $admin = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => "Admin1234_",
            "phone" => "06707171717",
            "role" => "admin"
        ]);
        User::factory(50)->create();
    }
}
