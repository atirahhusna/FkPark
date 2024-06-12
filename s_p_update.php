<?php
session_start();
include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $StaffID = mysqli_real_escape_string($conn, $_POST['StaffID']);
    $StaffName = mysqli_real_escape_string($conn, $_POST['StaffName']);
    $StaffPhoneNum = mysqli_real_escape_string($conn, $_POST['StaffPhoneNum']);
    $StaffEmail = mysqli_real_escape_string($conn, $_POST['StaffEmail']);
    $userID = $_SESSION['userID']; // Retrieve userID from session

    // Update existing record
    $query = "UPDATE staff SET StaffID = ?, StaffName = ?, StaffPhoneNum = ?, StaffEmail = ? WHERE userID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $StaffID, $StaffName, $StaffPhoneNum, $StaffEmail, $userID);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: s_p_view.php");
    exit;
}

$conn->close();
?>
