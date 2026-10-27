<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['username' => 'admin', 'full_name' => 'Admin User'],
            ['username' => 'cashier1', 'full_name' => 'Jane Cashier'],
            ['username' => 'cashier2', 'full_name' => 'John Cashier'],
            ['username' => 'stocker1', 'full_name' => 'Alice Stocker'],
            ['username' => 'manager', 'full_name' => 'Bob Manager'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
