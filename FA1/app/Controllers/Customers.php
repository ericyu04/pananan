<?php
namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $data = 
        [
            'customers' => 
            [
                ['name' => 'John Doe', 'email' => 'johndoe@example.com', 'phone' => '123-456-7890'],
                ['name' => 'Jane Smith', 'email' => 'janesmith@example.com', 'phone' => '098-765-4321'],
                ['name' => 'Juan Dela Cruz', 'email' => 'juandelacruz@example.com', 'phone' => '555-555-5555'],
                ['name' => 'Maria Clara', 'email' => 'mariaclara@example.com', 'phone' => '111-111-1111'],
                ['name' => 'Pedro Penduko', 'email' => 'pedropenduko@example.com', 'phone' => '222-222-2222']
            ]
        ];  

        return view('customers', $data);
    }
}