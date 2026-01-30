<?php

$servername = "sql100.epizy.com";
$username = "epiz_29333365";
$password = "JA6S5YCSqYuq";
$dbname = "epiz_29333365_ItVendorService";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>