<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['name' => 'Soporte'],
            [
                'email' => 'soporte@soporte.com',
                'email_verified_at' => now(),
                'password' => Hash::make('soporte1'),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ]
        );
        User::factory(5)->create();
    }
}
