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
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Student table</li>
                        </ol>
                    </div>
                    <a href="sf8all.php" target="_blank" class="pe-3 btn btn-primary">
                        <span>Print All <i class="fa-solid fa-print ms-1"></i></span>
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
                <?php
                $sql = "SELECT * FROM section WHERE is_archived = 0";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $sectionName = $row['name'];
                ?>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                <?php echo $sectionName ?>
                            </div>
                            <a href="sf8.php?id=<?php echo $row['id'] ?>" style="border: none; background: transparent;" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Sex</th>
                                        <th>BMI<br>(kg/m<sup>2</sup>)</th>
                                        <th>BMI<br>Category</th>
                                        <th>HFA <br>(Height for age)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $student = "SELECT * FROM `student` WHERE is_archived = 0 AND section = '$sectionName'";
                                    $studentResult = $conn->query($student);
                                    $studentCount = 1;
                                    while ($studentRow = $studentResult->fetch_assoc()) :
                                    ?>
                                        <tr>
                                            <td><?php echo $studentCount ?></td>
                                            <td><?php echo $studentRow["section"] ?></td>
                                            <td><?php echo $studentRow["lrn"] ?></td>
                                            <td><?php echo $studentRow["name"] ?></td>
                                            <td><?php echo $studentRow["age"] ?></td>
                                            <td><?php echo $studentRow["sex"] ?></td>
                                            <td><?php echo $studentRow["bmi"] ?></td>
                                            <td><?php echo $studentRow["bmi_category"] ?></td>
                                            <td><?php echo $studentRow["hfa_category"] ?></td>
                                            <td>
                                                <a href="add_bmi.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent; text-decoration:none;" class="text-success me-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </a>
                                                <a href="edit_student.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent;">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
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
                <?php } ?>
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