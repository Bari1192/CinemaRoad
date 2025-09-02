<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $en = User::factory()->create([
            "name"=>"Különleges Ember",
            "email" => 'asdasd@gmail.com',
            "password" => Hash::make("asdasd"),
            "phone"=>"063030303030"
        ]);

        $admin = User::factory()->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => "Admin1234_",
            "phone" => "06707171717",
            "role" => "admin"
        ]);
    }
}
