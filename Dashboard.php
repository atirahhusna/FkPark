<?php
session_start();
include("dbase.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the data from the Dashboard table
$query = "SELECT DashboardID, TotalDamage FROM Dashboard";
$result = mysqli_query($conn, $query);

// Prepare data for the chart
$dashboardIDs = [];
$totalDamages = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dashboardIDs[] = $row['DashboardID'];
    $totalDamages[] = $row['TotalDamage'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }
        .wrapper {
            display: flex;
        }
        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all 0.25s ease-in-out;
            background-color: #7B3F00;
            display: flex;
            flex-direction: column;
        }
        #sidebar.expand {
            width: 260px;
            min-width: 260px;
        }
        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem 1.5rem;
        }
        .toggle-btn i {
            font-size: 1.5rem;
            color: #FFF;
        }
        .sidebar-logo {
            margin: auto 0;
        }
        .sidebar-logo a {
            color: #FFF;
            font-size: 1.15rem;
            font-weight: 600;
        }
        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }
        .sidebar-nav {
            padding: 2rem 0;
            flex: 1 1 auto;
        }
        a.sidebar-link {
            padding: 0.625rem 1.625rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
        }
        .sidebar-link i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
        }
        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.075);
            border-left: 3px solid #3b7ddd;
        }
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
        }
        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
 <div class="wrapper">
        <aside id="sidebar">
            <!-- Sidebar header -->
            <div class="d-flex">
                <!-- Toggle button -->
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <!-- Sidebar logo -->
                <div class="sidebar-logo">
                    <a href="#">FK park</a>
                </div>
            </div>
            <!-- Sidebar navigation -->
        <li class="sidebar-item">
            <a href="http://localhost/FkPark/AdminProfileView.php" class="sidebar-link">
                <i class="lni lni-user"></i> <!-- Icon for My Profile -->
                <span>My Profile</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="http://localhost/FkPark/Register.php" class="sidebar-link"> <!--register student-->
                <i class="lni lni-graduation"></i>
                <span>Register Student </span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="http://localhost/FkPark/studentView.php" class="sidebar-link">  <!--register list-->
                <i class="lni lni-graduation"></i>
                <span>Student Account List</span>
            </a>
        </li>
</li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-warning"></i>
                        <span>New Summon</span>
                    </a>
                </li>
                <!-- New options with dropdown -->
               
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-license"></i>
                        <span>Demerit Management</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-license"></i>
                        <span>Park Vehicle</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>Daily Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
              <a href="http://localhost/FkPark/CreateSpaceForm.php" class="sidebar-link"> <!--create space form-->
                <i class="lni lni-move"></i>
                <span>Create Space Parking </span>
            </a>
            </li>
              <li class="sidebar-item">
              <a href="http://localhost/FkPark/SpaceView.php" class="sidebar-link"> <!--view space-->
                <i class="lni lni-control-panel"></i>
                <span>View Parking Space</span>
            </a>
            </li>
            <li class="sidebar-item">
              <a href="http://localhost/FkPark/CreateAreaForm.php" class="sidebar-link"> <!--create area form-->
                <i class="lni lni-frame-expand"></i>
                <span>New Area </span>
            </a>
            </li>
             <li class="sidebar-item">
              <a href="http://localhost/FkPark/AreaView.php" class="sidebar-link"> <!--view area-->
                <i class="lni lni-domain"></i>
                <span>View Area</span>
            </a>
            </li>
             <li class="sidebar-item">
              <a href="http://localhost/FkPark/Dashboard.php" class="sidebar-link"> <!--Dashboard-->
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
            </li>
            <li class="sidebar-item">
              <a href="http://localhost/FkPark/ViewAvailability.php" class="sidebar-link"> <!--Parking Availability-->
                <i class="lni lni-slack-line"></i>
                <span>Parking Availability</span>
            </a>
            </li>

            <!-- Sidebar footer -->
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    <div class="main">
        <div class="container">
            <h2>Dashboard: Total Damaged Parking</h2>
            <canvas id="damageChart"></canvas>
        </div>
    </div>
</div>
<script>
    document.querySelector('.toggle-btn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('expand');
    });

    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('damageChart').getContext('2d');
        var damageChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: {
                labels: <?php echo json_encode($dashboardIDs); ?>,
                datasets: [{
                    label: 'Total Damage',
                    data: <?php echo json_encode($totalDamages); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>
