<?php
include '../config/db.php';

$deps = mysqli_query($conn, "SELECT * FROM departments");

if (isset($_POST['add'])) {
    $name    = $_POST['name'];
    $salary  = $_POST['salary'];
    $pos     = $_POST['position'];
    $dept_id = $_POST['department_id'];

    $stmt = $conn->prepare("INSERT INTO employees (name, salary, position, department_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $name, $salary, $pos, $dept_id);
    $stmt->execute();
    header("Location: list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-info text-center mb-4">Add Employee</h2>
    <form method="POST" class="card card-body bg-secondary text-white fw-bold">
        <div class="mb-3">
            <label class="form-label">Employee Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">Select Department</option>
                <?php while($d = mysqli_fetch_assoc($deps)): ?>
                    <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-info w-100">Save Employee</button>
    </form>
</div>
</body>
</html>