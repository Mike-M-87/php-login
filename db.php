<?php
$sql_host = "127.0.0.1";
$sql_username = "root";
$sql_password = "7bf)B_jiAmz1Qa5/";
$sql_database = "mydatabase";
$crypt_key = "vote";
function connect_db()
{
    global $sql_host, $sql_username, $sql_password, $sql_database;
    $conn = new mysqli($sql_host, $sql_username, $sql_password);
    $conn->select_db($sql_database);
    return $conn;
}
