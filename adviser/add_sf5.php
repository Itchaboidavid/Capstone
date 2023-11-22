<?php
include("../config.php");
session_start();

$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = $conn->query($student);
$studentRow = $studentResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SF 5</title>
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
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="student_table.php">Student Table</a></li>
                            <li class="breadcrumb-item active">SF 5</li>
                        </ol>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><?php echo $studentRow['name'] ?></h4>
                    </div>
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="card-body">
                            <h4>SF 5</h4>
                            <div class="form-floating mb-3">
                                <input type="text" name="completed" id="completed" placeholder="completed" class="form-control bg-body-tertiary" required minlength="2" maxlength="3" />
                                <label for="house_no">Completed SHS for 2 years (Yes/No) </label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter Yes or No.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="nc" id="nc" placeholder="nc" class="form-control bg-body-tertiary" minlength="3" maxlength="6" />
                                <label for="house_no">National Certification Level Attained (only if applicable)</label>
                            </div>
                            <div class="card-footer pe-0">
                                <div class="ms-auto" style="width: 150px;">
                                    <button type="submit" class="btn btn-primary" name="add_sf5">Add</button>
                                    <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                                </div>
                            </div>
                    </form>
                </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php
if (isset($_POST['add_sf5'])) {
    $studentName = $studentRow['name'];
    $sex = $studentRow['sex'];
    $section = $studentRow['section'];

    for ($i = 1; $i <= 5; $i++) {
        $sem = $conn->real_escape_string($_POST['semester' . $i]);
        $subjectType = $conn->real_escape_string($_POST['subject_type' . $i]);
        $subjectTitle = $conn->real_escape_string($_POST['subject_title' . $i]);
        $first = (float)$_POST['first' . $i];
        $second = (float)$_POST['second' . $i];
        $finalGrade = ($first + $second) / 2;
        $action = $conn->real_escape_string($_POST['action' . $i]);

        $sql = "INSERT INTO `sf10remedial`(`student_name`, `subject_type`, `subject_title`, `old_grade`, `new_grade`, `final_grade`, `semester`,`action`, `sex`, `section`) VALUES ('$studentName','$subjectType','$subjectTitle','$first','$second','$finalGrade','$sem','$action', '$sex', '$section')";
        $sqlResult = $conn->query($sql);
    }

    $startDate1 = $_POST['startDate1'];
    $endDate1 = $_POST['endDate1'];
    $startDate2 = $_POST['startDate2'];
    $endDate2 = $_POST['endDate2'];

    $check = "SELECT * FROM `sf10remedialDate` WHERE `student_name` = '$studentName'";
    $checkResult = $conn->query($check);
    $checkCount = $checkResult->num_rows;

    if ($checkCount > 0) {
        echo ("<script>location.href = 'student_table.php?errmsg=Duplication of entry!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `sf10remedialdate`( `student_name`, `start_date1`, `end_date1`, `start_date2`, `end_date2`) VALUES ('$studentName','$startDate1','$endDate1','$startDate2','$endDate2')";
        $insertResult = $conn->query($insert);
        echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
        exit();
    }
}

?>