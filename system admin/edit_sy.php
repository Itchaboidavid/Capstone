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
    <title>Edit School Year</title>
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
                        <h1 class="mt-4">School year</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="sy_table.php">School Year Table</a></li>
                            <li class="breadcrumb-item active">Edit School Year</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Edit School Year</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $sy = "SELECT * FROM `school_year` WHERE id = $id";
                            $syResult = $conn->query($sy);
                            $syRow = $syResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="start_year" id="start_year" placeholder="start_year" class="form-control bg-body-tertiary" value="<?php echo $syRow["start_year"] ?>" required minlength="4" maxlength="4" />
                                <label for="start_year">Start of school year</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a year.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="end_year" id="end_year" placeholder="end_year" class="form-control bg-body-tertiary" value="<?php echo $syRow["end_year"] ?>" required minlength="4" maxlength="4" />
                                <label for="end_year">End of school year</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a year.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_sy">Save</button>
                                <a href="sy_table.php" type="button" class="btn btn-danger">Close</a>
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
if (isset($_POST['edit_sy'])) {
    $start_year = $conn->real_escape_string($_POST['start_year']);
    $end_year = $conn->real_escape_string($_POST['end_year']);
    $sy = $start_year . " - " . $end_year;


    $update = "UPDATE `school_year` SET `start_year`='$start_year',`end_year`='$end_year',`sy`='$sy' WHERE id = '$id'";
    $result = mysqli_query($conn, $update);

    if ($result) {
        echo ("<script>location.href = 'sy_table.php?msg=School year updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'sy_table.php?errmsg=School year updating unsuccessful.';</script>");
        exit();
    }
}
