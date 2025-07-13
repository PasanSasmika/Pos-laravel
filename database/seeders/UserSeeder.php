<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
         'name' => 'Admin User',
         'email' => 'admin@gmail.com',
         'password' => Hash::make('12345678'),
         'role' => 'admin'
        ]);

         $manager = User::create([
         'name' => 'Manager User',
         'email' => 'manager@gmail.com',
         'password' => Hash::make('12345678'),
         'role' => 'manag'
        ]);

         $cashier = User::create([
         'name' => 'Cashier User',
         'email' => 'cashier@gmail.com',
         'password' => Hash::make('12345678'),
         'role' => 'cash'
        ]);
    }
}
