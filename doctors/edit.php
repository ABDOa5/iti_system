<?php
include '../config/db.php';

// 1. جلب بيانات الدكتور المراد تعديله
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
}

// 2. تحديث البيانات عند ضغط Update
if (isset($_POST['update'])) {
    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $age     = $_POST['age'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE doctors SET name = ?, age = ?, address = ? WHERE id = ?");
    $stmt->bind_param("sisi", $name, $age, $address, $id);
    $stmt->execute();

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-warning text-center mb-4">Edit Doctor</h2>
    <form method="POST" class="card card-body bg-secondary text-white fw-bold">
        <input type="hidden" name="id" value="<?= $doctor['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Doctor Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($doctor['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" value="<?= $doctor['age'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" value="<?= htmlspecialchars($doctor['address']) ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning w-100 fw-bold">Update Doctor</button>
    </form>
</div>
</body>
</html>