<?php
namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $dbUsers = $model->findAll();

        $fUsers = [];
        foreach ($dbUsers as $user) {
            $fUsers[] = [
                'username' => $user['username'],
                'name' => $user['full_name'],
                'role' => 'Staff',
                'created_at' => $user['created_at']
            ];
        }
        $data = ['users' => $fUsers];
        return view('users', $data);
    }
}