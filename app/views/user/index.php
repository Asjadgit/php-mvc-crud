<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #f4f4f4; }
        a { text-decoration: none; padding: 6px 10px; background: #007bff; color: white; border-radius: 4px; }
        .delete { background: #dc3545; }
        .top-btn { margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>

<h2>Users</h2>

<a class="top-btn" href="/php-crud-mvc/public/user/create">+ Add User</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="/php-mvc/public/user/edit/<?= $user['id'] ?>">Edit</a>
                        <a class="delete" 
                           href="/php-mvc/public/user/destroy/<?= $user['id'] ?>"
                           onclick="return confirm('Are you sure?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No users found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
