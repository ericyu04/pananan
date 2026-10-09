<?php
namespace App\Controllers;

use App\Models\TaskModel;

class Tasks extends BaseController
{
    public function index()
    {
        $model = new TaskModel();
        return view('tasks/index', [
            'title' => 'Task List',
            'tasks' => $model->getAllActive(),
        ]);
    }

    public function new()
    {
        return view('tasks/new', ['title' => 'New Task']);
    }

    public function create()
    {
        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput();
        }

        $model = new TaskModel();
        $model->insert([
            'title'     => $this->request->getPost('title'),
            'task_date' => $this->request->getPost('task_date'),
            'status'    => 'pending',
        ]);

        session()->setFlashdata('message', 'Task added successfully!');
        return redirect()->to('/tasks');
    }

    public function edit($id)
    {
        $task = $this->findActiveOrFail($id);
        return view('tasks/edit', ['title' => 'Edit Task', 'task' => $task]);
    }

    public function update($id)
    {
        $this->findActiveOrFail($id);

        $rules = [
            'title'     => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'status'    => 'required|in_list[pending,done]',
        ];
        if (! $this->validate($rules)) 
        {
            return redirect()->back()->withInput();
        }

        $model = new TaskModel();
        $model->update($id, [
            'title'     => $this->request->getPost('title'),
            'task_date' => $this->request->getPost('task_date'),
            'status'    => $this->request->getPost('status'),
        ]);

        session()->setFlashdata('message', 'Task updated successfully!');
        return redirect()->to('/tasks');
    }

    public function archive($id)
    {
        $this->findActiveOrFail($id);

        $model = new TaskModel();
        $model->update($id, ['is_archived' => 1]);

        session()->setFlashdata('message', 'Task archived.');
        return redirect()->to('/tasks');
    }

    private function findActiveOrFail($id)
    {
        $task = (new TaskModel())->where('is_archived', 0)->find($id);
        if (! $task)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found');
        }
        return $task;
    }
}