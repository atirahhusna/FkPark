<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and stylesheets -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View student account List</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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

        .success-message {
            background-color: #d4edda; /* Green color */
            color: #155724; /* Dark green color */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb; /* Light green border */
            border-radius: 5px;
        }

        /* Error message style */
        .error-message {
            background-color: #f8d7da; /* Red color */
            color: #721c24; /* Dark red color */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb; /* Light red border */
            border-radius: 5px;
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


        ul.navigation{ 
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #fffff;
        }
        
        li.navigation {
        float:left;
        }
        
        li a.navigation {
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        }
        
        li a:hover{
          text-decoration: underline;
          color: #054bb4;
          
        }

        li.button button {
        background-color: #054BB4;
        border:none;
        color: white;
        margin-top:15px;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        font-weight: bold;
        }

        li.button.button1 button{border-radius:20px;}

        li.button.button1 button:hover {
        background-color: black; /* change background color on hover */
        text:white;
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

        .column{
          padding-right:100px;
        }

        input[type=submit], input[type=reset], input[type=save]{
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



    #footer{
      background-color: #ffffff;
      text-align:justify;
      padding-top:10px;
    }

    hr{
      border: 2px solid black;
      width:1100px;
      margin-left: auto; 
      margin-right: auto;
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

        #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
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
                    <a href="http://localhost/FkPark/AdminVehicleList.php" class="sidebar-link">
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

            <!-- Sidebar footer -->
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

            <div class="container">
                <h2>Registration Information</h2>
                <?php
                include("dbase.php");

                // Check if the success message session variable is set
// Check if the success message session variable is set
if (isset($_SESSION['success_message'])) {
    echo "<div id='success-message' class='success-message'>" . $_SESSION['success_message'] . "</div>";
    // Unset or destroy the session variable after displaying the message
    unset($_SESSION['success_message']);
}


// Check if the error message session variable is set
if (isset($_SESSION['error_message'])) {
    echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
    // Unset or destroy the session variable after displaying the message
    unset($_SESSION['error_message']);
}


                $query = "SELECT * FROM user_profile";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>Number</th><th>User ID</th><th>Password</th><th>Role</th><th>Action</th></tr></thead>';
                    echo '<tbody>';
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $counter . '</td>';
                        echo '<td>' . htmlspecialchars($row["userID"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["userPassword"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["userRole"]) . '</td>';
                        echo '<td>';
                        echo '<a href="editStudent.php?userID=' . $row["userID"] . '" class="btn btn-primary">Edit</a> ';
                        echo '<a href="deleteStudent.php?userID=' . $row["userID"] . '" class="btn btn-danger">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                        $counter++;
                    }
                    echo '</tbody></table>';
                } else {
                    echo "<p>No results found.</p>";
                }
                ?>

            </div>
            <hr>
            <div id="footer">
                <p>Copyright &copy; 2024 FAKULTI KOMPUTER Corporation. All Rights Reserved.</p>
            </div>
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
    
    // Function to hide the success message after 5 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000); // 5 seconds (5000 milliseconds)
</script>

</body>
</html>
