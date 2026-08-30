<?php

session_start();

include '../config/db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: list.php");
    exit();
}

$res = mysqli_query($conn, "SELECT id, name, email, role FROM users");
$users = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Users List</h2>
        <a href="add.php" class="btn btn-info">Add New User</a>
    </div>
    <table class="table table-dark table-striped text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <span class="badge <?= $u['role'] == 'admin' ? 'bg-warning text-dark' : 'bg-secondary' ?>">
                        <?= strtoupper($u['role']) ?>
                    </span>
                </td>
                <td>
                    <!-- <a href="list.php?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">Delete</a> -->
                    <a href="edit.php?edit=<?= $u['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    <a href="list.php?delete=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">Delete</a>
                </td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>