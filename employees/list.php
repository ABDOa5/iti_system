<?php
session_start();

include '../config/db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: list.php");
    exit();
}

$query = "SELECT employees.*, departments.name AS dept_name 
          FROM employees 
          LEFT JOIN departments ON employees.department_id = departments.id";
$res = mysqli_query($conn, $query);
$employees = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Employees List</h2>
        <a href="add.php" class="btn btn-info">Add Employee</a>
    </div>
    <table class="table table-dark table-striped text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Salary</th>
                <th>Position</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $emp): ?>
            <tr>
                <td><?= $emp['id'] ?></td>
                <td><?= htmlspecialchars($emp['name']) ?></td>
                <td>$<?= number_format($emp['salary'], 2) ?></td>
                <td><?= htmlspecialchars($emp['position']) ?></td>
                <td><span class="badge bg-info text-dark"><?= htmlspecialchars($emp['dept_name'] ?? 'None') ?></span></td>
                <td>
                    <!-- <a href="list.php?delete=<?= $emp['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a> -->
                    <a href="edit.php?edit=<?= $emp['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    <a href="list.php?delete=<?= $emp['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>