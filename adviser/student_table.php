<?php
include("../config.php");
session_start();

$sectionName = $_SESSION['section'];
$sy = "SELECT * FROM school_year WHERE is_archived = 0";
$syResult = $conn->query($sy);
$syRow = $syResult->fetch_assoc();
$school_year_id = $syRow['id'];

$studentSection = "SELECT * FROM `section` WHERE `name` = '$sectionName' AND is_archived = 0 AND school_year_id = '$school_year_id'";
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
                    <a href="add_student.php" type="button" style="align-self: end;" class="btn btn-sm btn-success px-3 py-1 mb-3">
                        Add student
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
                            <?php echo $sectionName ?>
                        </div>
                        <button href="#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" style="border: none; background: transparent;" target="_blank">
                            Print
                            <i class="fa-solid fa-print"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="sf5.php" target="_blank">School Form 5</a></li>
                            <li><a class="dropdown-item" href="sf9all.php" target="_blank">School Form 9 all students</a></li>
                            <li><a class="dropdown-item" href="sf10all.php" target="_blank">School Form 10 all students</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>LRN</th>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Birthday</th>
                                    <th>Age</th>
                                    <th>Grade & <br>Section</th>
                                    <th>School Form <br>Status</th>
                                    <th>Student's Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $student = "SELECT * FROM `student` WHERE `section` = '$sectionName' AND is_archived = 0 AND school_year_id = '$school_year_id' ORDER BY `sex` ASC";
                                $studentResult = $conn->query($student);
                                $studentCount = 1;
                                while ($studentRow = $studentResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $studentCount ?></td>
                                        <td><?php echo $studentRow["lrn"] ?></td>
                                        <td><?php echo $studentRow["name"] ?></td>
                                        <td><?php echo $studentRow["sex"] ?></td>
                                        <td><?php echo $studentRow["birth_date"] ?></td>
                                        <td><?php echo $studentRow["age"] ?></td>
                                        <td><?php echo $studentRow["section"] . " - " . $studentRow["grade"] ?></td>
                                        <?php
                                        $studentID = $studentRow['id'];
                                        $check = "SELECT DISTINCT student_id FROM `sf9` WHERE `student_id` = '$studentID'";
                                        $checkResult = $conn->query($check);
                                        $checkCount = $checkResult->num_rows;
                                        if ($checkCount > 0) {
                                            echo '<td class="text-success">Done</td>';
                                        } else {
                                            echo '<td class="text-warning">Pending</td>';
                                        }
                                        ?>
                                        <td><?php echo $studentRow["indicator"] . " " . $studentRow["ri"] . " " . $studentRow["rid"] ?></td>
                                        <td>
                                            <?php
                                            $removeAddBtn = "
                                            SELECT DISTINCT student_id FROM sf5b WHERE student_id = '$studentID'
                                            UNION
                                            SELECT DISTINCT student_id FROM sf9 WHERE student_id = '$studentID'
                                            ";
                                            $removeAddBtnResult = $conn->query($removeAddBtn);
                                            if ($removeAddBtnResult->num_rows > 0) { ?>
                                                <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;" class="mx-1">
                                                    Edit
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="edit_student.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                            Student info
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="edit.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                            School form
                                                        </a>
                                                    </li>
                                                </ul>
                                                <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;">
                                                    Print
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="sf9.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                            School form 9
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="sf10.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                            School form 10
                                                        </a>
                                                    </li>
                                                </ul>
                                            <?php } else { ?>
                                                <a href="add.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent; text-decoration:none;" class="text-success">
                                                    Add
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                                <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;" class="mx-1">
                                                    Edit
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="edit_student.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                            Student info
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="edit.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;">
                                                            School form
                                                        </a>
                                                    </li>
                                                </ul>
                                                <a href="#" data-bs-toggle="dropdown" style="border: none; background: transparent; text-decoration: none;">
                                                    Print
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="sf9.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                            School form 9
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="sf10.php?id=<?php echo $studentRow['id'] ?>" style="text-decoration: none;" target="_blank">
                                                            School form 10
                                                        </a>
                                                    </li>
                                                </ul>
                                            <?php  }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $studentCount++;
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