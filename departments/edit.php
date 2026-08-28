<?php
include '../config/db.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM departments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $dept = $stmt->get_result()->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id   = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];

    $stmt = $conn->prepare("UPDATE departments SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $desc, $id);
    $stmt->execute();

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-warning text-center mb-4">Edit Department</h2>
    <form method="POST" class="card card-body bg-secondary text-white fw-bold">
        <input type="hidden" name="id" value="<?= $dept['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($dept['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($dept['description']) ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-warning w-100 fw-bold">Update Department</button>
    </form>
</div>
</body>
</html>
