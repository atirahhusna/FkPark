<?php
session_start(); // Start the session

include("dbase.php");

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

if (isset($_GET['VehicleID'])) {
    $vehicleID = $_GET['VehicleID'];

    // Update the approval status in the database
    $query = "UPDATE register_vehicle SET ApprovalStatus = 'Approved' WHERE VehicleID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $vehicleID);

    if ($stmt->execute()) {
        // Redirect back to the page where staff can view the list of vehicles
        header("Location: staffApprove.php");
        exit;
    } else {
        // Handle error if update fails
        $error = "Error: " . $stmt->error;
        $_SESSION['error'] = $error;
        header("Location: staffApprove.php");
        exit;
    }

    $stmt->close();
} else {
    // Redirect back to the page where staff can view the list of vehicles if VehicleID is not set
    header("Location: staffApprove.php");
    exit;
}
?>
