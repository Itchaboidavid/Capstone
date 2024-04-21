<?php
include("../config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Change password</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script defer src="../index.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Account</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="account.php">Account</a> </li>
                            <li class="breadcrumb-item active">Change password</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <?php
                    $id = $_GET["id"];
                    $faculty = "SELECT * FROM `user` WHERE id = $id";
                    $facultyResult = $conn->query($faculty);
                    $facultyRow = $facultyResult->fetch_assoc();
                    ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="text-capitalize">Change password</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="password" name="current_password" id="current_password" placeholder="current_password" class="form-control bg-body-tertiary" required />
                                <label for="current_password">Current password</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter your current password.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" required minlength="8" />
                                <label for="password"> New password</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a new password.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm_password" class="form-control bg-body-tertiary" required minlength="8" />
                                <label for="confirm_password"> Confirm password</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please cofirm your password.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="change_pass">Save</button>
                                <a href="account.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php
// Function to validate password
function is_valid_password($password)
{
    // Minimum length of 8 characters
    if (strlen($password) < 8) {
        return false;
    }

    // At least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // At least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // At least one special character (you can customize this set as needed)
    if (!preg_match('/[!@#$%^&*()_+=\-{}[\]:\"|;\',.?\/]/', $password)) {
        return false;
    }

    return true;
}

// CHANGE PASSWORD
if (isset($_POST['change_pass'])) {
    $current_password = md5($_POST["current_password"]);
    $password = md5($_POST["password"]);
    $password2 = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Add password validation
    if (!is_valid_password($password2)) {
        echo ("<script>location.href = 'account.php?errmsg=Password must be at least 8 characters long and contain uppercase, lowercase, and special characters!';</script>");
        exit();
    }

    $user = "SELECT * FROM `user` WHERE `id` = $id";
    $userResult = $conn->query($user);
    $userRow = $userResult->fetch_assoc();

    if ($current_password == $userRow["password"]) {
        if ($confirm_password == $password2) {
            $update = "UPDATE `user` SET `password`='$password', `password2`='$password2' WHERE id = $id";
            $result = mysqli_query($conn, $update);
            echo ("<script>location.href = 'account.php?msg=Password updated successfully!';</script>");
            exit();
        } else {
            echo ("<script>location.href = 'account.php?errmsg=Confirm password does not match!';</script>");
            exit();
        }
    } else {
        echo ("<script>location.href = 'account.php?errmsg=Current password does not match!';</script>");
        exit();
    }
}
