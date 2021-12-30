<?php

$servername = "localhost";
$username = "phpszakmai";
$password = "dirW._/5d8pILDkk";
$dbname = "szakmai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>