<?php
session_start(); // Start the session
include("dbase.php"); // Include your database connection file

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
        // Assuming userID is stored in the session
        $userID = $_SESSION['userID']; // Adjust this according to your session variable

        // Insert new record
        $query = "INSERT INTO register_vehicle (UserID, VehicleID, VehicleType, VehicleName, VehicleGrant, NoPlate, OwnerName, OwnerAddress, PhoneNumberOwner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt === false) {
            $error = "Error preparing statement: " . $conn->error;
            header("Location: StudentVehicleList.php?error=" . urlencode($error));
            exit;
        }

        $stmt->bind_param('sssssssss', $userID, $VehicleID, $VehicleType, $VehicleName, $uploadFile, $NoPlate, $OwnerName, $OwnerAddress, $PhoneNumberOwner);

        if ($stmt->execute()) {
            // Display the file name in the HTML
            echo "Uploaded file: " . htmlspecialchars(basename($vehicleGrant['name']));

            // Redirect with userID
            header("Location: StudentVehicleList.php?userID=" . urlencode($userID));
            exit;
        } else {
            $error = "Error executing statement: " . $stmt->error;
            header("Location: StudentVehicleList.php?error=" . urlencode($error));
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
