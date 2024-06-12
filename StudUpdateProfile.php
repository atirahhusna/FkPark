<?php
session_start();
include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $StudentID = mysqli_real_escape_string($conn, $_POST['StudentID']);
    $StudName = mysqli_real_escape_string($conn, $_POST['StudName']);
    $StudPhoneNum = mysqli_real_escape_string($conn, $_POST['StudPhoneNum']);
    $StudSemester = mysqli_real_escape_string($conn, $_POST['StudSemester']);
    $userID = $_SESSION['userID']; // Retrieve userID from session

    // Update existing record
    $query = "UPDATE student SET StudentID = ?, StudName = ?, StudPhoneNum = ?, StudSemester = ? WHERE userID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $StudentID, $StudName, $StudPhoneNum, $StudSemester, $userID);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: studView.php");
    exit;
}

$conn->close();
?>
