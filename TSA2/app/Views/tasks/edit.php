<?= $this->include('header') ?>

<h1>Edit Task</h1>
<form action="/tasks/edit/<?= esc($task['id']) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= old('title', $task['title']) ?>">
    </div> <?= validation_show_error('title') ?>
    <div class="mb-3">
        <label for="task_date" class="form-label">Date</label>
        <input type="date" class="form-control" id="task_date" name="task_date" value="<?= old('task_date', $task['task_date']) ?>">
    </div> <?= validation_show_error('task_date') ?>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <?php $status = old('status', $task['status']); ?>
        <select class="form-select" id="status" name="status">
            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="done" <?= $status === 'done' ? 'selected' : '' ?>>Done</option>
        </select>
    </div> <?= validation_show_error('status') ?>
    <button type="submit" class="btn btn-primary">Update Task</button>
    <a href="/tasks" class="btn btn-link">Cancel</a>
</form>

<?= $this->include('footer') ?>