<?php
namespace App\Controllers;

use App\Models\UserModel;

class Pages extends BaseController
{
    public function profile()
    {
        $user = (new UserModel())->first();
        return view('profile', ['title' => 'Profile', 'user' => $user]);
    }

    public function about()
    {
        return view('about', ['title' => 'About']);
    }
}