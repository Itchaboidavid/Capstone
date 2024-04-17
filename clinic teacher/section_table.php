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
    <title>Section</title>
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
                        <h1 class="mt-4">Section</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Section table</li>
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
                $sy = "SELECT * FROM school_year WHERE is_archived = 0";
                $syResult = $conn->query($sy);
                $syRow = $syResult->fetch_assoc();
                $school_year_id = $syRow['id'];
                ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Section Table
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover" style="font-size: 14px;">
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
                                $sql = "SELECT * FROM section WHERE is_archived = 0 AND school_year_id = '$school_year_id'";
                                $result = $conn->query($sql);
                                $sectionCount = 1;
                                while ($sectionRow = $result->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $sectionCount ?></td>
                                        <td><?php echo $sectionRow["name"] ?></td>
                                        <td><?php echo $sectionRow["track"] . " - " . $sectionRow["strand"] ?></td>
                                        <td><?php echo $sectionRow["grade"] ?></td>
                                        <td><?php echo $sectionRow["school_year"] ?></td>
                                        <td>
                                            <a href="student_table.php?section_id=<?php echo $sectionRow['id'] ?>" class="me-1" style="text-decoration: none;">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                            <a href="sf8.php?section_id=<?php echo $sectionRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;" target="_blank">
                                                <i class="fa-solid fa-print"></i>
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