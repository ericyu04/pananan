<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title><?= esc($title ?? 'Tasks for Today') ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Welcome</a></li>
        <li class="nav-item"><a class="nav-link" href="/tasks">Task List</a></li>
        <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <?php if (session()->get('isLoggedIn')): ?>
            <li class="nav-item"><span class="nav-link">Welcome, <?= esc(session()->get('username')) ?></span></li>
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