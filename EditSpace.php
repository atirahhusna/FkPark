<?php
session_start();
include("dbase.php");

$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';

if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['SpaceID'])) {
    $SpaceID = $_GET['SpaceID'];

    // Retrieve existing data for the space
    $query = "SELECT SpaceID, Location, Status, AreaID FROM parking_space WHERE SpaceID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $SpaceID);
    $stmt->execute();
    $result = $stmt->get_result();
    $space = $result->fetch_assoc();

    if (!$space) {
        die("Space not found.");
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
    <title>Edit Parking Space</title>
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

        input[type="text"] {
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
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#">FK park</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#profileDropdown">
                    <i class="lni lni-profile"></i>
                    <span>Profile</span>
                </a>
                <ul class="sidebar-dropdown collapse" id="profileDropdown">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-profile"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="lni lni-graduation"></i>
                            <span>Student Account</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="http://localhost/FkPark/VehicleRegisterForm.php" class="sidebar-link">
                    <i class="lni lni-car"></i>
                    <span>Vehicle Registration</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="StudentVehicleList.php?userID=<?php echo urlencode($userID); ?>" class="sidebar-link">
                    <i class="lni lni-car"></i>
                    <span>Vehicle List</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-warning"></i>
                    <span>New Summon</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-license"></i>
                    <span>Demerit Management</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-parking"></i>
                    <span>Park Availability</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-calendar"></i>
                    <span>Daily Report</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main">
        <div class="container">
            <h2>Edit Parking Space</h2>
            <form action="UpdateSpace.php" method="POST">
                <input type="hidden" name="SpaceID" value="<?php echo $space['SpaceID']; ?>">
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo $space['Location']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" value="<?php echo $space['Status']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="areaID">Area ID:</label>
                    <input type="text" id="areaID" name="areaID" value="<?php echo $space['AreaID']; ?>" required>
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
