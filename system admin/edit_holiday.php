<?php
include("../config.php");
session_start();
$holiday_id = $_GET["holiday_id"];
//EDIT SEMESTER
if (isset($_POST['edit_holiday'])) {
    $currentMonth = date('m');
    $currentYear = date('Y');
    $holiday_date = $conn->escape_string($_POST['holiday_date']);
    $holiday_desc = $conn->escape_string($_POST['holiday_desc']);
    $holiday_month = $currentMonth;
    $holiday_year = $currentYear;


    $holiday_update = "UPDATE `holidays` SET `holiday_date`='$holiday_date',`holiday_desc`='$holiday_desc' WHERE holiday_id = '$holiday_id'";
    $holiday_result = $conn->query($holiday_update);

    if ($holiday_result) {
        echo ("<script>location.href = 'school_settings.php?msg3=Holiday updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'school_settings.php?errmsg3=Holiday updating unsuccessful.';</script>");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Holiday</title>
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
                        <h1 class="mt-4">Holiday</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="school_settings.php">Holiday Table</a></li>
                            <li class="breadcrumb-item active">Edit Holiday</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Edit Holiday</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $holiday = "SELECT * FROM `holidays` WHERE holiday_id = $holiday_id";
                            $holidayResult = $conn->query($holiday);
                            $holidayRow = $holidayResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="number" name="holiday_date" id="holiday_date" placeholder="holiday_date" class="form-control bg-body-tertiary" required min="1" max="31" value="<?php echo $holidayRow['holiday_date'] ?>" />
                                <label for="holiday_date">Holiday Date</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a valid holiday date.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="holiday_desc" id="holiday_desc" placeholder="holiday_desc" class="form-control bg-body-tertiary" required value="<?php echo $holidayRow['holiday_desc'] ?>" />
                                <label for="holiday_desc">Holiday Description</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a holiday description.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_holiday">Save</button>
                                <a href="sy_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="../index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
$conn->close();
?>