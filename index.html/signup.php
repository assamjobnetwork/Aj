<?php
include 'config.php';

if(isset($_POST['signup'])){
 $name=$_POST['name'];
 $email=$_POST['email'];
 $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);

 mysqli_query($conn,
 "INSERT INTO users(name,email,password)
 VALUES('$name','$email','$pass')");

 header("Location: login.php");
}
?>
