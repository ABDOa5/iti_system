<?php
include '../config/db.php';
if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO doctors (name, age, address) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $_POST['name'], $_POST['age'], $_POST['address']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-info text-center mb-4">Add Doctor</h2>
    <form method="POST" class="card card-body bg-secondary text-white">
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label>Age</label><input type="number" name="age" class="form-control" required></div>
        <div class="mb-3"><label>Address</label><input type="text" name="address" class="form-control" required></div>
        <button type="submit" name="add" class="btn btn-info">Save</button>
    </form>
</div>
</body>
</html>