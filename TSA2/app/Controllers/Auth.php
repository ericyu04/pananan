<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login', ['title' => 'Login']);
    }

    public function attempt()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $model    = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user     = $model->where('username', $username)->first();

        if (! $user || empty($user['password']) || ! password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Invalid login.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['id'],
            'username'   => $user['username'],
        ]);

        return redirect()->to('/tasks');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // TEMPORARY
    public function setupDemo()
    {
        $model = new UserModel();
        $user  = $model->where('username', 'admin')->first();
        $model->update($user['id'], [
            'password' => password_hash('secret123', PASSWORD_DEFAULT),
        ]);
        return 'Done';
    }
}