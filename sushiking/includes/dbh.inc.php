<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sushiking";
$port = "3306";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";