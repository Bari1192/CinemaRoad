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
            "password" => Hash::make("superadminZ"),
            "phone" => "063030303030",
            "role" => "admin"
        ]);

        $admin = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" =>  Hash::make("Admin1234_"),
            "phone" => "06707171717",
            "role" => "admin"
        ]);

        $user = User::factory()->create([
            "name" => "Regisztrált Felhasználó",
            "email" => "useremail@gmail.com",
            "password" =>  Hash::make("User1234_"),
            "phone" => "06305487962",
        ]);
        
        User::factory(50)->create();
    }
}
