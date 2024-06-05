<?php
include("dbase.php");

if(isset($_GET['VehicleID'])) {
    $vehicleID = $_GET['VehicleID'];

    // Delete the record from the database
    $query = "DELETE FROM register_vehicle WHERE VehicleID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $vehicleID);

    if ($stmt->execute()) {
        // Redirect to the page where staff can view the updated list of vehicles
        header("Location: staffApprove.php");
        exit;
    } else {
        // Handle error if deletion fails
        $error = "Error: " . $stmt->error;
        header("Location: staffApprove.php?error=" . urlencode($error));
        exit;
    }

    $stmt->close();
} else {
    // Redirect if VehicleID is not set
    header("Location: staffApprove.php");
    exit;
}
?>
