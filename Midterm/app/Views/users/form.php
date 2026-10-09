<?= $this->include('include/header') ?>

<h1><?= $user ? 'Edit' : 'Add' ?> Staff</h1>
<form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $user['username'] ?? '') ?>">
    </div> <?= validation_show_error('username') ?>
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= old('full_name', $user['full_name'] ?? '') ?>">
    </div> <?= validation_show_error('full_name') ?>
    <div class="mb-3">
        <label for="password" class="form-label"><?= $user ? 'New Password (leave blank to keep current)' : 'Password' ?></label>
        <input type="password" class="form-control" id="password" name="password">
    </div> <?= validation_show_error('password') ?>
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar (JPG/PNG, max 2MB)</label>
        <?php if (! empty($user['avatar'])): ?>
            <div class="mb-2"><img src="<?= image_url($user['avatar'], 'avatars') ?>" width="80" alt="Current avatar" class="rounded-circle"></div>
        <?php endif ?>
        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/png,image/jpeg">
    </div> <?= validation_show_error('avatar') ?>
    <button type="submit" class="btn btn-primary"><?= $user ? 'Update' : 'Add' ?> Staff</button>
    <a href="/users" class="btn btn-link">Cancel</a>
</form>

<?= $this->include('include/footer') ?>