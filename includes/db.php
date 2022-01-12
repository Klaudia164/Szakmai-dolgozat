<?php

$servername = "localhost";
$username = "szakmai1";
$password = "Szakmai123!";
$dbname = "szakmai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>
