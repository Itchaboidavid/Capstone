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
    <title>Faculty</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
        // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        url.searchParams.delete('errmsg');
        window.history.replaceState({}, document.title, url);
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mt-0">
                    <div>
                        <h1 class="mt-4">User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">User table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-sm btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
                        Add user
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="userModalLabel">Add user</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                                            <label for="name">Name</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a name.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="username" id="username" placeholder="username" class="form-control bg-body-tertiary" required />
                                            <label for="username">Username</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a username.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" required />
                                            <label for="password">Password</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a password.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="user_type" id="user_type" required>
                                                <option value="" selected>User type</option>
                                                <option value="System administrator">System administrator</option>
                                                <option value="Adviser">Class Adviser</option>
                                                <option value="Clinic teacher">Clinic Teacher</option>
                                                <option value="Registrar">Registrar</option>
                                            </select>
                                            <label for="user_type">User type</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select type of user.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="status" id="status" required>
                                                <option value="" selected>Status</option>
                                                <option value="Active" class="text-success">Active</option>
                                                <option value="Disabled" class="text-danger">Disabled</option>
                                            </select>
                                            <label for="status">Status</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select the status.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_user">Add</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'
                        . $msg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }

                if (isset($_GET['errmsg'])) {
                    $errmsg = $_GET['errmsg'];
                    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
                        . $errmsg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        User table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>User type</th>
                                    <th>Section</th>
                                    <th>Account <br>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = "SELECT * FROM `user` ORDER BY name ASC";
                                $userResult = $conn->query($user);
                                $userCount = 1;
                                while ($userRow = $userResult->fetch_assoc()) :
                                    if ($userRow['id'] != $_SESSION['id']) :
                                ?>
                                        <tr>
                                            <td><?php echo $userCount; ?></td>
                                            <td>
                                                <div class="text-center">
                                                    <?php
                                                    if ($userRow['profile_picture'] != '') {
                                                        echo '<img src="../profile_pic/' . $userRow["profile_picture"] . '" width="100px" height="70px">';
                                                    } else {
                                                        echo '<img src="../profile_pic/default_profile.jpg" width="100px" height="70px">';
                                                    }
                                                    ?>

                                                </div>
                                            </td>
                                            <td><?php echo $userRow["name"] ?></td>
                                            <td><?php echo $userRow["user_type"] ?></td>
                                            <?php
                                            if ($userRow['user_type'] == 'Registrar') {
                                                echo '<td>Non-Teaching</td>';
                                            } elseif ($userRow['user_type'] == 'Clinic teacher') {
                                                echo '<td>Non-Advisory</td>';
                                            } elseif ($userRow['user_type'] == 'System admin') {
                                                echo '<td>System Admin</td>';
                                            } else {
                                                echo '<td>' . $userRow["section"] . '</td>';
                                            }
                                            ?>
                                            <td>
                                                <?php if ($userRow["status"] == "Active") {
                                                    echo '<span class="text-success">' . $userRow["status"] . "</span>";
                                                } elseif ($userRow["status"] == "Disabled") {
                                                    echo '<span class="text-danger">' . $userRow["status"] . "</span>";
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="edit_user.php?id=<?php echo $userRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;">
                                                    Edit <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $userCount++;
                                    endif;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="../index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
if (isset($_POST["add_user"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = md5($_POST["password"]);
    $password2 = $_POST["password"];
    $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $select = "SELECT username FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'user_table.php?errmsg=The username already exist please choose a different one!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `user`(`name`, `username`, `password`, `password2`, `user_type`,`status`) VALUES ('$name', '$username', '$password', '$password2', '$user_type','$status')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'user_table.php?msg=Account successfully registered!';</script>");
        exit();
    }
}
$conn->close();
?>