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
    <title>Sections</title>
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
                        <h1 class="mt-4">Sections</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sections table</li>
                        </ol>
                    </div>
                </div>
                <?php
                $sySQL = "SELECT * FROM school_year WHERE is_archived = 0";
                $syResult = $conn->query($sySQL);
                $syRow = $syResult->fetch_assoc();
                $school_year_id = $syRow['id'];
                ?>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Section table
                        </div>
                        <!-- <a href="sf1.php" style="border: none; background: transparent;" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a> -->
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Section</th>
                                    <th>Track & Strand</th>
                                    <th>Grade</th>
                                    <th>School Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $section = "SELECT * FROM section WHERE school_year_id = '$school_year_id' AND is_archived = 0";
                                $sectionResult = $conn->query($section);
                                $sectionCount = 1;
                                while ($sectionRow = $sectionResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $sectionCount ?></td>
                                        <td><?php echo $sectionRow["name"] ?></td>
                                        <td><?php echo $sectionRow["track"] . " - " . $sectionRow["strand"] ?></td>
                                        <td><?php echo $sectionRow["grade"] ?></td>
                                        <td><?php echo $sectionRow["school_year"] ?></td>
                                        <td>
                                            <a href="student_table.php?id=<?php echo $sectionRow['id'] ?>" style="text-decoration: none;">
                                                View
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $sectionCount++;
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