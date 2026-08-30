<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-info" href="/iti_system/home/index.php">ITI System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item"><a class="nav-link" href="/iti_system/home/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/doctors/list.php">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/departments/list.php">Departments</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/students/list.php">Students</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/courses/list.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/student_courses/list.php">Grades</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/employees/list.php">Employees</a></li>
                <li class="nav-item"><a class="nav-link" href="/iti_system/users/list.php">Users</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3">
                        <a href="/iti_system/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="/iti_system/login.php" class="btn btn-outline-info btn-sm">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>