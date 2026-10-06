<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>About</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/customers">Customers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">Users</a>
            </li>
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
        <h1>About Us</h1>
        <p>Welcome to our About page!</p>
    </div>
</body>
</html>