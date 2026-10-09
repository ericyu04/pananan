<?= $this->include('include/header') ?>

<h1><?= $customer ? 'Edit' : 'Add' ?> Customer</h1>
<form action="<?= esc($action) ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= old('full_name', $customer['full_name'] ?? '') ?>">
    </div> <?= validation_show_error('full_name') ?>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $customer['email'] ?? '') ?>">
    </div> <?= validation_show_error('email') ?>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone (optional)</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="<?= old('phone', $customer['phone'] ?? '') ?>">
    </div> <?= validation_show_error('phone') ?>
    <button type="submit" class="btn btn-primary"><?= $customer ? 'Update' : 'Add' ?> Customer</button>
    <a href="/customers" class="btn btn-link">Cancel</a>
</form>

<?= $this->include('include/footer') ?>