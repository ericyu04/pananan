<?= $this->include('include/header') ?>

<h1><?= $product ? 'Edit' : 'Add' ?> Product</h1>
<form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $product['name'] ?? '') ?>">
    </div> <?= validation_show_error('name') ?>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="<?= old('price', $product['price'] ?? '') ?>">
    </div> <?= validation_show_error('price') ?>
    <div class="mb-3">
        <label for="stock_quantity" class="form-label">Stock Quantity</label>
        <input type="number" min="0" class="form-control" id="stock_quantity" name="stock_quantity" value="<?= old('stock_quantity', $product['stock_quantity'] ?? 0) ?>">
    </div> <?= validation_show_error('stock_quantity') ?>
    <div class="mb-3">
        <label for="image" class="form-label">Image (JPG/PNG, max 2MB)</label>
        <?php if (! empty($product['image'])): ?>
            <div class="mb-2"><img src="<?= image_url($product['image'], 'products') ?>" width="100" alt="Current image"></div>
        <?php endif ?>
        <input type="file" class="form-control" id="image" name="image" accept="image/png,image/jpeg">
    </div> <?= validation_show_error('image') ?>
    <button type="submit" class="btn btn-primary"><?= $product ? 'Update' : 'Add' ?> Product</button>
    <a href="/products" class="btn btn-link">Cancel</a>
</form>

<?= $this->include('include/footer') ?>