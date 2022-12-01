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

$sql = "SELECT selection,count(*) as c FROM elections GROUP BY selection;";

$data = mysqli_query($dbconnect,$sql);

while($row=mysqli_fetch_assoc($data)) {
    echo "</tr>";
    echo "<td>";
    echo $row["selection"];
    echo "</td>";

    echo "<td>";
    echo $row["c"];
    echo "</td>";

    echo "</tr>";
}

?>