<?= $this->include('include/header') ?>

<h1>Record Sale</h1>
<form action="/sales" method="post" style="max-width: 520px;">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="product_id" class="form-label">Product</label>
        <select class="form-select" id="product_id" name="product_id">
            <option value="">Select a product</option>
            <?php foreach ($products as $p): ?>
                <option value="<?= esc($p['id']) ?>"
                    <?= (string) old('product_id') === (string) $p['id'] ? 'selected' : '' ?>
                    <?= (int) $p['stock_quantity'] === 0 ? 'disabled' : '' ?>>
                    <?= esc($p['name']) ?> — ₱<?= number_format((float) $p['price'], 2) ?>
                    (<?= (int) $p['stock_quantity'] === 0 ? 'out of stock' : 'stock: ' . esc($p['stock_quantity']) ?>)
                </option>
            <?php endforeach ?>
        </select>
    </div> <?= validation_show_error('product_id') ?>
    <div class="mb-3">
        <label for="customer_id" class="form-label">Customer (optional)</label>
        <select class="form-select" id="customer_id" name="customer_id">
            <option value="">Walk-in customer</option>
            <?php foreach ($customers as $c): ?>
                <option value="<?= esc($c['id']) ?>" <?= (string) old('customer_id') === (string) $c['id'] ? 'selected' : '' ?>>
                    <?= esc($c['full_name']) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div> <?= validation_show_error('customer_id') ?>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" min="1" class="form-control" id="quantity" name="quantity" value="<?= old('quantity', 1) ?>">
    </div> <?= validation_show_error('quantity') ?>
    <button type="submit" class="btn btn-primary">Record Sale</button>
</form>

<?= $this->include('include/footer') ?>