<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Users</title>
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
        <h1>User List</h1>
        <p>This is the users page.</p>
        <button class="btn btn-primary mb-3" onclick="window.location.href='/users/new'">Add New User</button>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <p class="card-text">Below is a list of the registered users.</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <?php $img = ! empty($user['avatar']) ? 'uploads/' . $user['avatar'] : 'images/placeholder.png'; ?>
                                    <img src="<?= base_url($img) ?>" alt="Avatar" width="50" height="50" class="rounded-circle">
                                </td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['full_name']) ?></td>
                                <td><?= esc($user['created_at']) ?></td>
                                <td> <a class= "btn btn-secondary" href="/users/edit/<?= esc($user['id']) ?>">Edit</a> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>