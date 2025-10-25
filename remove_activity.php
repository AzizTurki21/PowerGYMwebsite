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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["activity"])) {
    $activity = $_POST["activity"];
    $username = $_SESSION['username'];


    if (in_array($activity, $_SESSION['user_activities'])) {
      
        $remove_activity_sql = $conn->prepare("UPDATE client_info SET activites = REPLACE(activites, ?, '') WHERE name = ?");
        $remove_activity_sql->bind_param("ss", $activity, $username);

       
        $get_full_price_sql = $conn->query("SELECT full_price FROM client_info WHERE name = '$username'");
        $row = $get_full_price_sql->fetch_assoc();
        $current_full_price = $row['full_price'];

       
        if ($activity == "Lifting") {
            $updated_full_price = $current_full_price - 20; // Adjust the price based on the activity's price
        } else if ($activity == "Cardio") {
            $updated_full_price = $current_full_price - 10;
        } else if ($activity == "Boxing") {
            $updated_full_price = $current_full_price - 25;
        }


        $update_full_price_sql = $conn->prepare("UPDATE client_info SET full_price = ? WHERE name = ?");
        $update_full_price_sql->bind_param("is", $updated_full_price, $username);

        if ($remove_activity_sql->execute() && $update_full_price_sql->execute()) {

            $_SESSION['user_activities'] = array_diff($_SESSION['user_activities'], [$activity]);
            $_SESSION['success_message'] = "Activity removed and price updated successfully!";
        } else {
            $_SESSION['error_message'] = "Error removing activity or updating price: " . $remove_activity_sql->error . ", " . $update_full_price_sql->error;
        }
    } else {
        $_SESSION['error_message'] = "Activity not found!";
    }
}

$conn->close();
header("Location: services.php");
exit();