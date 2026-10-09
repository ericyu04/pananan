<?= $this->include('include/header') ?>

<h1>Products</h1>
<a class="btn btn-primary mb-3" href="/products/new">Add Product</a>
<table class="table table-bordered align-middle">
    <thead><tr><th>Image</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><img src="<?= image_url($p['image'], 'products') ?>" width="60" height="60" alt="" class="rounded"></td>
            <td><?= esc($p['name']) ?></td>
            <td>₱<?= number_format((float) $p['price'], 2) ?></td>
            <td><?= esc($p['stock_quantity']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="/products/edit/<?= esc($p['id']) ?>">Edit</a>
                <form method="post" action="/products/delete/<?= esc($p['id']) ?>" class="d-inline"
                      onsubmit="return confirm('Archive this product?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?= $this->include('include/footer') ?>