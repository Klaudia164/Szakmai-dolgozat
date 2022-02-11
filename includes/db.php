<?php

$servername = "localhost";
$username = "c31b202121";
$password = "_faoFC2VkXcA";
$dbname = "c31b202121";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>
