<?php
include '../config/db.php';

if (isset($_POST['add'])) {
    $name     = $_POST['name'];
    $duration = $_POST['duration'];

    $stmt = $conn->prepare("INSERT INTO courses (name, duration) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $duration);
    $stmt->execute();
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-info text-center mb-4">Add New Course</h2>
    <form method="POST" class="card card-body bg-secondary text-white fw-bold">
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Duration (Hours)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-info w-100">Save Course</button>
    </form>
</div>
</body>
</html>