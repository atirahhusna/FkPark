<?php
session_start(); // Start the session

include("dbase.php");

$idURL = $_GET['userID'];

// First, delete associated records in the 'register_vehicle' table
$query_delete_vehicles = "DELETE FROM register_vehicle WHERE UserID = '$idURL'";
$result_delete_vehicles = mysqli_query($conn, $query_delete_vehicles);

// If deletion from 'register_vehicle' table was successful or there were no associated records
if ($result_delete_vehicles || mysqli_affected_rows($conn) === 0) {
    // Now, delete associated records in the 'dmerit_point' table
    $query_delete_merit_points = "DELETE FROM dmerit_point WHERE StudentID = '$idURL'";
    $result_delete_merit_points = mysqli_query($conn, $query_delete_merit_points);

    // Then, delete associated records in the 'student' table
    $query_delete_student = "DELETE FROM student WHERE userID = '$idURL'";
    $result_delete_student = mysqli_query($conn, $query_delete_student);

    // Finally, delete the record in the 'user_profile' table
    $query_delete_profile = "DELETE FROM user_profile WHERE userID = '$idURL'";
    $result_delete_profile = mysqli_query($conn, $query_delete_profile);

    // Check if all deletions were successful
    if ($result_delete_merit_points && $result_delete_student && $result_delete_profile) {
        $_SESSION['success_message'] = "Deletion successful.";
        header("Location: studentView.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Error deleting records.";
        header("Location: studentView.php");
        exit;
    }
} else {
    $_SESSION['error_message'] = "Error deleting associated records in the 'register_vehicle' table.";
    header("Location: studentView.php");
    exit;
}
?>
