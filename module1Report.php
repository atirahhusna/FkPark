<?php
// Include your database connection file
include("dbase.php");

// Verify the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Ensure the userID is properly passed to this script
if (!isset($_GET['userID'])) {
    die("userID is required");
}
$userID = $_GET['userID']; // Assuming userID is a string

// Initialize an array to store approved counts for each day of the month
$approvedCountsByDay = array();

// Loop through each day of the month
for ($day = 1; $day <= date('t'); $day++) {
    // Format the date
    $date = $currentYear . '-' . $currentMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);

    // Query to get the count of registered vehicles that have been approved for the current day for the given user
    $query = "SELECT COUNT(*) AS approvedCount FROM register_vehicle WHERE ApprovalStatus = 'Approved' AND userID = ? ";
    $stmt = $conn->prepare($query);

    // Check if prepare() failed
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if get_result() failed
    if ($result === false) {
        die("Error executing statement: " . $stmt->error);
    }

    // Fetch the result
    $row = $result->fetch_assoc();

    // Store the approved count for the current day
    $approvedCountsByDay[$day] = $row['approvedCount'];
}

// Calculate the total approved count for the month
$totalApprovedCount = array_sum($approvedCountsByDay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Approval Report</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        h1 {
            font-weight: 600;
            font-size: 1.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('FK4.png'); /* Add your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
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
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
            background-color: #2B7A78;
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

        #footer{
            background-color: #ffffff;
            text-align:justify;
            padding-top:10px;
        }

        .sidebar-nav {
            padding: 2rem 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            margin-right: .75rem;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #3b7ddd;
        }

        ul.navigation { 
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #fffff;
        }

        li.navigation {
            float: left;
        }

        li a.navigation {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            text-decoration: underline;
            color: #054bb4;
        }

        li.button button {
            background-color: #054BB4;
            border: none;
            color: white;
            margin-top: 15px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            font-weight: bold;
        }

        li.button.button1 button {
            border-radius: 20px;
        }

        li.button.button1 button:hover {
            background-color: black; /* Change background color on hover */
            color: white;
        }
                /* Basic styling for the dashboard */
          /* Updated styling for the dashboard */
          .dashboard {
    
    top: 100px; /* Adjust top spacing as needed */
    left: 10px; /* Adjust left spacing as needed */
    width: 300px; /* Adjust width as needed */
    height: 200px; /* Adjust height as needed */
    font-family: Arial, sans-serif;
    z-index: 1000; /* Ensure the dashboard appears above other elements */
}

.card {
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
    background-color: #f9f9f9;
}

.card h2 {
    margin: 0;
    font-size: 2em;
    color: #333;
}

.card p {
    margin: 5px 0 0;
    color: #666;
}


        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        textarea {
            width: 300px;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }

        .column {
            padding-right: 100px;
        }

        input[type=submit], input[type=reset], input[type=save] {
            border-style: double;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            background-color: #007BFF;
            margin-top: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container button {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color:  #2B7A78;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: black;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 70px;
            background-color: #0e2238;
            padding: 0;
            min-width: 15rem;
            display: none;
        }

        #sidebar:not(.expand) .sidebar-item:hover .has-dropdown + .sidebar-dropdown {
            display: block;
            max-height: 15em;
            width: 100%;
            opacity: 1;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }
    </style>
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
                    <a href="http://localhost/FkPark/studView.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="http://localhost/FkPark/module1Report.php" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Dashboard</span>
                    </a>
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
                        <i class="lni lni-checkmark-circle"></i>
                        <span>My Summon</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-list"></i>
                        <span>My Demerit & Status</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-bookmark"></i>
                        <span>Booking Parking</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-license"></i>
                        <span>Park Availability</span>
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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                           <!-- FK image placeholder -->
                        </a>
                    </div>
                </nav>
                <a class="navbar-brand" style="font-size:30px;" href="#">Welcome To FK park!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <!-- Navigation items here -->
                    </ul>
                </div>
            </nav>
    <h1>Vehicle Approval Report</h1>
    <!-- Add a canvas element for the chart -->
    <canvas id="approvalChart" width="400" height="200"></canvas>

    <script>
        // PHP variables containing the approved counts by day and total for the month
        var approvedCountsByDay = <?php echo json_encode(array_values($approvedCountsByDay)); ?>;
        var totalApprovedCount = <?php echo $totalApprovedCount; ?>;

        // Get the canvas element
        var ctx = document.getElementById('approvalChart').getContext('2d');

        // Create the chart
        var approvalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(range(1, date('t'))); ?>,
                datasets: [{
                    label: 'Approved Vehicles',
                    data: approvedCountsByDay,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Vehicle Approval Report for <?php echo date('F Y'); ?>'
                }
            }
        });
    </script>
    <table class="center" style="margin: 0 auto;">
                <tr>
                    <td class="column" style="text-align: center;">
                    </td>
                    <td style="width: 800px; text-align: justify;">
                        <!-- Additional content here -->
                    </td>
                </tr>
            </table>
            <hr>
            <p style="text-align:center;">Copyright &copy; 2024 FAKULTI KOMPUTER Corporation. All Rights Reserved.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
    
</body>
</html>
