<?php

// Array of programming languages
$languages = ["PHP", "JavaScript", "Python", "Java", "C++"];

$profileCreated = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Basic security (good practice even before OOP)
  $fullname = htmlspecialchars($_POST['fullname']);
  $age = htmlspecialchars($_POST['age']);
  $course = htmlspecialchars($_POST['course']);
  $favorite = htmlspecialchars($_POST['favorite']);
  $bio = htmlspecialchars($_POST['bio']);

  $profileCreated = true;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Student Profile Generator</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      padding: 30px;
    }

    .container {
      width: 500px;
      margin: auto;
    }

    form {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px #ccc;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 15px;
    }

    button {
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }

    .profile-card {
      margin-top: 30px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px #ccc;
    }

    .minor {
      color: red;
    }

    .adult {
      color: green;
    }
  </style>

</head>

<body>
  <a href="logout.php">logout</a>
  <div class="container">

    <h2>Student Profile Generator</h2>

    <form id="profileForm" method="POST">

      <label>Full Name:</label>
      <input type="text" id="fullname" name="fullname">

      <label>Age:</label>
      <input type="number" id="age" name="age">

      <label>Course:</label>
      <input type="text" id="course" name="course">

      <label>Favorite Programming Language:</label>
      <select id="favorite" name="favorite">
        <?php
        foreach ($languages as $lang) {
          echo "<option value='$lang'>$lang</option>";
        }
        ?>
      </select>

      <label>Short Bio:</label>
      <textarea id="bio" name="bio"></textarea>

      <button type="submit">Generate Profile</button>

    </form>

    <?php if ($profileCreated): ?>
      <div class="profile-card">
        <h3>Student Profile</h3>

        <p><strong>Name:</strong>
          <?php echo $fullname; ?>
        </p>
        <p><strong>Age:</strong>
          <?php echo $age; ?>
        </p>
        <p><strong>Course:</strong>
          <?php echo $course; ?>
        </p>
        <p><strong>Favorite Language:</strong>
          <?php echo $favorite; ?>
        </p>
        <p><strong>Bio:</strong>
          <?php echo $bio; ?>
        </p>

        <?php
        // Age condition
        if ($age < 18) {
          echo "<p class='minor'><strong>Status:</strong> Minor Student</p>";
        } else {
          echo "<p class='adult'><strong>Status:</strong> Adult Student</p>";
        }

        // Favorite language condition
        if ($favorite == "PHP") {
          echo "<p><strong>Message:</strong> Great! You are ready for OOP in PHP!</p>";
        } else {
          echo "<p><strong>Message:</strong> You will soon learn OOP using PHP!</p>";
        }
        ?>
      </div>
    <?php endif; ?>

  </div>

  <script>
    // Modern JavaScript approach
    document.getElementById("profileForm").addEventListener("submit", function(event) {

      const fullname = document.getElementById("fullname").value.trim();
      const age = document.getElementById("age").value.trim();
      const course = document.getElementById("course").value.trim();
      const bio = document.getElementById("bio").value.trim();

      if (fullname === "" || age === "" || course === "" || bio === "") {
        alert("Please complete all fields.");
        event.preventDefault(); // Stop form submission
      }

    });
  </script>

</body>

</html>
