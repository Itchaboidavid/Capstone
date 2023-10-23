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
    <title>CLASS LIST</title>

    <!-- DATA TABLES -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script defer src="data_table.js"></script>
    <script defer src="../index.js"></script>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="p-5">
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
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex align-items-center justify-content-between">
                        <?php
                        $faculty = $_SESSION['name'];
                        $section = "SELECT * FROM `section` WHERE `faculty` = '$faculty'";
                        $sectionResult = $conn->query($section);
                        $sectionRow = $sectionResult->fetch_assoc();
                        ?>
                        <span class="fs-4" style="text-shadow: 1px 1px 3px black; letter-spacing: 1px;"><?php echo $sectionRow['name'] . " - " . $sectionRow['grade'] ?></span>
                        <form action="sf5.php" method="POST" target="_blank">
                            <button type="submit" name="print" id="print" class="ms-auto"><i class="bi bi-printer-fill fs-6"></i></button>
                        </form>
                    </div>
                    <div class="card-body bg-body-tertiary">
                        <div class="table-responsive">
                            <table id="adviserTable" class="table table-striped table-secondary table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Birthday</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <!-- <th>Status</th> -->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $faculty = $_SESSION["name"];
                                    $select_section = "SELECT * FROM `section` WHERE `faculty` = '$faculty'";
                                    $result_section = mysqli_query($conn, $select_section);
                                    $row_section = mysqli_fetch_assoc($result_section);
                                    $section = $row_section["name"];

                                    $select = "SELECT * FROM `student` WHERE `section` = '$section'";
                                    $result = mysqli_query($conn, $select);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row["lrn"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                            <td><?php echo $row["sex"] ?></td>
                                            <td><?php echo $row["birth_date"] ?></td>
                                            <td><?php echo $row["age"] ?></td>
                                            <td>
                                                <?php echo $row["house_no"] ?>,
                                                <?php echo $row["barangay"] ?>,
                                                <?php echo $row["municipality"] ?>,
                                                <?php echo $row["province"] ?>
                                            </td>
                                            <!-- <?php
                                                    if ($row["status"] == "complete") {
                                                        echo '<td class="text-success">' . $row["status"] . '</td>';
                                                    } else {
                                                        echo '<td class="text-danger">' . $row["status"] . '</td>';
                                                    }
                                                    ?> -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        Action
                                                    </button>
                                                    <ul class="dropdown-menu bg-body-secondary">
                                                        <li>
                                                            <a href="add9&10.php?id=<?php echo $row['id'] ?>" class="dropdown-item">
                                                                Subjects & Grades
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="sf9&10.php?id=<?php echo $row['id'] ?>" class="dropdown-item" target="_blank">
                                                                Print
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>