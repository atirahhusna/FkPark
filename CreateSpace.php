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


        $userID = $_SESSION['userID']; 

        $query = "INSERT INTO parking_space (SpaceID, Location, Status, AreaID) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $SpaceID, $Location, $Status, $AreaID);

        if ($stmt->execute()) {
            // Redirect with userID
            header("Location: ViewSpace.php?userID=" . urlencode($userID));
            exit;
        } else {
            $error = "Error: " . $stmt->error;
            header("Location: ViewSpace.php?error=" . urlencode($error));
            exit;
        }

        $stmt->close();
    } else {
        $error = "Possible file upload attack!";
        header("Location: ViewSpace.php?error=" . urlencode($error));
        exit;
    }

    $conn->close();

?>