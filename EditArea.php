<?php
session_start();
include("dbase.php");

$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['AreaID'])) {
    $AreaID = $_GET['AreaID'];

    // Retrieve existing data for the parking area
    $query = "SELECT AreaID, AreaName, Status, Reason FROM parking_area WHERE AreaID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $AreaID);
    $stmt->execute();
    $result = $stmt->get_result();
    $area = $result->fetch_assoc();

    if (!$area) {
        die("Parking area not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parking Area</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .wrapper {
            display: flex;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            background-color: #fafbfe;
            padding: 20px;
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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .button-place {
            text-align: center;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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
            <a href="http://indah.ump.edu.my/CA21083/FkPark/AdminProfileView.php" class="sidebar-link">
                <i class="lni lni-user"></i> <!-- Icon for My Profile -->
                <span>My Profile</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="http://indah.ump.edu.my/CA21083/FkPark/Register.php" class="sidebar-link"> <!--register student-->
                <i class="lni lni-graduation"></i>
                <span>Register Student </span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="http://indah.ump.edu.my/CA21083/FkPark/studentView.php" class="sidebar-link">  <!--register list-->
                <i class="lni lni-graduation"></i>
                <span>Student Account List</span>
            </a>
        </li>
</li><li class="sidebar-item">
                    <a href="http://indah.ump.edu.my/CA21083/FkPark/AdminVehicleList.php" class="sidebar-link">
                        <i class="lni lni-warning"></i>
                        <span>Registered Vehicle</span>
                    </a>
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
              <a href="http://indah.ump.edu.my/CA21083/CreateSpaceForm.php" class="sidebar-link"> <!--create space form-->
                <i class="lni lni-move"></i>
                <span>Create Space Parking </span>
            </a>
            </li>
              <li class="sidebar-item">
              <a href="http://indah.ump.edu.my/CA21083/FkPark/SpaceView.php" class="sidebar-link"> <!--view space-->
                <i class="lni lni-control-panel"></i>
                <span>View Parking Space</span>
            </a>
            </li>
            <li class="sidebar-item">
              <a href="http://indah.ump.edu.my/CA21083/FkPark/CreateAreaForm.php" class="sidebar-link"> <!--create area form-->
                <i class="lni lni-frame-expand"></i>
                <span>New Area </span>
            </a>
            </li>
             <li class="sidebar-item">
              <a href="http://indah.ump.edu.my/CA21083/FkPark/AreaView.php" class="sidebar-link"> <!--view area-->
                <i class="lni lni-domain"></i>
                <span>View Area</span>
            </a>
            </li>
             <li class="sidebar-item">
              <a href="http://indah.ump.edu.my/CA21083/FkPark/Dashboard.php" class="sidebar-link"> <!--Dashboard-->
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
            </li>
            <li class="sidebar-item">
              <a href="http://indah.ump.edu.my/CA21083/FkPark/ViewAvailability.php" class="sidebar-link"> <!--Parking Availability-->
                <i class="lni lni-slack-line"></i>
                <span>Parking Availability</span>
            </a>
            </li>

            <!-- Sidebar footer -->
            <div class="sidebar-footer">
                <a href="http://indah.ump.edu.my/CA21083/FkPark/login.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
    <div class="main">
        <div class="container">
            <h2>Edit Parking Area</h2>
            <form action="UpdateArea.php" method="POST">
                <input type="hidden" name="AreaID" value="<?php echo $area['AreaID']; ?>">
                <div class="form-group">
                    <label for="areaName">Area Name:</label>
                    <input type="text" id="areaName" name="areaName" value="<?php echo $area['AreaName']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" value="<?php echo $area['Status']; ?>" required>
                  </div>
                <div class="form-group">
                    <label for="reason">Reason:</label>
                    <input type="text" id="reason" name="reason" value="<?php echo $area['Reason']; ?>" required>
                </div>
                <div class="button-place">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1FBRjM2h7V6RZpqhqja/lz/6NA9pE8y5p6sC/XVnN0A"
        crossorigin="anonymous"></script>
<script>
    document.querySelector('.toggle-btn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('expand');
    });
</script>
</body>
</html>