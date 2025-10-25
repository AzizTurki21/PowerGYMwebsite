<?php
session_start();

if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect them to the login page
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from the session
$username = $_SESSION['username'];

// Delete user information from the database
$sql = "DELETE FROM client_info WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    // If the deletion is successful, log out the user
    unset($_SESSION['username']);
    
    // Redirect to the home page
    header("Location: index.php");
    exit();
} else {
    // If an error occurs during deletion, display an error message
    echo "Error deleting user information.";
}

$stmt->close();
$conn->close();
?>
