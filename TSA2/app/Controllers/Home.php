<?php
namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new TaskModel();
        return view('home', [
            'title'  => 'Welcome',
            'tasks'  => $model->getToday(),
            'today'  => date('F j, Y'),
        ]);
    }
}