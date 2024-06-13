<?php
session_start();
include("dbase.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SpaceID = mysqli_real_escape_string($conn, $_POST['SpaceID']);
    $Location = mysqli_real_escape_string($conn, $_POST['Location']);
    $Status = mysqli_real_escape_string($conn, $_POST['Status']);
    $AreaID = mysqli_real_escape_string($conn, $_POST['AreaID']);

    if (!isset($_SESSION['userID'])) {
        $error = "User not logged in.";
        header("Location: SpaceView.php?error=" . urlencode($error));
        exit;
    }

    $userID = $_SESSION['userID'];

    $areaQuery = "SELECT 1 FROM parking_area WHERE AreaID = ?";
    $areaStmt = $conn->prepare($areaQuery);
    $areaStmt->bind_param('s', $AreaID);
    $areaStmt->execute();
    $areaStmt->store_result();

    if ($areaStmt->num_rows > 0) {
        $query = "INSERT INTO parking_space (SpaceID, Location, Status, AreaID) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $SpaceID, $Location, $Status, $AreaID);

        if ($stmt->execute()) {
            header("Location: SpaceView.php?userID=" . urlencode($userID));
            exit;
        } else {
            $error = "Error: " . $stmt->error;
            header("Location: SpaceView.php?error=" . urlencode($error));
            exit;
        }

        $stmt->close();
    } else {
        $error = "Invalid AreaID.";
        header("Location: SpaceView.php?error=" . urlencode($error));
        exit;
    }

    $areaStmt->close();
} else {
    $error = "Invalid request method.";
    header("Location: SpaceView.php?error=" . urlencode($error));
    exit;
}

$conn->close();
?>