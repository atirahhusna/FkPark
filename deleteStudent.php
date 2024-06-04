<?php
include("dbase.php");

$idURL = $_GET['userID'];

// First, delete the associated records in the 'dmerit_point' table
$query1 = "DELETE FROM dmerit_point WHERE StudentID = '$idURL'";
$result1 = mysqli_query($conn, $query1) or die ("Could not execute query in deleteStudent.php");

// Then, delete the associated records in the 'student' table
$query2 = "DELETE FROM student WHERE userID = '$idURL'";
$result2 = mysqli_query($conn, $query2) or die ("Could not execute query in deleteStudent.php");

// Finally, delete the record in the 'user_profile' table
$query3 = "DELETE FROM user_profile WHERE userID = '$idURL'";
$result3 = mysqli_query($conn, $query3) or die ("Could not execute query in deleteStudent.php");

if($result1 && $result2 && $result3) {
    echo "<script type='text/javascript'> window.location='studentView.php'</script>";
}
?>
