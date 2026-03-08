<?php
session_start();
require "pdo.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user'] = $user['username'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid username or password.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
</head>

<body>

  <h2>Login</h2>

  <?php if (!empty($error)): ?>
    <p style="color:red;">
      <?php echo $error; ?>
    </p>
  <?php endif; ?>

  <form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
  </form>
  <span>
    <p>Don't have an account yet?</p><a href="register.php">sign up!</a>
  </span>

</body>

</html>
