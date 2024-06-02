<?php

include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the current date and time
    $tarikh = date("d-m-Y", time());
    $masa = date("H:i:s", time());

    // Sanitize and validate input data
    $userID = mysqli_real_escape_string($conn, $_POST['userID']);
    $userPassword = mysqli_real_escape_string($conn, $_POST['userPassword']);
    $userRole = mysqli_real_escape_string($conn, $_POST['userRole']);

    if (empty($userID) || empty($userPassword) || empty($userRole)) {
        $error = "All fields are required.";
        header("Location: login.php?error=" . urlencode($error));
        exit;
    } else {
        // Insert data into the database
        $query = "INSERT INTO user_profile (userID, userPassword, userRole) VALUES ('$userID', '$userPassword', '$userRole')";

        if (mysqli_query($conn, $query)) {
            $success = "Registration successful.";
            header("Location: login.php?success=" . urlencode($success));
            exit;
        } else {
            $error = "Error: " . mysqli_error($conn);
            header("Location: login.php?error=" . urlencode($error));
            exit;
        }
    }
}
?>
