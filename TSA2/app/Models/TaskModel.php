<?php
namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'status', 'task_date', 'is_archived'];
    protected $useTimestamps = true;
    protected $updatedField = '';

    public function getToday()
    {
        return $this
        ->where('task_date', date('Y-m-d'))
        ->where('is_archived', 0)
        ->orderBy('id', 'ASC')
        ->findAll();
    }

    public function getAllActive()
    {
        return $this
        ->where('is_archived', 0)
        ->orderBy('task_date', 'ASC')
        ->orderBy('id', 'ASC')
        ->findAll();
    }

}
?>