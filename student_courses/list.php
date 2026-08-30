<?php
session_start();

include '../config/db.php';
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM student_courses WHERE id = ?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    header("Location: list.php"); exit();
}
$query = "SELECT student_courses.id, students.name AS student_name, courses.name AS course_name, student_courses.grade 
          FROM student_courses 
          JOIN students ON student_courses.student_id = students.id
          JOIN courses ON student_courses.course_id = courses.id";
$res = mysqli_query($conn, $query);
$grades = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grades List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white pt-3">
<?php include '../shared/nav.php'; ?>
<div class="container" style="max-width: 900px;">
    <div class="d-flex justify-content-between mb-4">
        <h2>Student Grades</h2>
        <a href="add.php" class="btn btn-info">Assign Grade</a>
    </div>
    <table class="table table-dark table-striped text-center">
        <thead><tr><th>ID</th><th>Student</th><th>Course</th><th>Grade</th><th>Action</th></tr></thead>
        <tbody>
            <?php foreach ($grades as $g): ?>
            <tr>
                <td><?= $g['id'] ?></td>
                <td><?= htmlspecialchars($g['student_name']) ?></td>
                <td><?= htmlspecialchars($g['course_name']) ?></td>
                <td><span class="badge bg-warning text-dark"><?= $g['grade'] ?>%</span></td>
                <td>
                    <!-- <a href="list.php?delete=<?= $g['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a> -->
                    <a href="edit.php?edit=<?= $g['id'] ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                    <a href="list.php?delete=<?= $g['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>