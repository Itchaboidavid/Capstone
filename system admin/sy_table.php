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
    <title>School year</title>
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
                        <h1 class="mt-4">School year</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">School year table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#syModal">
                        Add school year
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="syModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="trackModalLabel">Add School Year</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="start_year" id="start_year" placeholder="start_year" class="form-control bg-body-tertiary" required minlength="4" maxlength="4" />
                                            <label for="start_year">Start of school year</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a year.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="end_year" id="end_year" placeholder="end_year" class="form-control bg-body-tertiary" required minlength="4" maxlength="4" />
                                            <label for="end_year">End of school year</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a year.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_sy">Add</button>
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
                        School year table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>School year</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $schoolyear = "SELECT * FROM `school_year` ORDER BY `start_year`";
                                $schoolyearResult = $conn->query($schoolyear);
                                $schoolyearCount = 1;
                                while ($schoolyearRow = $schoolyearResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $schoolyearCount ?></td>
                                        <td><?php echo $schoolyearRow["sy"] ?></td>
                                        <td>
                                            <?php
                                            if ($schoolyearRow["is_archived"] == 0) {
                                                echo '<span class="text-success">Active</span>';
                                            } else {
                                                echo '<span class="text-danger">Archived</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="edit_sy.php?id=<?php echo $schoolyearRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;" class="me-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="archive_sy.php?id=<?php echo $schoolyearRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;" onclick="return confirm('Are you sure you want to change the school year?');">
                                                <?php
                                                if ($schoolyearRow["is_archived"] == 0) { ?>
                                                    <i class="fa-solid fa-toggle-on"></i>
                                                <?php } else { ?>
                                                    <a href="archive_sy.php?id=<?php echo $schoolyearRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;" onclick="return confirm('Are you sure you want to change the school year?');">
                                                        <i class="fa-solid fa-toggle-off"></i>
                                                    </a>
                                                <?php }
                                                ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $schoolyearCount++;
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

<?php
if (isset($_POST["add_sy"])) {
    $start_year = $conn->real_escape_string($_POST['start_year']);
    $end_year = $conn->real_escape_string($_POST['end_year']);
    $sy = $start_year . " - " . $end_year;

    $select = "SELECT * FROM `school_year` WHERE `sy` = '$sy'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'sy_table.php?errmsg=The school year already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `school_year`(`start_year`, `end_year`, `sy`) VALUES ('$start_year','$end_year','$sy')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'sy_table.php?msg=Semester successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>