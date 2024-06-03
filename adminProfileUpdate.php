<!--kemaskini.php-->
<!--To update data of ubah.php into the database.-->
<?php
session_start(); // Start the session
include("dbase.php");

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $AdminID = mysqli_real_escape_string($conn, $_POST['AdminID']);
    $AdminName = mysqli_real_escape_string($conn, $_POST['AdminName']);
    $AdminPhoneNum = mysqli_real_escape_string($conn, $_POST['AdminPhoneNum']);
    $AdminEmail = mysqli_real_escape_string($conn, $_POST['AdminEmail']);
    $userID = $_SESSION['userID']; // Retrieve userID from session

    // Update existing record
    $query = "UPDATE administrator SET AdminID = ?, AdminName = ?, AdminPhoneNum = ?, AdminEmail = ? WHERE userID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $AdminID, $AdminName, $AdminPhoneNum, $AdminEmail, $userID);

    if ($stmt->execute()) {
        $success = "Profile updated successfully.";
        header("Location: AdminProfileView.php?success=" . urlencode($success));
        exit;
    } else {
        $error = "Error: " . $stmt->error;
        header("Location: AdminProfileView.php?error=" . urlencode($error));
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
