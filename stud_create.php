<?php
session_start(); // Start the session
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

    if (!isset($_POST['update'])) {
        // Insert new record
        $query = "INSERT INTO student (StudentID, StudName, StudPhoneNum, StudSemester, userID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $StudentID, $StudName, $StudPhoneNum, $StudSemester, $userID);

        if ($stmt->execute()) {
            $success = "Profile inserted successfully.";
            header("Location: studView.php?success=" . urlencode($success));
            exit;
        } else {
            $error = "Error: " . $stmt->error;
            header("Location: StudView.php?error=" . urlencode($error));
            exit;
        }

        $stmt->close();
    } 
    
    }

    $conn->close();

?>
