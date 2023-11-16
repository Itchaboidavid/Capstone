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
    <title>Semester</title>
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
                        <h1 class="mt-4">Semester</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Semester table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#trackModal">
                        Add
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="trackModalLabel">Add strand</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="name" id="name" placeholder="name" required>
                                                <option value="" selected>Semester</option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                                <option value="3rd">3rd</option>
                                            </select>
                                            <label for="name">Semester</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter semester.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" name="start_date" id="start_date" placeholder="start_date" class="form-control bg-body-tertiary" required />
                                            <label for="start_date">Start of semester</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a date.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" name="end_date" id="end_date" placeholder="end_date" class="form-control bg-body-tertiary" required />
                                            <label for="end_date">End of semester</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a date.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_semester">Add</button>
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
                        Semester table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $semester = "SELECT * FROM `semester` ORDER BY `name`";
                                $semesterResult = $conn->query($semester);
                                while ($semesterRow = $semesterResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $semesterRow["id"] ?></td>
                                        <td><?php echo $semesterRow["output"] ?></td>
                                        <td>
                                            <a href="edit_semester.php?id=<?php echo $semesterRow['id'] ?>" style="border: none; background: transparent;">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
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

<?php
if (isset($_POST["edit_semester"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

    $defaultStartDate = mysqli_real_escape_string($conn, $_POST["start_date"]);
    $defaultEndDate = mysqli_real_escape_string($conn, $_POST["end_date"]);
    $dateStringStart = mysqli_real_escape_string($conn, $_POST["start_date"]);
    // Creating a DateTime object from the date string
    $dateStart = new DateTime($dateStringStart);
    // Formatting the date to mm/dd/yy format
    $formattedStartDate = $dateStart->format('m/d/y');
    // Extracting the year from the DateTime object
    $start_year = $dateStart->format('Y');

    $dateStringEnd = mysqli_real_escape_string($conn, $_POST["end_date"]);
    // Creating a DateTime object from the date string
    $dateEnd = new DateTime($dateStringEnd);
    // Formatting the date to mm/dd/yy format
    $formattedEndDate = $dateEnd->format('m/d/y');
    // Extracting the year from the DateTime object
    $end_year = $dateEnd->format('Y');
    $output = $name . " (" . $start_year . " - " . $end_year . ")";

    $select = "SELECT * FROM `semester` WHERE `output` = '$output'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'semester_table.php?errmsg=The semester already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `semester` (`name`,`start_year`,`end_year`,`output`,`start_date`,`end_date`,`default_start`,`default_end`) VALUES ('$name','$start_year','$end_year','$output','$formattedStartDate','$formattedEndDate','$defaultStartDate','$defaultEndDate')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'semester_table.php?msg=Semester successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>