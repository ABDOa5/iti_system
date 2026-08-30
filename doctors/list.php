<?php
session_start();

include '../config/db.php';
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE name LIKE ? OR address LIKE ?");
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    
    $res = mysqli_query($conn, "SELECT * FROM doctors");
}

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
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="m-0">Doctors List</h2>
    
    <div class="d-flex align-items-center gap-2">
        <form action="list.php" method="GET" class="d-flex gap-2 m-0">
            <input type="text" name="search" class="form-control" placeholder="Search by name or address..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
            <?php if(isset($_GET['search'])): ?>
                <a href="list.php" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </form>

        <a href="add.php" class="btn btn-info text-white text-nowrap">Add New Doctor</a>
    </div>
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
                <td>
                    <!-- <a href="list.php?delete=<?= $doc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a> -->
                
                <a href="edit.php?edit=<?= $doc['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                <a href="list.php?delete=<?= $doc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>

            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>