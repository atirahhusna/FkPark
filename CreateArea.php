<?php
session_start();
include("dbase.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $AreaID = mysqli_real_escape_string($conn, $_POST['AreaID']);
    $AreaName = mysqli_real_escape_string($conn, $_POST['AreaName']);
    $Status = mysqli_real_escape_string($conn, $_POST['Status']);
    $Reason = mysqli_real_escape_string($conn, $_POST['Reason']);

    $userID = $_SESSION['userID'];

    // Check if AreaID already exists
    $check_query = "SELECT * FROM parking_area WHERE AreaID = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param('s', $AreaID);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Redirect with error message if AreaID already exists
        $error = "Error: AreaID '$AreaID' already exists.";
        header("Location: CreateArea.php?error=" . urlencode($error));
        exit;
    }

    // Prepare and execute INSERT statement
    $insert_query = "INSERT INTO parking_area (AreaID, AreaName, Status, Reason) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param('ssss', $AreaID, $AreaName, $Status, $Reason);

    if ($insert_stmt->execute()) {
        // Redirect on success
        header("Location: AreaView.php?userID=" . urlencode($userID));
        exit;
    } else {
        // Redirect with error message on failure
        $error = "Error: " . $insert_stmt->error;
        header("Location: CreateArea.php?error=" . urlencode($error));
        exit;
    }

    $insert_stmt->close();
    $check_stmt->close();
} else {
    // Invalid request method handling
    $error = "Invalid request method!";
    header("Location: CreateArea.php?error=" . urlencode($error));
    exit;
}

$conn->close();
?>
