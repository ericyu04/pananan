<?php
namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $data = 
        [
            'users' => 
            [
                ['username' => 'Alice1', 'fullname' => 'Alice Johnson', 'role' => 'Cashier'],
                ['username' => 'Bob21', 'fullname' => 'Bob Smith', 'role' => 'Cashier'],
                ['username' => 'Charlie67', 'fullname' => 'Charlie Brown', 'role' => 'Manager'],
                ['username' => 'David99', 'fullname' => 'David Lee', 'role' => 'Inventory'],
                ['username' => 'Eva42', 'fullname' => 'Eva Green', 'role' => 'Admin']
            ]
        ];

        return view('users', $data);
    }
}