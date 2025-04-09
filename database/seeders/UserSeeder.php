<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'handphone' => '0812345678',
            'address' => 'Jl. Penjernihan',
            'role' => 'admin',
            ],
            [
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
            'first_name' => 'Super',
            'last_name' => 'Owner',
            'handphone' => '081234567890',
            'address' => 'Jl. Penjernihan',
            'role' => 'owner',
            ],
            [
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password'),
            'first_name' => 'Super',
            'last_name' => 'Customer',
            'handphone' => '081234567809',
            'address' => 'Jl. Penjernihan',
            'role' => 'customer',
            ]
        ]);
    }
}
