<?php
include '../config/db.php';
$students = mysqli_query($conn, "SELECT * FROM students");
$courses  = mysqli_query($conn, "SELECT * FROM courses");

if (isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO student_courses (student_id, course_id, grade) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $_POST['student_id'], $_POST['course_id'], $_POST['grade']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Grade</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 500px;">
    <h2 class="text-info text-center mb-4">Assign Grade</h2>
    <form method="POST" class="card card-body bg-secondary text-white">
        <div class="mb-3">
            <label>Student</label>
            <select name="student_id" class="form-select" required>
                <?php while($s = mysqli_fetch_assoc($students)): ?>
                    <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Course</label>
            <select name="course_id" class="form-select" required>
                <?php while($c = mysqli_fetch_assoc($courses)): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3"><label>Grade (0-100)</label><input type="number" name="grade" class="form-control" required></div>
        <button type="submit" name="add" class="btn btn-info">Save Grade</button>
    </form>
</div>
</body>
</html>