<?php
session_start();
include("dbase.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AreaID'])) {
    $AreaID = $_POST['AreaID'];
    $areaName = $_POST['areaName'];
    $status = $_POST['status'];
    $reason = $_POST['reason'];

    // Update the parking area in the database
    $query = "UPDATE parking_area SET AreaName = ?, Status = ?, Reason = ? WHERE AreaID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $AreaName, $Status, $Reason, $AreaID);

    if ($stmt->execute()) {
        // Redirect to the edit page with success message
        header("Location: AreaView.php?AreaID=$AreaID&success=1");
        exit();
    } else {
        die("Error updating parking area: " . $conn->error);
    }
} else {
    die("Invalid request.");
}
?>