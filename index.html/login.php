<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){
$email=$_POST['email'];
$pass=$_POST['password'];

$q=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user=mysqli_fetch_assoc($q);

if(password_verify($pass,$user['password'])){
 $_SESSION['user_id']=$user['id'];
 $_SESSION['is_paid']=$user['is_paid'];
 header("Location: dashboard.php");
}
}
?>
