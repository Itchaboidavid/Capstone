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
    <title>Edit Semester</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Semester</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="semester_table.php">Semester Table</a></li>
                            <li class="breadcrumb-item active">Edit Semester</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Semester</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $semester = "SELECT * FROM `semester` WHERE id = $id";
                            $semesterResult = $conn->query($semester);
                            $semesterRow = $semesterResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $semesterRow["name"] ?>" required />
                                <label for="name">Semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a semester.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="start_date" id="start_date" placeholder="start_date" class="form-control bg-body-tertiary" value="<?php echo $semesterRow["default_start"] ?>" required />
                                <label for="start_date">Start of semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a date.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="end_date" id="end_date" placeholder="end_date" class="form-control bg-body-tertiary" value="<?php echo $semesterRow["default_end"] ?>" required />
                                <label for="end_date">End of semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a date.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_semester">Save</button>
                                <a href="semester_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
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
//EDIT SEMESTER
if (isset($_POST['edit_semester'])) {
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


    $update = "UPDATE `semester` SET `name`='$name',`start_year`='$start_year',`end_year`='$end_year',`output`='$output',`start_date`='$formattedStartDate',`end_date`='$formattedEndDate',`default_start`='$defaultStartDate',`default_end`='$defaultEndDate' WHERE `id` = $id";
    $result = mysqli_query($conn, $update);

    if ($result) {
        echo ("<script>location.href = 'semester_table.php?msg=Semester updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'semester_table.php?errmsg=Semester updating unsuccessful.';</script>");
        exit();
    }
}
