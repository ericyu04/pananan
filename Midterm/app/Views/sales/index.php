<?= $this->include('include/header') ?>

<h1>Sales History</h1>
<a class="btn btn-primary mb-3" href="/sales/new">Record Sale</a>
<table class="table table-bordered">
    <thead>
        <tr><th>Date</th><th>Product</th><th>Customer</th><th>Staff</th><th>Qty</th><th>Total</th></tr>
    </thead>
    <tbody>
    <?php foreach ($sales as $s): ?>
        <tr>
            <td><?= esc($s['created_at']) ?></td>
            <td><?= esc($s['product_name']) ?></td>
            <td><?= esc($s['customer_name'] ?? 'Walk-in') ?></td>
            <td><?= esc($s['staff_name']) ?></td>
            <td><?= esc($s['quantity']) ?></td>
            <td>₱<?= number_format((float) $s['total_price'], 2) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <?php if ($sales): ?>
    <tfoot>
        <tr><th colspan="5" class="text-end">Total</th>
            <th>₱<?= number_format(array_sum(array_column($sales, 'total_price')), 2) ?></th></tr>
    </tfoot>
    <?php endif ?>
</table>

<?= $this->include('include/footer') ?>