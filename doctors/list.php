<?php
include '../config/db.php';
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
$res = mysqli_query($conn, "SELECT * FROM doctors");
$doctors = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctors List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Doctors List</h2>
        <a href="add.php" class="btn btn-info">Add New Doctor</a>
    </div>
    <table class="table table-dark table-striped text-center">
        <thead><tr><th>ID</th><th>Name</th><th>Age</th><th>Address</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach ($doctors as $doc): ?>
            <tr>
                <td><?= $doc['id'] ?></td>
                <td><?= htmlspecialchars($doc['name']) ?></td>
                <td><?= $doc['age'] ?></td>
                <td><?= htmlspecialchars($doc['address']) ?></td>
                <td><a href="list.php?delete=<?= $doc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>