<?php
include("config.php");
session_start();

if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = md5($_POST["password"]);

  $select_user = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
  $result_user = mysqli_query($conn, $select_user);
  if (mysqli_num_rows($result_user) > 0) {
    $row_login = mysqli_fetch_assoc($result_user);
    if ($row_login["status"] == "Active") {
      $_SESSION['user_logged_in'] = true;
      if ($row_login["user_type"] == "system admin") {
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        header("location: system admin/dashboard.php");
      } elseif ($row_login["user_type"] == "Adviser") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["username"] = $row_login["username"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        $_SESSION["section"] = $row_login["section"];
        $_SESSION["password"] = $row_login["password2"];
        header("location: adviser/dashboard.php");
      } elseif ($row_login["user_type"] == "Registrar") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        header("location:registrar/dashboard.php");
      } elseif ($row_login["user_type"] == "Clinic teacher") {
        $_SESSION["id"] = $row_login["id"];
        $_SESSION["name"] = $row_login["name"];
        $_SESSION["user_type"] = $row_login["user_type"];
        $_SESSION["section"] = $row_login["section"];
        header("location:clinic teacher/dashboard.php");
      }
    } else {
      header("location:index.php?errmsg=Your account is disabled.");
      header("Cache-Control: no-cache, no-store, must-revalidate");
      header("Pragma: no-cache");
      header("Expires: 0");
    }
  } else {
    echo '<script>alert("Wrong username/password");</script>';
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
  }
}

if (isset($_SESSION['user_logged_in'])) {
  if ($_SESSION['user_type'] == 'system admin') {
    header("location:system admin/dashboard.php");
  } elseif ($_SESSION['user_type'] == 'Adviser') {
    header("location: adviser/dashboard.php");
  } elseif ($_SESSION['user_type'] == 'Registrar') {
    header("location: registrar/dashboard.php");
  } elseif ($_SESSION['user_type'] == 'Clinic teacher') {
    header("location: clinic teacher/dashboard.php");
  }
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <title>LOGIN</title>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    * {
      font-family: "Poppins", sans-serif;
    }

    #loginBtn {
      background-color: #001233;
      color: #fff;
    }

    #loginBtn:hover {
      background-color: #fff;
      color: #001233;
      transform: scale(1.2);
      transition: .8s;
    }

    #form {
      text-align: center;
      width: 50%;
      height: 500px;
      box-shadow: 1px 1px 3px blue;
    }

    #info {
      display: grid;
      place-items: center;
      background-image: url(images/gg.jpg);
      background-size: cover;
    }
  </style>
</head>

<body class="min-vh-100 container-fluid" style="display: grid; place-items: center;">
  <!-- LOGIN FORM -->
  <div id="form" class="row">
    <div class="col" id="info">
      <img src="images/finallogo-removebg-preview.png" alt="TC LOGO" style="width: 200px; height: 200px; border-radius: 100px;">
    </div>
    <div style="display: flex; justify-content: center; align-items: center; border-radius: 10px; position: relative;" class="bg-white col">
      <?php
      if (isset($_GET['errmsg'])) {
        $errmsg = $_GET['errmsg'];
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
          . $errmsg .
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
      }
      ?>
      <form action="" method="POST" class="needs-validation" novalidate>
        <h3 class="text-shadow: 1px 2px 3px blue; fw-bold" style="letter-spacing: 1.5px;">LOGIN</h3>
        <div class="mb-3 form-floating">
          <input type="text" name="username" id="username" class="form-control bg-body-tertiary" placeholder="Username" required style="box-shadow: 0px 1px 2px blue;" />
          <label for=" username" class="form-label"><i class="bi bi-person-fill me-2"></i>Username</label>
          <div class="valid-feedback bg-body-tertiary">Great!</div>
          <div class="invalid-feedback bg-body-tertiary"> Please enter a username.</div>
        </div>
        <div class="mb-3 form-floating input-container" style="position: relative;">
          <input type="password" name="password" id="password" class="form-control bg-body-tertiary" placeholder="Password" required style="padding-right: 30px; box-shadow: 0px 1px 2px blue;" />
          <label for="password" class="form-label"><i class="bi bi-lock-fill me-2"></i>Password</label>
          <div class="valid-feedback bg-light">Great!</div>
          <div class="invalid-feedback bg-light"> Please enter a password.</div>
          <button type="button" class="btn" onclick="togglePasswordVisibility()" style="position: absolute; top: 0; right: 0; height: 100%;  border: none; background-color: transparent; cursor: pointer; outline: none;"><i class="bi bi-eye"></i></button>
        </div>
        <div class="d-flex">
          <input type="submit" class="btn" value="Login" name="login" id="loginBtn" />
        </div>
        <div style="text-align: start; position:absolute; bottom:10px; left:30px;">
          <a href="https://www.facebook.com/DepEdTayoTCNHS301216" target="_blank" style="text-decoration: none;">
            <i class="fa-brands fa-facebook" style="width: 10px; height: 10px;"></i>
          </a>
          <span style="font-size: xx-small;"> Come and visit our facebook page!</span>
        </div>
      </form>
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
$conn->close();
?>
<script>
  // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
  const url = new URL(window.location.href);
  url.searchParams.delete('msg');
  url.searchParams.delete('errmsg');
  window.history.replaceState({}, document.title, url);
</script>