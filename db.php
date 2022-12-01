<?php
$sql_host = "localhost";
$sql_username = "root";
$sql_password = "mysqlroot";
$sql_database = "voting";
$crypt_key = "vote";

if (!isset($_SESSION)) {
    session_start();
};

$dbconnect = mysqli_connect($sql_host, $sql_username, $sql_password, $sql_database);
// $conn = new mysqli($sql_host, $sql_username, $sql_password);
// $conn->select_db($sql_database);
if (!$dbconnect) {
    echo "<script>alert(`Failed to connect to database: ${mysqli_connect_error()}`)</script>";
    echo "Database failed to Connect" . mysqli_connect_error();
};
