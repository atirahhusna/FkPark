<!--kemaskini.php-->
<!--To update data of ubah.php into database.-->
<?php
include("dbase.php");

extract($_POST);

// Get the current date and time
$tarikh = date("d-m-Y", time());
$masa = date("H:i:s", time());

$query = "UPDATE user_profile SET userID = '$userID', userPassword = '$userPassword', userRole = '$userRole' WHERE userID = '$userID'";

$result = mysqli_query($conn, $query) or die ("Could not execute query in ubah.php");
if($result) {
    echo "<script type='text/javascript'> window.location='studentView.php' </script>";
}
?>
