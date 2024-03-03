<?php
include("../config.php");
session_start();
// Display existing values in the input fields if records exist
$start_date_value = isset($existingStartDate) ? $existingStartDate : '';
$end_date_value = isset($existingEndDate) ? $existingEndDate : '';

if (isset($_POST['schoolStart'])) {
    $currentMonth = date('m');
    $currentYear = date('Y');

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Check if a record already exists for the current month and year
    $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM schoolstart WHERE month = ? AND year = ?");
    $checkRecordStmt->bind_param("ss", $currentMonth, $currentYear);
    $checkRecordStmt->execute();
    $checkRecordStmt->store_result();
    $checkRecordStmt->bind_result($recordCount);
    $checkRecordStmt->fetch();

    if ($recordCount > 0) {
        // Record already exists, update the values
        $updateStmt = $conn->prepare("UPDATE schoolstart SET start_date = ?, end_date = ? WHERE month = ? AND year = ?");
        $updateStmt->bind_param("ssss", $start_date, $end_date, $currentMonth, $currentYear);
        $updateStmt->execute();

        // Redirect after successful submission
        header("Location: school_settings.php?msg2=School days updated successfully!");
        exit();
    } else {
        // Record doesn't exist, insert a new one
        $insertStmt = $conn->prepare("INSERT INTO `schoolstart`(`month`, `year`, `start_date`, `end_date`) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $currentMonth, $currentYear, $start_date, $end_date);
        $insertStmt->execute();

        // Redirect after successful submission
        header("Location: school_settings.php?msg2=School days updated successfully!");
        exit();
    }

    $checkRecordStmt->free_result();  // Free the result set
    $checkRecordStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>School settings</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="../index.js"></script>
    <script>
        // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        url.searchParams.delete('errmsg');
        url.searchParams.delete('msg2');
        url.searchParams.delete('errmsg2');
        url.searchParams.delete('msg3');
        url.searchParams.delete('errmsg3');
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
                        <h1 class="mt-4">School Settings</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">School Settings</li>
                        </ol>
                    </div>
                </div>
                <!-- SCHOOL DAYS -->
                <form action="" method="POST" class="col-6">
                    <?php
                    if (isset($_GET['msg2'])) {
                        $msg = $_GET['msg2'];
                        echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'
                            . $msg .
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                    }

                    if (isset($_GET['errmsg'])) {
                        $errmsg = $_GET['errmsg2'];
                        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
                            . $errmsg .
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                    }
                    ?>

                    <div class="card mb-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>School Start and End for the month of :
                                <?php
                                $currentMonth = date('m');
                                $currentYear = date('Y');
                                echo date('F', strtotime($currentYear . '-' . $currentMonth . '-01'));
                                ?>
                            </h5>
                        </div>
                        <div class="card-body row g-1">
                            <?php
                            $currentMonth = date('m');
                            $currentYear = date('Y');
                            $check = "SELECT * FROM schoolstart WHERE month = '$currentMonth' AND year = '$currentYear'";
                            $checkResult = $conn->query($check);
                            $checkRow = $checkResult->fetch_assoc();
                            ?>
                            <div class="form-floating">
                                <input type="number" name="start_date" class="form-control" id="start_date" placeholder="start date" value="<?php echo $checkRow['start_date'] ?>" min="1" max="31">
                                <label for="start_date">Start date</label>
                            </div>
                            <div class="form-floating">
                                <input type="number" name="end_date" class="form-control" id="end_date" placeholder="end date" value="<?php echo $checkRow['end_date'] ?>" min="1" max="31">
                                <label for="end_date">End date</label>
                            </div>

                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="schoolStart">Save</button>
                                <a href="dashboard.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card mb-5">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Holiday table
                    </div>
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="mb-3">
                            <h5>
                                Holidays for the month of :
                                <?php
                                $currentMonth = date('m');
                                $currentYear = date('Y');
                                echo "<span class='fw-bold'>" . date('F', strtotime($currentYear . '-' . $currentMonth . '-01')) . "</span>";
                                ?>
                            </h5>
                            <!-- Button trigger modal -->
                            <button type="button" style="align-self: end;" class="btn btn-success px-3 py-1" data-bs-toggle="modal" data-bs-target="#holidayModal">
                                Add Holiday
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="holidayModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class=" modal-title fs-5" id="trackModalLabel">Add Holiday</h1>
                                            <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="POST" class="needs-validation" novalidate>
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="holiday_date" id="holiday_date" placeholder="holiday_date" class="form-control bg-body-tertiary" required min="1" max="31" />
                                                    <label for="holiday_date">Holiday Date</label>
                                                    <div class="valid-feedback ps-1">Great!</div>
                                                    <div class="invalid-feedback ps-1"> Please enter a valid holiday date.</div>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="holiday_desc" id="holiday_desc" placeholder="holiday_desc" class="form-control bg-body-tertiary" required />
                                                    <label for="holiday_desc">Holiday Description</label>
                                                    <div class="valid-feedback ps-1">Great!</div>
                                                    <div class="invalid-feedback ps-1"> Please enter a holiday description.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="add_holiday">Add</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['msg3'])) {
                            $msg3 = $_GET['msg3'];
                            echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'
                                . $msg3 .
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                        }

                        if (isset($_GET['errmsg3'])) {
                            $errmsg3 = $_GET['errmsg3'];
                            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
                                . $errmsg3 .
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                        }
                        ?>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Holiday Date</th>
                                    <th>Holiday Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $holidays = "SELECT * FROM `holidays` WHERE holiday_month = '$currentMonth' ORDER BY `holiday_date`";
                                $holidaysResult = $conn->query($holidays);
                                $holidaysCount = 1;
                                while ($holidaysRow = $holidaysResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $holidaysCount ?></td>
                                        <td><?php echo $holidaysRow['holiday_date'] ?></td>
                                        <td><?php echo $holidaysRow['holiday_desc'] ?></td>
                                        <td>
                                            <a href="edit_holiday.php?holiday_id=<?php echo $holidaysRow['holiday_id'] ?>" style="border: none; background: transparent;">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $holidaysCount++;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form action="" method="POST">
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
                    $school = "SELECT * FROM `school`";
                    $result = $conn->query($school);
                    $row = $result->fetch_assoc();
                    ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="text-capitalize">School Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="school_name" id="school_name" placeholder="school_name" class="form-control bg-body-tertiary" required disabled value="<?php echo $row['school_name'] ?>" />
                                <label for="school_name">School Name</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school name.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="number" name="school_id" id="school_id" placeholder="school_id" class="form-control bg-body-tertiary" required disabled value="<?php echo $row['school_id'] ?>" />
                                <label for=" school_id">School ID</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school ID.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="school_district" id="school_district" placeholder="school_district" class="form-control bg-body-tertiary" required disabled value="<?php echo $row['school_district'] ?>" />
                                <label for="school_district">School District</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school district.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="school_division" id="school_division" placeholder="school_division" class="form-control bg-body-tertiary" required disabled value="<?php echo $row['school_division'] ?>" />
                                <label for="school_division">School Division</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school division.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="school_region" id="school_region" placeholder="school_region" class="form-control bg-body-tertiary" required disabled value="<?php echo $row['school_region'] ?>" />
                                <label for="school_region">School Region</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school region.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="school_head" id="school_head" placeholder="school_head" class="form-control bg-body-tertiary" required value="<?php echo $row['school_head'] ?>" />
                                <label for="school_head">School Head</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school head.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="schoolhead_designation" id="schoolhead_designation" placeholder="schoolhead_designation" class="form-control bg-body-tertiary" required value="<?php echo $row['schoolhead_designation'] ?>" />
                                <label for="schoolhead_designation">School Head Designation</label>
                                <div class="valid-feedback bg-body-tertiary">Great!</div>
                                <div class="invalid-feedback bg-body-tertiary"> Please enter a school head designation.</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                <a href="dashboard.php" type="button" class="btn btn-danger">Close</a>
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
if (isset($_POST['submit'])) {
    // $school_name = $conn->escape_string($_POST['school_name']);
    // $school_id = $conn->escape_string($_POST['school_id']);
    // $school_district = $conn->escape_string($_POST['school_district']);
    // $school_division = $conn->escape_string($_POST['school_division']);
    // $school_region = $conn->escape_string($_POST['school_region']);
    $school_head = $conn->escape_string($_POST['school_head']);
    $schoolhead_designation = $conn->escape_string($_POST['schoolhead_designation']);

    $update = "UPDATE `school` SET `school_head`='$school_head',`schoolhead_designation`='$schoolhead_designation' WHERE `id` = '1'";

    if ($conn->query($update)) {
        echo ("<script>location.href = 'school_settings.php?msg=Information updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'school_settings.php?errmsg=There's an error in updating school information!';</script>");
        exit();
    }
}

if (isset($_POST['add_holiday'])) {
    $currentMonth = date('m');
    $currentYear = date('Y');
    $holiday_date = $conn->escape_string($_POST['holiday_date']);
    $holiday_desc = $conn->escape_string($_POST['holiday_desc']);
    $holiday_month = $currentMonth;
    $holiday_year = $currentYear;

    $check_holiday = "SELECT * FROM holidays WHERE holiday_date = '$holiday_date' AND holiday_month = '$holiday_month' AND holiday_year = '$holiday_year'";
    $check_result = $conn->query($check_holiday);
    if ($check_result->num_rows > 0) {
        echo ("<script>location.href = 'school_settings.php?errmsg3=The holiday already exist!';</script>");
        exit();
    } else {
        $holiday_sql = "INSERT INTO `holidays`(`holiday_date`, `holiday_desc`, `holiday_month`, `holiday_year`) VALUES ('$holiday_date','$holiday_desc','$holiday_month','$holiday_year')";
        $conn->query($holiday_sql);
        echo ("<script>location.href = 'school_settings.php?msg3=Holiday successfully added!';</script>");
        exit();
    }
}
$conn->close();
