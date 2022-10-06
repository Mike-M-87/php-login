<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>


<?php
require("db.php");
$login_message = "";
$login_error = "";
session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["pwd"];

    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $login_error = "Invalid email format";
    } else {

        $conn = connect_db();

        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!empty($row)) {
            if ($row["userPassword"] != crypt($password, $crypt_key)) {
                $login_error = "Invalid email or password";
            } else {
                $login_message = "Login successful";
                $_SESSION["firstname"] = $row["firstname"];
                $_SESSION["othernames"] = $row["othernames"];
                header("Location: welcome.php");
            }
        } else {
            $login_error = "User does not exist";
        }
    }
}
?>

<body>
    <a href="/" id="back" class="startButton">Back</a>
    <section class="regForm">
        <form class="formBox" method="POST">

            <div class="shape formShape"></div>
            <div class="shape formShape"></div>

            <input type="hidden" name="login" value="asas" />
            <h3>Login Here</h3>
            <?php

            if (!empty($login_message)) {
                echo "<div class=\"successbox\">{$login_message}</div>";
            }

            if (!empty($login_error)) {
                echo "<div class=\"errorbox\">{$login_error}</div>";
            }
            ?>

            <label for="email">Email</label>
            <input type="email" required placeholder="Enter your Email" name="email">

            <label for="pwd">Password</label>
            <input type="password" required placeholder="Enter password" name="pwd">

            <button class="formButton">Login</button>
            <div class="altButton">Not a Member?<a href="/register.php">Signup now</a></div>
        </form>


    </section>
</body>

</html>