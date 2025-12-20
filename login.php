<?php
$conn = new mysqli("sqlXXX.infinityfree.com","DB_USER","DB_PASS","DB_NAME");

$id = $_POST['login_id'];
$pass = $_POST['password'];

$res = $conn->query("SELECT * FROM users WHERE login_id='$id' AND password='$pass'");

if($res->num_rows > 0){
  echo "<h2>Login Successful</h2>";
  echo "Welcome to Northeast Career Hub";
}else{
  echo "<h2>Invalid Login</h2>";
}
?>