<?= $this->include('header') ?>

<h1>Task List</h1>
<a class="btn btn-primary mb-3" href="/tasks/new">Add New Task</a>

<table class="table table-bordered">
    <thead>
        <tr><th>Title</th><th>Status</th><th>Date</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= esc($task['title']) ?></td>
            <td><?= esc($task['status']) ?></td>
            <td><?= esc($task['task_date']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="/tasks/edit/<?= esc($task['id']) ?>">Edit</a>
                <form method="post" action="/tasks/delete/<?= esc($task['id']) ?>" class="d-inline"
                      onsubmit="return confirm('Archive this task?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?= $this->include('footer') ?>