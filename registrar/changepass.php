<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/fb9a379660.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index.css">
    <script src="../index.js"></script>
    <title>CHANGE PASSWORD</title>
</head>

<body id="up">
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-3 px-5">
                <!-- <div class="card text-center">
                        <div class="card-header bg-primary">
                            <span class="text-light fw-bold" style="font-size: 40px; text-shadow: 1px 1px 3px black; letter-spacing: 1.5px;">Profile</span>
                        </div>
                        <div class="card-body row g-0">
                            <form action="">

                            </form>
                        </div>
                        <div class="card-footer bg-primary">
                        </div>
                    </div> -->

                <main class="py-4 px-3 pb-0">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            <h2>Change Password</h2>
                        </div>
                        <?php
                        $id = $_GET["id"];
                        $select = "SELECT * FROM `user` WHERE id = $id";
                        $result = mysqli_query($conn, $select);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="card-body">
                            <form action="#" method="POST" class="needs-validation" novalidate>
                                <div class="form-floating mb-3">
                                    <input type="password" name="current_password" id="current_password" placeholder="current_password" class="form-control bg-body-tertiary" required />
                                    <label for="current_password">Current password</label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please enter your current password.</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" required />
                                    <label for="password"> New password</label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please enter a new password.</div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm_password" class="form-control bg-body-tertiary" required />
                                    <label for="confirm_password"> Confirm password</label>
                                    <div class="valid-feedback ps-1">Great!</div>
                                    <div class="invalid-feedback ps-1"> Please cofirm your password.</div>
                                </div>
                                <div class="mt-4 me-auto">
                                    <input type="submit" value="Update" class="btn btn-primary" name="submit">
                                    <a href="profile.php" class="btn btn-danger">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </main>
        </div>
    </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $current_password = md5($_POST["current_password"]);
    $password = md5($_POST["password"]);
    $password2 = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $select2 = "SELECT * FROM `user` WHERE `id` = $id";
    $result2 = mysqli_query($conn, $select2);
    $row2 = mysqli_fetch_assoc($result2);

    if ($current_password == $row["password"]) {
        if ($confirm_password == $password2) {
            $update = "UPDATE `user` SET `password`='$password', `password2`='$password2' WHERE id = $id";
            $result = mysqli_query($conn, $update);
            echo ("<script>location.href = 'profile.php?msg=Password updated successfully!';</script>");
            exit();
        } else {
            echo ("<script>location.href = 'profile.php?errmsg=Password does not match!';</script>");
            exit();
        }
    } else {
        echo ("<script>location.href = 'profile.php?errmsg=Current password does not match!';</script>");
        exit();
    }
}
?>