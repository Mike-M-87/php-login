<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
require("db.php");
$firstname = $_SESSION["firstname"];
$othernames = $_SESSION["othernames"];

if (empty($firstname) || empty($othernames)) {
    echo "<script type='text/javascript'>
            alert('Please Login To continue');
            window.location.assign('/');
        </script>";
}
?>

<body>
    <div class="welcome">
        <h1>Welcome To Your Page</h1>
        <h2 style="color:red"><?php echo $firstname, " ", $othernames ?></h2>
        <a class="startButton" href="index.php?logout=true">Logout</a>
    </div>
</body>

</html>