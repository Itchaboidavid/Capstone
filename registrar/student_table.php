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
                </div>
                <?php
                $sySQL = "SELECT * FROM school_year WHERE is_archived = 0";
                $syResult = $conn->query($sySQL);
                $syRow = $syResult->fetch_assoc();
                $school_year_id = $syRow['id'];

                $section = "SELECT * FROM section WHERE school_year_id = '$school_year_id' AND is_archived = 0";
                $sectionResult = $conn->query($section);
                while ($sectionRow = $sectionResult->fetch_assoc()) {
                    $sectionName = $sectionRow['name'];
                ?>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                <?php echo $sectionName ?>
                            </div>
                            <a href="sf1.php" style="border: none; background: transparent;" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Birthday</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Grade & Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $student = "SELECT * FROM `student` WHERE is_archived = 0 AND section = '$sectionName' AND school_year_id = '$school_year_id' ORDER BY `sex`, `name` ASC";
                                    $studentResult = $conn->query($student);
                                    while ($studentRow = $studentResult->fetch_assoc()) :
                                    ?>
                                        <tr>
                                            <td><?php echo $studentRow["lrn"] ?></td>
                                            <td><?php echo $studentRow["name"] ?></td>
                                            <td><?php echo $studentRow["sex"] ?></td>
                                            <td><?php echo $studentRow["birth_date"] ?></td>
                                            <td><?php echo $studentRow["age"] ?></td>
                                            <td>
                                                <?php echo $studentRow["house_no"] ?>,
                                                <?php echo $studentRow["barangay"] ?>,
                                                <?php echo $studentRow["municipality"] ?>,
                                                <?php echo $studentRow["province"] ?>
                                            </td>
                                            <td><?php echo $studentRow["section"] . " - " . $studentRow["grade"] ?></td>
                                        </tr>
                                    <?php
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