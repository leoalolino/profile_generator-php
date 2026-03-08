<?php
$host = "localhost";
$dbname = "profile_generator";
$username = "root";
$port = "3306";
$password = "";

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);

  // Show errors properly
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Database connected successfully!";
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
