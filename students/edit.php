<?php
include '../config/db.php';

$deps = mysqli_query($conn, "SELECT * FROM departments");

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $age     = $_POST['age'];
    $address = $_POST['address'];
    $dept_id = $_POST['department_id'];

    $stmt = $conn->prepare("UPDATE students SET name = ?, age = ?, address = ?, department_id = ? WHERE id = ?");
    $stmt->bind_param("sisii", $name, $age, $address, $dept_id, $id);
    $stmt->execute();

    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-warning text-center mb-4">Edit Student</h2>
    <form method="POST" class="card card-body bg-secondary text-white fw-bold">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" value="<?= $student['age'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" value="<?= htmlspecialchars($student['address']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <?php while($d = mysqli_fetch_assoc($deps)): ?>
                    <option value="<?= $d['id'] ?>" <?= $d['id'] == $student['department_id'] ? 'selected' : '' ?>>
                        <?= $d['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-warning w-100 fw-bold">Update Student</button>
    </form>
</div>
</body>
</html>