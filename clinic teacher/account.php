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
    <title>Account</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="../index.js"></script>
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
                            <li class="breadcrumb-item active">Account</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
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
                    <?php
                    $faculty = $_SESSION['name'];
                    $facultyAccount = "SELECT * FROM `user` WHERE `name` = '$faculty'";
                    $facultyResult = $conn->query($facultyAccount);
                    $facultyRow = $facultyResult->fetch_assoc();
                    ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="text-capitalize"><?php echo $facultyRow['name'] ?></h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                </thead>
                                <tbody class="table-body">
                                    <tr>
                                        <td>Username:</td>
                                        <td><?php echo $facultyRow['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Password:</td>
                                        <td>
                                            <input type="password" name="accPassword" id="accPassword" value="<?php echo $facultyRow['password2'] ?>" style="border: none; padding-right: 30px;" disabled>
                                            <!-- TOGGLE -->
                                            <button type="button" class="btn" onclick="togglePasswordVisibility()" style="height: 100%;  border: none; background-color: transparent; cursor: pointer; outline: none;">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <a href="changepass.php?id=<?php echo $facultyRow['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Name:</td>
                                        <td><?php echo $facultyRow['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>User type:</td>
                                        <td><?php echo $facultyRow['user_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <?php
                                        if ($facultyRow['status'] === "active") {
                                            echo '<td class="text-success">' . $facultyRow['status'] . '</td>';
                                        } else {
                                            echo '<td class="text-danger">' . $facultyRow['status'] . '</td>';
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </form>
            </div>
        </main>
        <script>
            function togglePasswordVisibility() {
                const passwordField = document.getElementById('accPassword');
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
//EDIT STRAND
if (isset($_POST['edit_strand'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track = mysqli_real_escape_string($conn, $_POST["track"]);

    $update = "UPDATE `strand` SET `name`='$name', `track`='$track' WHERE id = $id";
    $updateResult = mysqli_query($conn, $update);
    echo ("<script>location.href = 'strand_table.php?msg=Strand updated successfully!';</script>");
    exit();
}