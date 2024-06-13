<?php
session_start();
include("dbase.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['AreaID'])) {
    $AreaID = mysqli_real_escape_string($conn, $_GET['AreaID']);

    // Delete query
    $query = "DELETE FROM parking_area WHERE AreaID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $AreaID);

    if ($stmt->execute()) {
        // Redirect back to AreaView.php or wherever appropriate after deletion
        header("Location: AreaView.php");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
        header("Location: AreaView.php?error=" . urlencode($error));
        exit;
    }

    $stmt->close();
} else {
    $error = "Invalid request method or AreaID not provided!";
    header("Location: AreaView.php?error=" . urlencode($error));
    exit;
}

$conn->close();
?>