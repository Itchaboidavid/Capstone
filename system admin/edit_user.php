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
    <title>EDIT USER</title>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3 pb-0">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h2>Update Adviser</h2>
                    </div>
                    <?php
                    $id = $_GET["id"];
                    $select = "SELECT * FROM user WHERE id = $id";
                    $result = mysqli_query($conn, $select);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card-body">
                        <form action="#" method="POST" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" id="username" placeholder="username" class="form-control bg-body-tertiary" value="<?php echo $row["username"] ?>" required />
                                <label for="username">Username</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a username.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" value="<?php echo $row["password"] ?>" required />
                                <label for="password">Password</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a password.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $row["name"] ?>" required />
                                <label for="name">Name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a name.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="user_type" id="user_type">
                                    <option value="adviser" <?php echo ($row['user_type'] == 'adviser') ? "selected" : ""; ?>>Adviser</option>
                                    <option value="clinic" <?php echo ($row['user_type'] == 'clinic staff') ? "selected" : ""; ?>>Clinic staff</option>
                                    <option value="human resources" <?php echo ($row['user_type'] == 'human resources') ? "selected" : ""; ?>>Human Resources</option>
                                    <option value="registrar" <?php echo ($row['user_type'] == 'registrar') ? "selected" : ""; ?>>Registrar</option>
                                </select>
                                <label for="user_type">User type</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select type of user.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="status" id="status">
                                    <option value="active" class="text-success" <?php echo ($row['status'] == 'active') ? "selected" : ""; ?>>active</option>
                                    <option value="disabled" class="text-danger" <?php echo ($row['status'] == 'disabled') ? "selected" : ""; ?>>disabled</option>
                                </select>
                                <label for="status">Status</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the status.</div>
                            </div>
                            <div class="mt-4 me-auto">
                                <input type="submit" value="Update" class="btn btn-primary" name="submit">
                                <a href="user_table.php" class="btn btn-danger">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    if ($_POST["password"] == $row["password"]) {
        $password = $_POST["password"];
    } else {
        $password = md5($_POST["password"]);
    }
    $password2 = $_POST["password"];
    $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $update = "UPDATE `user` SET `name`='$name',`username`='$username',`password`='$password',`password2`='$password2',`user_type`='$user_type',`status`='$status' WHERE id = $id";
    $result = mysqli_query($conn, $update);
    echo ("<script>location.href = 'user_table.php?msg=Record updated successfully!';</script>");
    exit();
}
?>