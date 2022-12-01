<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php
require("db.php");
$signup_error = "";


if (isset($_POST["signup"])) {
    $email = htmlspecialchars($_POST["email"]);
    $firstname = htmlspecialchars($_POST["fname"]);
    $othernames = htmlspecialchars($_POST["othernames"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $password = htmlspecialchars($_POST["pwd"]);
    $confirmPassword = htmlspecialchars($_POST["confirmPwd"]);


    if (!($password == $confirmPassword)) {
        $signup_error = "Passwords do not match";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $signup_error = "Invalid email format";
    }

    if (empty($signup_error)) {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $dbconnect->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!empty($row)) {
            $signup_error = "User already exists";
        } else {
            $sql = "INSERT INTO users (email, firstname, othernames, contact, user_password) VALUES (?,?,?,?,?)";
            $stmt = $dbconnect->prepare($sql);
            // So what the 'ss' stands for is just a representation of the type of the input params
            $password = crypt($password, $crypt_key);
            $stmt->bind_param("sssss", $email, $firstname, $othernames, $contact, $password);
            $result = $stmt->execute();
            if ($result) {
                $signup_message = "Registration Successful";
                header("Location: login.php");
            }
        }
    }
}
?>

<body>
    <section class="regForm">
        <form method="POST">
            <div class="shape"></div>
            <div class="shape"></div>

            <h3>Register Here</h3>
            <?php
            if (!empty($signup_error)) {
                echo "<div class=\"errorbox\">{$signup_error}</div>";
            }
            ?>

            <input type="hidden" name="signup" value="signup" />

            <label for="email">Email</label>
            <input type="email" required placeholder="Enter your Email" name="email">

            <label for="fname">FirstName</label>
            <input type="text" required placeholder="Enter your firstname" name="fname">

            <label for="othernames">OtherNames</label>
            <input type="text" required placeholder="Enter other name" name="othernames">

            <label for="contact">Contact</label>
            <input type="text" required placeholder="Enter your phone number" name="contact">

            <label for="pwd">Password</label>
            <input type="password" required placeholder="Enter password" name="pwd">

            <label for="confirmPwd">Confirm Password</label>
            <input type="password" required placeholder="Enter password again" name="confirmPwd">

            <button class="formButton">Sign Up</button>
            <div class="altButton">Already a Member?<a href="/login.php">Login</a></div>
        </form>
    </section>
</body>

</html>