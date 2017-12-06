<?php
$servername = "localhost";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>