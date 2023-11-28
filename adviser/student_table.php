<?php
include("../config.php");
session_start();

$faculty = $_SESSION['name'];
$section = "SELECT * FROM `user` WHERE `name` = '$faculty'";
$sectionResult = $conn->query($section);
$sectionRow = $sectionResult->fetch_assoc();
$sectionName = $sectionRow['section'];

$studentSection = "SELECT * FROM `section` WHERE `name` = '$sectionName'";
$studentSectionResult = $conn->query($studentSection);
$studentSectionRow = $studentSectionResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Student</title>
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
                        <h1 class="mt-4">Students</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Student table</li>
                        </ol>
                    </div>
                    <!-- Add student -->
                    <a href="add_student.php" type="button" style="align-self: end;" class="btn btn-success px-3 py-1 mb-3">
                        Add
                    </a>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            <?php echo $sectionName . " - " . $studentSectionRow['grade'] ?>
                        </div>
                        <a href="sf5.php" style="border: none; background: transparent;" target="_blank">
                            <i class="fa-solid fa-print"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Birthday</th>
                                    <th>Age</th>
                                    <th>Grade & Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $student = "SELECT * FROM `student` WHERE `section` = '$sectionName' ORDER BY `name` ASC";
                                $studentResult = $conn->query($student);
                                while ($studentRow = $studentResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $studentRow["lrn"] ?></td>
                                        <td><?php echo $studentRow["name"] ?></td>
                                        <td><?php echo $studentRow["sex"] ?></td>
                                        <td><?php echo $studentRow["birth_date"] ?></td>
                                        <td><?php echo $studentRow["age"] ?></td>
                                        <td><?php echo $studentRow["section"] . " - " . $studentRow["grade"] ?></td>
                                        <?php
                                        $name = $studentRow['name'];
                                        $check = "SELECT * FROM `sf9` WHERE `student_name` = '$name'";
                                        $checkResult = $conn->query($check);
                                        $checkCount = $checkResult->num_rows;
                                        if ($checkCount > 0) {
                                            echo '<td class="text-success">Done</td>';
                                        } else {
                                            echo '<td class="text-warning">Pending</td>';
                                        }
                                        ?>
                                        <td>
                                            <a href="add.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent; text-decoration:none;" class="text-success">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;" class="mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a href="edit_student.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                        Edit student
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="edit.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                        Edit School Form
                                                    </a>
                                                </li>
                                            </ul>
                                            <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;">
                                                <i class="fa-solid fa-print"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item">
                                                    <a href="sf9.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                        Print SF 9
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="sf10.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                        Print SF 10
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php
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