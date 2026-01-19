<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "beasiswa");

$email = $_POST['email'];
$pass  = $_POST['password'];

$q = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$pass'");

if (mysqli_num_rows($q) > 0) {
  $_SESSION['login'] = true;
  header("Location: admin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Login Gagal</title>
  <link rel="stylesheet" href="proses_login.css">
</head>

<body>

  <div class="error-box">
    <h2>Login Gagal 🚫</h2>
    <p>Email atau password salah.</p>
    <a class="btn" href="index.php">Coba Lagi</a>
  </div>

</body>

</html>