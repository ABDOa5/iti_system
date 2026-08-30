<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - ITI System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>body { background-color: #212529; color: white; }</style>
</head>
<body class="pt-3">
    <?php include '../shared/nav.php'; ?>
    <div class="container text-center py-5">
        <h1 class="display-4 text-info fw-bold mb-3">Welcome to Management System</h1>
        <p class="lead text-light mb-5">Manage Doctors, Students, Courses, Departments, and Employees easily.</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-secondary text-white p-3">
                    <h3>Doctors</h3>
                    <a href="../doctors/list.php" class="btn btn-info mt-2">Manage Doctors</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary text-white p-3">
                    <h3>Students</h3>
                    <a href="../students/list.php" class="btn btn-info mt-2">Manage Students</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary text-white p-3">
                    <h3>Departments</h3>
                    <a href="../departments/list.php" class="btn btn-info mt-2">Manage Departments</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>