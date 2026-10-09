<?php
namespace App\Controllers;
use App\Models\SaleModel;
use App\Models\UserModel;

class Users extends BaseController
{
    private const AVATAR_RULE = 'max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]';

    private function findOrFail($id): array
    {
        $user = (new UserModel())->find($id);
        if (! $user)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }
        return $user;
    }

    public function index()
    {
        return view('users/index', [
            'title' => 'Staff',
            'users' => (new UserModel())->orderBy('full_name')->findAll(),
        ]);
    }

    public function new()
    {
        return view('users/form', ['title' => 'Add Staff', 'user' => null, 'action' => '/users']);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[2]|max_length[100]',
            'password'  => 'required|min_length[8]',
            'avatar'    => self::AVATAR_RULE,
        ];
        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $avatar = save_image($this->request->getFile('avatar'), 'avatars', 300);
        if ($avatar !== null) {
            $data['avatar'] = $avatar;
        }

        (new UserModel())->insert($data);
        session()->setFlashdata('message', 'Staff member added.');
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $user = $this->findOrFail($id);
        return view('users/form', ['title' => 'Edit Staff', 'user' => $user, 'action' => '/users/edit/' . $user['id']]);
    }

    public function update($id)
    {
        $user = $this->findOrFail($id);

        $rules = [
            'username'  => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[2]|max_length[100]',
            'password'  => 'permit_empty|min_length[8]',
            'avatar'    => self::AVATAR_RULE,
        ];
        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];
        $newPassword = $this->request->getPost('password');
        if (! empty($newPassword))
        {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }
        $avatar = save_image($this->request->getFile('avatar'), 'avatars', 300);
        if ($avatar !== null) {
            $data['avatar'] = $avatar;
            delete_image($user['avatar'], 'avatars');
        }

        (new UserModel())->update($id, $data);

        if ((int) $id === (int) session()->get('user_id'))
        {
            session()->set('username', $data['username']);
        }

        session()->setFlashdata('message', 'Staff member updated.');
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $user = $this->findOrFail($id);

        if ((int) $id === (int) session()->get('user_id'))
        {
            session()->setFlashdata('error', 'You cannot delete your own account.');
            return redirect()->to('/users');
        }
        if ((new SaleModel())->where('sold_by', $id)->countAllResults() > 0)
        {
            session()->setFlashdata('error', 'This staff member has recorded sales and cannot be deleted.');
            return redirect()->to('/users');
        }

        delete_image($user['avatar'], 'avatars');
        (new UserModel())->delete($id);
        session()->setFlashdata('message', 'Staff member deleted.');
        return redirect()->to('/users');
    }
}