<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlatinumPage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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


    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 500px;
        margin: 20px auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333333;
        margin-bottom: 30px;
    }
    form {
        display: grid;
        grid-gap: 20px;
    }
    label {
        font-weight: bold;
        color: #555555;
    }
    input[type="text"], input[type="email"], input[type="tel"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #dddddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin-top: 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
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
            <ul class="sidebar-nav">
                <!-- Existing sidebar items -->
                <li class="sidebar-item">
    <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#profileDropdown">
        <i class="lni lni-profile"></i> <!-- Icon for Profile -->
        <span>Profile</span>
    </a>
    <ul class="sidebar-dropdown collapse" id="profileDropdown">
        <li class="sidebar-item">
            <a href="http://localhost/FkPark/AdminProfile.php" class="sidebar-link">
                <i class="lni lni-user"></i> <!-- Icon for My Profile -->
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
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-car"></i>
                        <span>Vehicle Registration</span>
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
                <i class="lni lni-calendar"></i> <!-- Example of adding an icon for Park Availability -->
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
    <h1>User Profile</h1>
    <form action="adminProfileEditProcess.php" method="POST">
        <div class="mb-3">
            <label for="adminID" class="form-label">Admin ID:</label>
            <input type="text" class="form-control" id="AdminID" name="AdminID" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="AdminName" name="AdminName" required>
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" id="AdminPhoneNum" name="AdminPhoneNum" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="AdminEmail" name="AdminEmail" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
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



