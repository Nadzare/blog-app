<?php
session_start();
require 'classes/User.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $user = new User();
    if ($user->login($username, $email)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Username atau email salah!";
    }
}

require 'views/header.php';
?>

<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php require 'views/footer.php'; ?>
