<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::updateOrCreate([
            'name'     => 'Admin',
            'phone'     => '0624155994',
            'user_type'     => 1,
            'email'    => 'admin@test.com', 
            'password' => Hash::make('password'),
        ]);

        User::updateOrCreate([
            'name'     => 'Seller',
            'phone'     => '0624155995',
            'user_type'     => 2,
            'email'    => 'seller@test.com', 
            'password' => Hash::make('password'),
        ]);

        User::updateOrCreate([
            'name'     => 'User',
            'phone'     => '0624155996',
            'user_type'     => 0,
            'email'    => 'user@test.com', 
            'password' => Hash::make('password'),
        ]);
    }
}
