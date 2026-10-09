<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class Users extends BaseController
{
    private const AVATAR_RULE = 'max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png]|is_image[avatar]';    

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
            'full_name' => 'required|min_length[5]|max_length[100]',
            'password' => 'required|min_length[8]',
            'avatar' => self::AVATAR_RULE
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $avatar = $this->saveAvatar($this->request->getFile('avatar'));
        if ($avatar !== null)
        {
            $data['avatar'] = $avatar;
        }

        (new userModel())->insert($data);
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        return view('users/edituser', ['user' => $user]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        
        if (! $user) 
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $rules = [
            'username' => 'required|min_length[5]|max_length[50]',
            'full_name' => 'required|min_length[5]|max_length[100]',
            'password' => 'permit_empty|min_length[8]',
            'avatar' => self::AVATAR_RULE
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $avatar = $this->saveAvatar($this->request->getFile('avatar'));
        if ($avatar !== null) {
            $data['avatar'] = $avatar;
            if (!empty($user['avatar']))
            {
                @unlink(FCPATH . 'uploads/' . $user['avatar']);
            }
        }

        $newPassword = $this->request->getPost('password');
        if (! empty($newPassword))
        {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);
        return redirect()->to('/users');
    }

    private function saveAvatar(?UploadedFile $file): ?string
    {
        if ($file === null || ! $file->isValid() || $file->hasMoved()) 
        {
            return null;
        }

        $dir = FCPATH . 'uploads/';
        if (! is_dir($dir)) 
        {
            mkdir($dir, 0775, true);
        }

        $name = $file->getRandomName();
        $file->move($dir, $name);

        service('image')
            ->withFile($dir . $name)
            ->fit(300, 300, 'center')
            ->save($dir . $name);

        return $name;
    }
}