<?php
session_start();

include '../config/db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM departments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: list.php");
    exit();
}

$res = mysqli_query($conn, "SELECT * FROM departments");
$deps = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departments List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Departments List</h2>
        <a href="add.php" class="btn btn-info">Add Department</a>
    </div>
    <table class="table table-dark table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deps as $d): ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><?= htmlspecialchars($d['name']) ?></td>
                <td><?= htmlspecialchars($d['description']) ?></td>
                <td>
                    <!-- <a href="list.php?delete=<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirm Delete?')">Delete</a> -->
                    <a href="edit.php?edit=<?= $d['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    <a href="list.php?delete=<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>