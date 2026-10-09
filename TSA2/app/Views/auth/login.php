<?= $this->include('header') ?>

<div style="max-width: 420px;">
    <h1 class="h3 mb-3">Login</h1>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
        </div> <?= validation_show_error('username') ?>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div> <?= validation_show_error('password') ?>
        <button type="submit" class="btn btn-primary w-100">Log In</button>
    </form>
</div>

<?= $this->include('footer') ?>