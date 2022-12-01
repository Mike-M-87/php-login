<?php
$sql_host = "127.0.0.1";
$sql_username = "root";
$sql_password = "";
$sql_database = "pooling";
$crypt_key = "vote";

if (!isset($_SESSION)) {
    session_start();
};

$dbconnect = mysqli_connect($sql_host, $sql_username, $sql_password, $sql_database);

if (!$dbconnect) {
    echo "<script>alert(`Failed to connect to database: ${mysqli_connect_error()}`)</script>";
    echo "Database failed to Connect" . mysqli_connect_error();
};

if(isset($_POST["amvoting"])){
    $choosen_color = $_POST["color"];

    $inser_data = "INSERT INTO elections (selection) VALUES (?)";

    $stmt = $dbconnect->prepare($inser_data);

    $stmt->bind_param("s", $choosen_color);

    $stmt->execute();
}


// get the q parameter from URL
echo "Voted successful ✅ for  ".$_POST["color"]." \n";

echo "<a href='./results.php'> View results </a>";

?>

