<?php

session_start();
error_reporting(0);
ob_start();
date_default_timezone_set("europe/istanbul");


$url 	= "http://localhost/fitlife/";

try {
    $conn = new PDO("mysql:host=localhost;dbname=fitlife", "root", "");

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
