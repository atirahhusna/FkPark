<?php
session_start(); // Start the session

$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : ''; // Assigning the value of userID from session to $userID variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Space Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('FK4.png'); /* Add your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 0;
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

        /* Sidebar Styles */
        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
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

        .sidebar-link {
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

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #3b7ddd;
        }

        .navigation {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #fffff;
        }

        .navigation li {
            float: left;
        }

        .navigation li a {
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navigation li a:hover {
            text-decoration: underline;
            color: #054bb4;
        }

        .button {
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
            border-radius: 20px;
        }

        .button:hover {
            background-color: black; /* Change background color on hover */
            color: white;
        }

        /* Form Styles */
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 30px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        .actions {
            text-align: center;
        }

        .actions button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #0056b3;
        }

        /* Additional Styles */
        table.center {
            margin: 0 auto;
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

        #footer {
            background-color: #ffffff;
            text-align: justify;
            padding-top: 10px;
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
                    <a href="#http://localhost/FkPark/AdminVehicleList.php" class="sidebar-link">
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
        <!-- Main Content -->
        <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <!-- Your navbar content here -->
            </nav>

            <!-- Form Section -->
            <div class="container">
                <h2>Create Parking Space Form</h2>
                <form action="CreateSpace.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <label for="SpaceID">Space ID:</label>
                        <input type="text" id="SpaceID" name="SpaceID" required>
                    </div>
                    <div class="input-group">
                        <label for="Location">Location:</label>
                        <select id="Location" name="Location" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="Status">Status:</label>
                        <select id="Status" name="Status" required>
                            <option value="Empty">Empty</option>
                           <option value="Occupied">Occupied</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="AreaID">Area ID:</label>
                        <input type="text" id="AreaID" name="AreaID" required>
                    </div>
                    <div class="actions">
                        <button type="submit" class="button">Create</button>
                    </div>
                </form>
            </div>

            <!-- Additional Content -->
            <table class="center">
                <tr>
                    <td class="column" style="text-align: center;">
                        <img src="logoFK.png" alt="logo" width="150" height="150">
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
        // Sidebar Toggle Functionality
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>
</html>
