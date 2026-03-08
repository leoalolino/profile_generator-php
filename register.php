<?php
session_start();
require "pdo.php";
$err = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  if (empty($username) || empty($password)) {
    $err = "Input field shouldn't be empty.";
  } elseif ($password !== $confirm_password) {
    $err = "Passwords do not match.";
  } else {
    $check = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $check->execute(['username' => $username]);
    if ($check->fetch()) {
      $err = "Username already taken.";
    } else {
      $bcrypt = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("INSERT INTO users (username, password, created_at) VALUES (:username, :password, NOW())");
      $stmt->execute([
        'username' => $username,
        'password' => $bcrypt
      ]);
      $success = "Account created successfully!";
      if (!$success) header("Location: register.php");

      header("Location: login.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>

<body>

  <div class="register-container">
    <h2>Register</h2>
    <?php if (!empty($err)): ?>
      <?php echo $err; ?>
    <?php elseif (!empty($success)): ?>
      <?php echo $success; ?>
    <?php endif; ?>

    <form method="POST" action="register.php">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Re-enter password" required>
      </div>
      <button type="submit">Create Account</button>
    </form>

    <div class="login-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
</body>

</html>
