<?php
session_start(); // Start the session
include("dbase.php");

function validateUser($conn, $userID, $userPassword, $userRole) {
    // Sanitize and validate input data
    $userID = mysqli_real_escape_string($conn, $userID);
    $userPassword = mysqli_real_escape_string($conn, $userPassword);
    $userRole = mysqli_real_escape_string($conn, $userRole);

    // Fetch userID from user_profile based on username, password, and category
    $query = "SELECT userID FROM user_profile WHERE userID='$userID' AND userPassword='$userPassword' AND userRole='$userRole'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['userID'];
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $userID = $_POST['userID'];
    $userPassword = $_POST['userPassword'];
    $userRole = $_POST['userRole'];

    // Validate user credentials
    $userID = validateUser($conn, $userID, $userPassword, $userRole);

    if ($userID) {
        $_SESSION['userID'] = $userID; // Store userID in session

        // Redirect based on category
        if ($userRole == "Administrator") {
            header("Location: AdministratorPage.php");
            exit();
        } elseif ($userRole == "staff") {
            header("Location: staff.php");
            exit();
        } elseif ($userRole == "student") {
            header("Location: student.php");
            exit();
        } else {
            echo "<div class='text-center text-danger'>Please select a valid category.</div>";
        }
    } else {
        echo "<div class='text-center text-danger'>Invalid username, password, or category.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <title>Login</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Section: Design Block -->
<style>
  #background {
    background-image: url('login.png'); /* Specify the path to your image */
    background-size: cover; /* Ensure the image covers the entire element */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Prevent the image from repeating */
    height: 100vh; /* Full height */
    width: 100vw; /* Full width */
  }

  #button-forgotPassword {
    color: #ffffff;
  }

  .bg-glass {
    background-color: rgba(255, 255, 255, 0.9) !important;
    backdrop-filter: saturate(200%) blur(25px);
    background-size: cover;
  }
</style>

<div id="background">
  <form method="post" action="">
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10"></div>
        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <div class="row">
                <div class="text-center">
                  <h1>Welcome to Fk Park!</h1>
                  <br><br>
                </div>
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="form3Example3" name="userID" class="form-control" required />
                <label class="form-label" for="form3Example3">Username</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form3Example4" name="userPassword" class="form-control" required />
                <label class="form-label" for="form3Example4">Password</label>
              </div>
              <div class="form-outline mb-4">
                <select class="form-select" name="userRole" aria-label="Default select example" required>
                  <option value="" disabled selected>Select your category</option>
                  <option value="Administrator">Administrator</option>
                  <option value="student">Students</option>
                  <option value="staff">Staff</option>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Login</button>
                <a href="http://localhost/FkPark/signup.php" class="btn btn-primary btn-block mb-4">SignUp</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

</body>
</html>
