<?php
$conn = new mysqli("sqlXXX.infinityfree.com","DB_USER","DB_PASS","DB_NAME");

$name = $_POST['name'];
$mobile = $_POST['mobile'];

$login_id = "NCH".rand(1000,9999);
$password = rand(100000,999999);

$conn->query("INSERT INTO users(name,mobile,login_id,password)
VALUES('$name','$mobile','$login_id','$password')");

$msg = "New Subscription
Name: $name
Mobile: $mobile
Login ID: $login_id
Password: $password";

file_get_contents("https://api.callmebot.com/whatsapp.php?phone=917637997738&text=".urlencode($msg)."&apikey=YOUR_API_KEY");

echo "<h3>Registration Successful</h3>";
echo "Login ID: <b>$login_id</b><br>";
echo "Password: <b>$password</b><br>";
echo "<br><a href='login.html'>Login Now</a>";
?>