<?php
session_start(); // Start the session
include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $VehicleID = mysqli_real_escape_string($conn, $_POST['VehicleID']);
    $VehicleType = mysqli_real_escape_string($conn, $_POST['VehicleType']);
    $VehicleName = mysqli_real_escape_string($conn, $_POST['VehicleName']);
    $NoPlate = mysqli_real_escape_string($conn, $_POST['NoPlate']);
    $OwnerName = mysqli_real_escape_string($conn, $_POST['OwnerName']);
    $OwnerAddress = mysqli_real_escape_string($conn, $_POST['OwnerAddress']);
    $PhoneNumberOwner = mysqli_real_escape_string($conn, $_POST['PhoneNumberOwner']);

    // Handle file upload
    $vehicleGrant = $_FILES['VehicleGrant'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($vehicleGrant['name']);

    if (move_uploaded_file($vehicleGrant['tmp_name'], $uploadFile)) {
        // Insert new record
        $query = "INSERT INTO register_vehicle (VehicleID, VehicleType, VehicleName, VehicleGrant, NoPlate, OwnerName, OwnerAddress, PhoneNumberOwner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssss', $VehicleID, $VehicleType, $VehicleName, $uploadFile, $NoPlate, $OwnerName, $OwnerAddress, $PhoneNumberOwner);

        if ($stmt->execute()) {
            // Display the file name in the HTML
            echo "Uploaded file: " . htmlspecialchars(basename($vehicleGrant['name']));
            header("Location: vehicleView.php?VehicleID=" . urlencode($VehicleID));
            exit;
        } else {
            $error = "Error: " . $stmt->error;
            header("Location: vehicleView.php?error=" . urlencode($error));
            exit;
        }

        $stmt->close();
    } else {
        $error = "Possible file upload attack!";
        header("Location: vehicleView.php?error=" . urlencode($error));
        exit;
    }

    $conn->close();
}
?>
