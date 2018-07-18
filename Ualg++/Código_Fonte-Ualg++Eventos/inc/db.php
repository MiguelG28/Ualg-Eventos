<?php

$servername = "eu-cdbr-azure-west-b.cloudapp.net";
$username = "b601bc908eaf6c";
$password = "65a48d63";

// Create connection
$db = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
return $db;
?>


