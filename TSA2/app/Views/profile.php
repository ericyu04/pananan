<?= $this->include('header') ?>

<h1>Profile</h1>
<?php if ($user): ?>
    <table class="table table-bordered w-50">
        <tr><th>Username</th><td><?= esc($user['username']) ?></td></tr>
        <tr><th>Full Name</th><td><?= esc($user['full_name']) ?></td></tr>
        <tr><th>Email</th><td><?= esc($user['email']) ?></td></tr>
        <tr><th>Member Since</th><td><?= esc($user['created_at']) ?></td></tr>
    </table>
<?php else: ?>
    <p>No user found.</p>
<?php endif ?>

<?= $this->include('footer') ?>