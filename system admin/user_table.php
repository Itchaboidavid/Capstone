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
                                                <option value="Adviser">Class Adviser</option>
                                                <option value="Clinic teacher">Clinic Teacher</option>
                                                <option value="Registrar">Registrar</option>
                                            </select>
                                            <label for="user_type">User type</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select type of user.</div>
                                        </div>
                                        <!-- <div class="form-floating mb-3" id="sectionDropdown" style="display: none;">
                                            <select class="form-select bg-body-tertiary" name="section" id="section">
                                                <option value="" selected>Section</option>
                                            </select>
                                            <label for="section">Section</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a section.</div>
                                        </div> -->
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
                        Faculty table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>User type</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = "SELECT * FROM `user` ORDER BY name ASC";
                                $userResult = $conn->query($user);
                                while ($userRow = $userResult->fetch_assoc()) :
                                    if ($userRow['name'] != "system admin") :
                                ?>
                                        <tr>
                                            <td><?php echo $userRow["name"] ?></td>
                                            <td><?php echo $userRow["user_type"] ?></td>
                                            <?php
                                            if ($userRow['user_type'] == 'Registrar') {
                                                echo '<td>Non-Teaching</td>';
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
                                                <a href="edit_user.php?id=<?php echo $userRow['id'] ?>" style="border: none; background: transparent;">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
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
    <!-- <script>
        document.getElementById('user_type').addEventListener('change', function() {
            var sectionDropdown = document.getElementById('sectionDropdown');
            var selectedUserType = this.value;

            // Show or hide section dropdown based on user type
            if (selectedUserType === 'adviser' || selectedUserType === 'clinic teacher') {
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
    </script> -->
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
    $section = mysqli_real_escape_string($conn, $_POST["section"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $select = "SELECT * FROM user WHERE username = '$username' AND `name` = '$name'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'user_table.php?errmsg=The class adviser account already exist / The class advisory is already been assigned!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `user`(`name`, `username`, `password`, `password2`, `user_type`, `section`, `status`) VALUES ('$name', '$username', '$password', '$password2', '$user_type', '$section', '$status')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'user_table.php?msg=Account successfully registered!';</script>");
        exit();
    }
}
$conn->close();
?>