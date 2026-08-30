<?php
session_start();
include './config/db.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
           
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = strtolower($user['type']);
                
                header("Location: doctors/list.php");
                exit();
            } else {
                $error = "كلمة المرور غير صحيحة!";
            }
        } else {
            $error = "البريد الإلكتروني غير موجود!";
        }
    } else {
        $error = "برجاء ملء جميع الحقول!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول - ITI System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card bg-secondary text-white p-4" style="width: 380px;">
    <h3 class="text-center mb-4">تسجيل الدخول</h3>
    
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger p-2 text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" class="form-control" required placeholder="admin@gmail.com">
        </div>
        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required placeholder="******">
        </div>
        <button type="submit" class="btn btn-info text-white w-100 mt-2">دخول</button>
    </form>
</div>

</body>
</html>