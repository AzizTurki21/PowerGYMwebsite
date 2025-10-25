<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gymdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize user_activities in the session if not set
if (!isset($_SESSION['user_activities'])) {
    $_SESSION['user_activities'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["activity"])) {
    $activity = $_POST["activity"];
    $price = $_POST["price"];
    $username = $_SESSION['username'];

    // Check if the activity is not already added
    $check_activity_sql = "SELECT * FROM client_info WHERE name=? AND activites LIKE ?";
    $stmt = $conn->prepare($check_activity_sql);

    // Store the session variable in a temporary variable before binding
    $tempUsername = $username;
    $stmt->bind_param("ss", $activity, $tempUsername);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // If the activity is not already added, proceed with adding
        $add_activity_sql = $conn->prepare("UPDATE client_info SET activites = CONCAT(activites, ', ', ?), full_price = full_price + ? WHERE name = ?");
        $add_activity_sql->bind_param("sss", $activity, $price, $username);

        if ($add_activity_sql->execute()) {
            // Update the session data
            $_SESSION['user_activities'][] = $activity;
            $_SESSION['success_message'] = "Activity added successfully!";
        } else {
            $_SESSION['error_message'] = "Error adding activity: " . $add_activity_sql->error;
        }
    } else {
        $_SESSION['error_message'] = "Activity already added!";
    }
}

$conn->close();
header("Location: services.php");
exit();
?>
