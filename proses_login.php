
<?php
session_start();
$conn = mysqli_connect("localhost","root","","beasiswa");
$email = $_POST['email'];
$pass  = $_POST['password'];
$q = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email' AND password='$pass'");
if(mysqli_num_rows($q)>0){
  $_SESSION['login']=true;
  header("Location: admin.php");
} else {
  echo "Login gagal! <a href='index.php'>Coba lagi</a>";
}