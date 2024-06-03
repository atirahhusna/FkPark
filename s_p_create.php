<?php
session_start(); // Start the session
include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $StaffID = mysqli_real_escape_string($conn, $_POST['StaffID']);
    $StaffName = mysqli_real_escape_string($conn, $_POST['StaffName']);
    $StaffEmail = mysqli_real_escape_string($conn, $_POST['StaffEmail']);
    $StaffPhoneNum = mysqli_real_escape_string($conn, $_POST['StaffPhoneNum']);
    $userID = $_SESSION['userID']; // Retrieve userID from session

    if (!isset($_POST['update'])) {
        // Insert new record
        $query = "INSERT INTO staff (StaffID, StaffName, StaffEmail, StaffPhoneNum, userID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $StaffID, $StaffName, $StaffEmail, $StaffPhoneNum, $userID);

        if ($stmt->execute()) {
            $success = "Profile inserted successfully.";
            header("Location: s_p_view.php?success=" . urlencode($success));
            exit;
        } else {
            $error = "Error: " . $stmt->error;
            header("Location: s_p_view.php?error=" . urlencode($error));
            exit;
        }

        $stmt->close();
    } 
    
    }

    $conn->close();

?>
