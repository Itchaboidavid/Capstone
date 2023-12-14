<?php
include("../config.php");
session_start();

$currentMonth = date('m');
$currentYear = date('Y');
$id = $_GET['id'];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = $conn->query($student);
$studentRow = $studentResult->fetch_assoc();
$sex = $studentRow['sex'];
// Fetch existing remarks if they exist
$existingRemarks = "";
$check2 = "SELECT * FROM sf2remarks WHERE student_id = '$id'";
$check2Result = $conn->query($check2);
$check2Count = $check2Result->num_rows;

if ($check2Count > 0) {
    $existingRow = $check2Result->fetch_assoc();
    $existingRemarks = $existingRow['remarks'];
}

if (isset($_POST['add_remarks'])) {

    $remarks = $conn->escape_string($_POST['remarks']);
    $studentName = $studentRow['name'];
    $studentSection = $studentRow['section'];

    // Check if a record already exists for the student
    $check = "SELECT * FROM sf2remarks WHERE student_id = '$id' AND month = '$currentMonth' AND year = '$currentYear'";
    $checkResult = $conn->query($check);
    $checkCount = $checkResult->num_rows;

    if ($checkCount > 0) {
        // If a record exists, update the existing record
        $update = "UPDATE `sf2remarks` SET `remarks`='$remarks' WHERE `student_id`='$id'";
        $updateResult = $conn->query($update);
        if ($updateResult) {
            header("location:sf2.php?msg=Remarks updated successfully!");
            exit();
        } else {
            header("location:sf2.php?errmsg=Failed to update remarks!");
            exit();
        }
    } else {
        // If no record exists, insert a new record
        $insert = "INSERT INTO `sf2remarks`(`student_id`, `student_name`, `section`, `sex`, `remarks`, `month`, `year`) VALUES ('$id','$studentName','$studentSection','$sex','$remarks','$currentMonth','$currentYear')";
        $insertResult = $conn->query($insert);
        if ($insertResult) {
            header("location:sf2.php?msg=Remarks added successfully!");
            exit();
        } else {
            header("location:sf2.php?errmsg=Failed to add remarks!");
            exit();
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SF 2 Remarks</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>
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
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="student_table.php">Student Table</a></li>
                            <li class="breadcrumb-item active">School Form 2 Remarks</li>
                        </ol>
                    </div>
                </div>
                <div class="row g-5">
                    <form action="" method="POST" class="needs-validation col-8" novalidate>
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
                        <div class="card mb-5">
                            <div class="card-header">
                                <h4><?php echo $studentRow['name'] ?></h4>
                            </div>
                            <div class="card-body row g-1">
                                <div class="form-floating mb-3 col">
                                    <input type="text" name="remarks" id="remarks" placeholder="remarks" class="form-control bg-body-tertiary" required value="<?php echo htmlspecialchars($existingRemarks); ?>" />
                                    <label for="remarks">Student Remarks</label>
                                </div>
                            </div>
                            <div class="card-footer pe-0">
                                <div class="ms-auto" style="width: 150px;">
                                    <button type="submit" class="btn btn-primary" name="add_remarks">Save</button>
                                    <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <aside class="col-4">
                        <img src="../images/sf2remarks.png" alt="sf 2 remarks" style="width: 250px;">
                    </aside>
                </div>
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
<?php $conn->close();
?>