<?= $this->include('header') ?>

<h1>Add New Task</h1>
<form action="/tasks" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>">
    </div> <?= validation_show_error('title') ?>
    <div class="mb-3">
        <label for="task_date" class="form-label">Date</label>
        <input type="date" class="form-control" id="task_date" name="task_date" value="<?= old('task_date', date('Y-m-d')) ?>">
    </div> <?= validation_show_error('task_date') ?>
    <button type="submit" class="btn btn-primary">Add Task</button>
    <a href="/tasks" class="btn btn-link">Cancel</a>
</form>

<?= $this->include('footer') ?>