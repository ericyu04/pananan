<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['full_name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '123-456-7890'],
            ['full_name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '987-654-3210'],
            ['full_name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com', 'phone' => '555-555-5555'],
            ['full_name' => 'Bob Brown', 'email' => 'bob.brown@example.com', 'phone' => '111-222-3333'],
            ['full_name' => 'Charlie Davis', 'email' => 'charlie.davis@example.com', 'phone' => '444-444-4444']
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}