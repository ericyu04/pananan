<?= $this->include('include/header') ?>

<h1>Customers</h1>
<a class="btn btn-primary mb-3" href="/customers/new">Add Customer</a>
<table class="table table-bordered">
    <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Created At</th><th>Actions</th></tr></thead>
    <tbody>
    <?php foreach ($customers as $c): ?>
        <tr>
            <td><?= esc($c['full_name']) ?></td>
            <td><?= esc($c['email']) ?></td>
            <td><?= esc($c['phone']) ?></td>
            <td><?= esc($c['created_at']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="/customers/edit/<?= esc($c['id']) ?>">Edit</a>
                <form method="post" action="/customers/delete/<?= esc($c['id']) ?>" class="d-inline"
                      onsubmit="return confirm('Delete this customer?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?= $this->include('include/footer') ?>