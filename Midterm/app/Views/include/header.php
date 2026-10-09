<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title><?= esc($title ?? 'POS') ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <?php if (session()->get('isLoggedIn')): ?>
        <li class="nav-item"><a class="nav-link" href="/sales/new">Record Sale</a></li>
        <li class="nav-item"><a class="nav-link" href="/sales">Sales History</a></li>
        <li class="nav-item"><a class="nav-link" href="/products">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="/customers">Customers</a></li>
        <li class="nav-item"><a class="nav-link" href="/users">Staff</a></li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><span class="nav-link">Hi, <?= esc(session()->get('username')) ?></span></li>
        <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
        <?php endif ?>
    </ul>
</nav>
<div class="container mt-4">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('message')) ?></div>
    <?php endif ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif ?>