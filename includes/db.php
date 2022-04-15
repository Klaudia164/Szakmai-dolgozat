<?php
//adatbázishoz való csatlakozás
$servername = "localhost";
$username = "c31b202121";
$password = "_faoFC2VkXcA";
$dbname = "c31b202121";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
