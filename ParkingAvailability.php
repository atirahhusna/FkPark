<?php
session_start();
include("dbase.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$query = "SELECT AvailabilityID, Date, TotalSpace, AreaID FROM parking_availability";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Availability</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Parking Availability</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Availability ID</th><th>Date</th><th>Total Space</th><th>Area ID</th></tr></thead>';
            echo '<tbody>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["AvailabilityID"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Date"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["TotalSpace"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["AreaID"]) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "<p>No parking availability data found.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
</body>
</html>