<!DOCTYPE html>
<html>
<head>
    <title>LoginPage</title>
</head>

<body>
<?php
session_start();
require_once("LoginToDatabase.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $_POST['email'] = $email;
        header("Location: HomePage.php");
    } else {
        $error = "Invalid email or password";
    }
}
?>
<h1>Welcome to Yelp!  Log in here</h1>
<form method="post">
    <label for='email'>Email </label><br>
    <input type='text' name='email'/><br>
    <label for='password'>Password </label><br>
    <input type='text' name='password'/><br>
    <input type='submit' value='Log in'/>
</html>