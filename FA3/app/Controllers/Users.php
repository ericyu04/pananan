<?php
namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
    private array $rules = [
        'username' => 'required|min_length[5]|max_length[50]',
        'full_name' => 'required|min_length[5]|max_length[100]'
    ];

    public function index()
    {
        $model = new UserModel();
        return view('users', ['users' => $model->findAll()]);
    }

    public function new()
    {
        return view('users/newuser');
    }

    public function create()
    {
        $rules = [
            'username' => 'required|min_length[5]|max_length[50]',
            'full_name' => 'required|min_length[5]|max_length[100]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        $model = new UserModel();
        $model ->insert([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ]);
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        return view('users/edituser', ['user' => $user]);
    }

    public function update($id)
    {
        $model = new UserModel();
        
        if (! $model->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
        $rules = [
            'username' => 'required|min_length[5]|max_length[50]',
            'full_name' => 'required|min_length[5]|max_length[100]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        $model->update($id, [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ]);
        return redirect()->to('/users');
    }

    // public function index()
    // {
    //     $model = new UserModel();
    //     $dbUsers = $model->findAll();

    //     $fUsers = [];
    //     foreach ($dbUsers as $user) {
    //         $fUsers[] = [
    //             'username' => $user['username'],
    //             'name' => $user['full_name'],
    //             'role' => 'Staff',
    //             'created_at' => $user['created_at']
    //         ];
    //     }
    //     $data = ['users' => $fUsers];
    //     return view('users', $data);
    // }
    // public function new()
    // {
    //     $rules = [
    //         'username' => 'required|min_length[5]|max_length[50]',
    //         'full_name' => 'required|min_length[5]|max_length[100]'
    //     ];
    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput();
    //     }
    //     return view('users/newuser');
    // }
    // public function edit($id)
    // {
    //     $model = new UserModel();
    //     $user = $model->find($id);

    //     if (!$user) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
    //     }

    //     $data = ['user' => $user];
    //     return view('users/edituser', $data);
    // }
}