<!-- buang.php -->
<!-- To delete one particular data. -->

<?php
include("dbase.php");

$idURL = $_GET['userID'];

$query = "DELETE FROM user_profile WHERE userID = '$idURL'";
$result = mysqli_query($conn, $query) or die ("Could not execute query in ubah.php");

if($result) {
    echo "<script type='text/javascript'> window.location='studentView.php'</script>";
}
?>
