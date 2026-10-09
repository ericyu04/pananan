<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn'))
        {
            return redirect()->to('/sales/new');
        }
        return view('auth/login', ['title' => 'Login']);
    }

    public function attempt()
    {
        if (! $this->validate(['username' => 'required', 'password' => 'required']))
        {
            return redirect()->back()->withInput();
        }

        $user = (new UserModel())->where('username', $this->request->getPost('username'))->first();

        if (! $user || ! password_verify($this->request->getPost('password'), $user['password'])) 
        {
            session()->setFlashdata('error', 'Invalid login.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/sales/new');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}