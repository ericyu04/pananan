<?= $this->include('include/header') ?>

<h1>Staff</h1>
<a class="btn btn-primary mb-3" href="/users/new">Add Staff</a>
<table class="table table-bordered align-middle">
    <thead><tr><th>Avatar</th><th>Username</th><th>Full Name</th><th>Created At</th><th>Actions</th></tr></thead>
    <tbody>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><img src="<?= image_url($u['avatar'], 'avatars') ?>" width="50" height="50" alt="" class="rounded-circle"></td>
            <td><?= esc($u['username']) ?></td>
            <td><?= esc($u['full_name']) ?></td>
            <td><?= esc($u['created_at']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="/users/edit/<?= esc($u['id']) ?>">Edit</a>
                <form method="post" action="/users/delete/<?= esc($u['id']) ?>" class="d-inline"
                      onsubmit="return confirm('Delete this staff member?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?= $this->include('include/footer') ?>