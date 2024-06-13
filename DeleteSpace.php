<?php
session_start();
include("dbase.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['SpaceID'])) {
    $spaceID = $_GET['SpaceID'];

    // Delete the space from the database
    $query = "DELETE FROM parking_space WHERE SpaceID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $SpaceID);
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Space deleted successfully.";
    } else {
        echo "Failed to delete space.";
    }

    $stmt->close();
} else {
    die("Invalid request.");
}

$conn->close();
?>
