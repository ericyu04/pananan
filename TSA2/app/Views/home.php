<?= $this->include('header') ?>

<h1>Welcome!</h1>
<p>Today is <?= esc($today) ?>. Here are today's tasks:</p>

<?php if (empty($tasks)): ?>
    <p class="text-muted">No tasks for today.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead><tr><th>Title</th><th>Status</th></tr></thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['status']) ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>

<?= $this->include('footer') ?>