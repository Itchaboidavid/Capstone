<?php
include("config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="index.css">
  <title>LOGIN</title>
</head>

<body class="min-vh-100 pt-5 me-3" id="loginBg">
  <div class="container">
    <div class="row_login d-flex justify-content-center">
      <div class="col-7 text-center p-1 rounded-4 mt-5 me-3 rounded-end-0" style="height: 500px;">
        <img src="images/logowbg.png" alt="LOGO" style="height:130px; width: 130px; border-radius: 100px;" class="mb-2 mt-3">
        <h2 class="text-light fs-2 fw-bold" style="text-shadow: 3px 3px 5px black;">DEVELOPMENT OF WEB-BASED <br> SCHOOL FORM MANAGEMENT SYSTEM FOR TAGAYTAY CITY NATIONAL <br> HIGH SCHOOL - INTEGRATED SENIOR HIGH SCHOOL</h2>
        <!-- <p class="text-light" style="font-size: 10px;"> &#169; Copyrights. All rights reserved 2023.</p> -->
      </div>

      <div class="col-3 text-center px-4 py-5 mt-5 mb-5 rounded-4 bg-body-secondary" style="box-shadow: 3px 5px 20px black;">
        <h2 class="mt-5 fw-bold text-shadow: 2px 2px 3px black;">LOGIN</h2>
        <?php
        if (isset($_GET['errmsg'])) {
          $errmsg = $_GET['errmsg'];
          echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
            . $errmsg .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
        }
        ?>
        <form action="index.php" method="POST" class="needs-validation" novalidate>
          <div class="mb-4 form-floating mt-3">
            <input type="text" name="username" id="username" class="form-control bg-body-tertiary" placeholder="Username" required />
            <label for="username" class="form-label"><i class="bi bi-person-fill me-2"></i>Username</label>
            <div class="valid-feedback bg-body-tertiary">Great!</div>
            <div class="invalid-feedback bg-body-tertiary"> Please enter a username.</div>
          </div>
          <div class="mb-4 form-floating input-container" style="position: relative;">
            <input type="password" name="password" id="password" class="form-control bg-body-tertiary" placeholder="Password" required style="padding-right: 30px;" />
            <label for="password" class="form-label"><i class="bi bi-lock-fill me-2"></i>Password</label>
            <div class="valid-feedback bg-light">Great!</div>
            <div class="invalid-feedback bg-light"> Please enter a password.</div>
            <button type="button" class="btn" onclick="togglePasswordVisibility()" style="position: absolute; top: 0; right: 0; height: 100%;  border: none; background-color: transparent; cursor: pointer; outline: none;"><i class="bi bi-eye"></i></button>
          </div>
          <div class="d-flex">
            <input type="submit" class="btn text-light" style="background-color: #023047;" value="Login" name="login" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
  <script>
    function togglePasswordVisibility() {
      const passwordField = document.getElementById('password');
      const button = document.querySelector('button[onclick="togglePasswordVisibility()"]');

      if (passwordField.getAttribute('type') === "password") {
        passwordField.setAttribute('type', 'text');
        button.innerHTML = '<i class="bi bi-eye-slash"></i>';
      } else {
        passwordField.setAttribute('type', 'password');
        button.innerHTML = '<i class="bi bi-eye"></i>';
      }
    }
  </script>
</body>

</html>

<?php
if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = md5($_POST["password"]);

  $select_user = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
  $result_user = mysqli_query($conn, $select_user);
  if (mysqli_num_rows($result_user) > 0) {
    $row_login = mysqli_fetch_array($result_user);
    if ($row_login["status"] == "active") {
      if ($row_login["user_type"] == "system admin") {
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
      } elseif ($row_login["user_type"] == "adviser") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        $_SESSION["section"] = $row_login["section"];
      } elseif ($row_login["user_type"] == "registrar") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["fname"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
      } elseif ($row_login["user_type"] == "clinic teacher") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        $_SESSION["section"] = $row_login["section"];
      }
    } elseif ($row_login["status"] == "disabled") {
      header("location:index.php?errmsg=Your account is disabled.");
    }
  } else {
    echo '<script>alert("Wrong username/password");</script>';
  }
}

if (isset($_SESSION["user_type"])) {
  header("location:" . $_SESSION["user_type"]  . "/dashboard.php");
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$conn->close();
?>