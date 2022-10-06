<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>


<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>

<body>
    <div class="shape"></div>
    <div class="shape"></div>

    <h1 style="text-align: center; color:white;">Hello</h1>
    <div style="display: flex; justify-content:space-around">
        <a href="/login.php" class="startButton">Login</a>
        <a href="/register.php" class="startButton">Register</a>
    </div>
</body>

</html>