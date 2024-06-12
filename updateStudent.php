<?php
session_start(); // Start the session

include("dbase.php");

extract($_POST);

// Get the current date and time
$tarikh = date("d-m-Y", time());
$masa = date("H:i:s", time());

$query = "UPDATE user_profile SET userID = '$userID', userPassword = '$userPassword', userRole = '$userRole' WHERE userID = '$userID'";

$result = mysqli_query($conn, $query) or die ("Could not execute query in ubah.php");

if($result) {
    $_SESSION['success_message'] = "Update successful.";
    header("Location: studentView.php");
    exit;
} else {
    $_SESSION['error_message'] = "Error updating data.";
    header("Location: studentView.php");
    exit;
}
?>
