<?php
include '../config/db.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO departments (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $desc);
    $stmt->execute();
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Department</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container">
    <h2 class="text-info text-center mb-4">Add Department</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" class="card card-body bg-secondary text-white fw-bold">
                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="add" class="btn btn-info w-100">Save</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>