<?php 
$servername = "localhost";
$username = "root"; // Enter your MySQL username
$password = ""; // Dont enter your MySQL password here leave it empty
$db_name = "assignment"; // Enter your database name
$port = 3307; 

$conn = new mysqli($servername, $username, $password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "";
}
?>
