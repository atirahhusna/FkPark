
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <title>Signup</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Section: Design Block -->
<style>
  #background {
    background-image: url('FK4.png'); /* Specify the path to your image */
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
            
              <form action="process_registration.php" method="POST">
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="userID" name="userID" required>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                </div>
                <div class="form-group">
                  <label for="role">Role:</label>
                  <select class="form-control" id="userRole" name="userRole" required>
                    <option value="Administrator">Administrator</option>
                    <option value="staff">staff</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
              <div class="text-center"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
