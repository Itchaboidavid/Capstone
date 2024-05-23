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
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="user_table.php">User Table</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $user = "SELECT * FROM `user` WHERE id = $id";
                            $userResult = $conn->query($user);
                            $userRow = $userResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" id="username" placeholder="username" class="form-control bg-body-tertiary" value="<?php echo $userRow["username"] ?>" required />
                                <label for="username">Username</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a username.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" value="<?php echo $userRow["password"] ?>" required />
                                <label for="password">Password</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a password.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $userRow["name"] ?>" required />
                                <label for="name">Name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a name.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="user_type" id="user_type" required>
                                    <option value="System administrator" <?php echo ($userRow['user_type'] == 'System administrator') ? "selected" : ""; ?>>System Administrator</option>
                                    <option value="Adviser" <?php echo ($userRow['user_type'] == 'Adviser') ? "selected" : ""; ?>>Class Adviser</option>
                                    <option value="Clinic teacher" <?php echo ($userRow['user_type'] == 'Clinic teacher') ? "selected" : ""; ?>>Clinic teacher</option>
                                    <option value="Registrar" <?php echo ($userRow['user_type'] == 'Registrar') ? "selected" : ""; ?>>Registrar</option>
                                </select>
                                <label for="user_type">User type</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select type of user.</div>
                            </div>
                            <div class="form-floating mb-3" id="sectionDropdown" style="display: none;">
                                <select class="form-select bg-body-tertiary" name="section" id="section">
                                    <option value="" selected>Section</option>
                                </select>
                                <label for="section">Section</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a section.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="status" id="status" required>
                                    <option value="Active" class="text-success" <?php echo ($userRow['status'] == 'Active') ? "selected" : ""; ?>>Active</option>
                                    <option value="Disabled" class="text-danger" <?php echo ($userRow['status'] == 'Disabled') ? "selected" : ""; ?>>Disabled</option>
                                </select>
                                <label for="status">Status</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the status.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_user">Save</button>
                                <a href="user_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('user_type').addEventListener('change', function() {
            var sectionDropdown = document.getElementById('sectionDropdown');
            var selectedUserType = this.value;

            // Show or hide section dropdown based on user type
            if (selectedUserType === 'Clinic teacher') {
                sectionDropdown.style.display = 'block';
                updateSectionOptions(selectedUserType);
            } else {
                sectionDropdown.style.display = 'none';
            }
        });

        function updateSectionOptions(userType) {
            var sectionDropdown = document.getElementById('section');

            // Fetch sections based on user type using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update section options based on the response
                    sectionDropdown.innerHTML = xhr.responseText;
                }
            };

            // Adjust the URL based on your actual file structure
            var url = 'get_sections.php?user_type=' + encodeURIComponent(userType);
            xhr.open('GET', url, true);
            xhr.send();
        }
    </script>
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
//EDIT USER
if (isset($_POST['edit_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $check = "SELECT * FROM `user` WHERE id = '$id'";
    $checkResult = $conn->query($check);
    $checkRow = $checkResult->fetch_assoc();
    if ($_POST["password"] == $checkRow["password"]) {
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
$conn->close();
