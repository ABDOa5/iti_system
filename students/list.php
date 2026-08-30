<?php
session_start();

include '../config/db.php';
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
$res = mysqli_query($conn, "SELECT students.*, departments.name AS dept_name FROM students LEFT JOIN departments ON students.department_id = departments.id");
$students = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Students List</h2>
        <a href="add.php" class="btn btn-info">Add Student</a>
    </div>
    <table class="table table-dark table-striped text-center">
        <thead><tr><th>ID</th><th>Name</th><th>Age</th><th>Address</th><th>Department</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td><?= $s['age'] ?></td>
                <td><?= htmlspecialchars($s['address']) ?></td>
                <td><span class="badge bg-info text-dark"><?= htmlspecialchars($s['dept_name'] ?? 'None') ?></span></td>
                <td>
                    <!-- <a href="list.php?delete=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a> -->
                    <a href="edit.php?edit=<?= $s['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    <a href="list.php?delete=<?= $s['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>