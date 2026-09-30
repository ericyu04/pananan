<?php
namespace App\Controllers;
use CodeIgniter\Model;
use App\Models\TaskModel;
use App\Models\UserModel;

class MainController extends BaseController //hi sir dito ko na nilahat
{
    public function welcome()
    {
        $taskModel = new TaskModel();
        $data['tasks'] = $taskModel->
        where('task_date', date('Y-m-d'))->findAll();

        return view('welcome', $data);
    }

    public function tasks()
    {
        $taskModel = new TaskModel();
        $data['tasks'] = $taskModel->orderBy('task_date', 'ASC')->findAll();

        return view('tasks', $data);
    }

    public function profile()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find(1);

        return view('profile', $data);
    }

    public function about()
    {
        return view('about');
    }
}
