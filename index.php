<?php
$ip = "3.23.157.65";
$userName = "simforpay";
$password = "simforpay0!";
$databaseName = "simforpay";
$port = "3306";

$conn = mysqli_connect( $ip, $userName, $password, $databaseName, $port);

if (mysqli_connect_errno())
{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo "succesful connect";
$sql = "SELECT VERSION()";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>
