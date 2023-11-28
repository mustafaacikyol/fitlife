<?php

session_start();
error_reporting(0);
ob_start();
date_default_timezone_set("europe/istanbul");

$url 	= "http://localhost/fitlife/";

$host = 'fitlife.cgax1dk8p37y.eu-north-1.rds.amazonaws.com';
$port = '3306'; // Typically 3306 for MySQL
$dbname = 'fitlife';
$username = 'admin';
$password = 'fitlife_123';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "success";

    // Now you can perform database operations using $conn

    // Remember to close the connection when you're done
    // $conn = null;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
