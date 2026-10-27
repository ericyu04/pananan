<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'username' => 'admin', 'full_name' => 'Admin User', 'role' => 'Admin', 'created_at' => '2026-10-01'],
            ['id' => 2, 'username' => 'cashier1', 'full_name' => 'Jane Cashier', 'role' => 'Staff', 'created_at' => '2026-10-02'],
            ['id' => 3, 'username' => 'cashier2', 'full_name' => 'John Cashier', 'role' => 'Staff', 'created_at' => '2026-10-03'],
            ['id' => 4, 'username' => 'stocker1', 'full_name' => 'Alice Stocker', 'role' => 'Staff', 'created_at' => '2026-10-04'],
            ['id' => 5, 'username' => 'manager', 'full_name' => 'Bob Manager', 'role' => 'Admin', 'created_at' => '2026-10-05'],
        ];
        return view('users', ['users' => $users]);
    }
}
