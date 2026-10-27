<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 1, 'full_name' => 'John Doe', 'email' => 'JohnDoe@example.com', 'phone' => '123-456-7890', 'created_at' => '2026-10-01'],
            ['id' => 2, 'full_name' => 'Jane Smith', 'email' => 'JaneSmith@example.com', 'phone' => '987-654-3210', 'created_at' => '2026-10-02'],
            ['id' => 3, 'full_name' => 'Alice Johnson', 'email' => 'AliceJohnson@example.com', 'phone' => '555-123-4567', 'created_at' => '2026-10-03'],
            ['id' => 4, 'full_name' => 'Bob Brown', 'email' => 'BobBrown@example.com', 'phone' => '555-987-6543', 'created_at' => '2026-10-04'],
            ['id' => 5, 'full_name' => 'Charlie Davis', 'email' => 'CharlieDavis@example.com', 'phone' => '555-555-5555', 'created_at' => '2026-10-05'],
        ];
        return view('customers', ['customers' => $customers]);
    }
}
