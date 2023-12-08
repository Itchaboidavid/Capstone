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
    } else {
        // Record doesn't exist, insert a new one
        $insertStmt = $conn->prepare("INSERT INTO `schoolstart`(`month`, `year`, `start_date`, `end_date`) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("ssss", $currentMonth, $currentYear, $start_date, $end_date);
        $insertStmt->execute();
    }

    $checkRecordStmt->free_result();  // Free the result set
    $checkRecordStmt->close();
}

if (isset($_POST['add_student'])) {
    $currentMonth = date('m');
    $currentYear = date('Y');

    function getStudentInfo($conn, $studentId, $currentMonth)
    {
        $stmt = $conn->prepare("SELECT name, section, sex FROM student WHERE id = ?");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Add the month to the result array
        $studentInfo = $result->fetch_assoc();
        $studentInfo['month'] = $currentMonth;

        return $studentInfo;
    }

    try {
        foreach ($_POST['attendance'] as $studentId => $attendanceData) {
            foreach ($attendanceData as $day => $status) {
                $currentMonth = date('m'); // Add this line inside the loop

                // Check if a record already exists in the database for the current student, day, and status
                $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM sf2 WHERE student_id = ? AND day = ? AND attendance_status = ? AND attendance_month = ?");
                $checkRecordStmt->bind_param("isss", $studentId, $day, $status, $currentMonth);
                $checkRecordStmt->execute();
                $checkRecordStmt->store_result();
                $checkRecordStmt->bind_result($recordCount);
                $checkRecordStmt->fetch();

                if ($recordCount == 0) {
                    // Record doesn't exist, insert a new one
                    $insertStmt = $conn->prepare("INSERT INTO sf2 (student_id, student_name, student_section, sex, day, attendance_status, attendance_month) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $studentInfo = getStudentInfo($conn, $studentId, $currentMonth); // Pass currentMonth to getStudentInfo
                    $insertStmt->bind_param("isssssi", $studentId, $studentInfo['name'], $studentInfo['section'], $studentInfo['sex'], $day, $status, $currentMonth);
                    $insertStmt->execute();
                }

                $checkRecordStmt->free_result();  // Free the result set
                $checkRecordStmt->close();
            }
        }

        // Redirect after successful submission
        header("Location: sf2.php?msg=Attendance updated successfully!");
        exit();
    } catch (Exception $e) {
        // Handle exceptions or errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SF 2</title>
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
                            <li class="breadcrumb-item active">School Form 2</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="w-50">
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>School Start and End for the month:
                                <?php
                                $currentMonth = date('m');
                                $currentYear = date('Y');
                                echo date('F', strtotime('2023-' . $currentMonth . '-01'));
                                ?>
                            </h4>
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
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="" method="POST" class="needs-validation" novalidate>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Monthly Attendance (SF 2)</h4>
                            <a href="sf2PDF.php" style="border: none; background: transparent;" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body row g-1">
                            <?php
                            $section = $_SESSION['section'];
                            // Get student information
                            $students = mysqli_query($conn, "SELECT * FROM student WHERE section = '$section'");

                            // Get current month and year
                            $currentMonth = date('m');
                            $currentYear = date('Y');

                            // Determine the number of days in the current month
                            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                            // Calculate weekdays and weekend days
                            $weekdays = 0;
                            $weekendDays = 0;

                            for ($i = 1; $i <= $daysInMonth; $i++) {
                                $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));
                                if ($day == 'Sat' || $day == 'Sun') {
                                    $weekendDays++;
                                } else {
                                    $weekdays++;
                                }
                            }

                            // Create table header
                            echo '<table class="table table-sm border table-striped table-hover">';
                            echo '<tr>';
                            echo '<td class="fw-bold table-success">Month: ' . date('F', strtotime('2023-' . $currentMonth . '-01')) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th rowspan="3" style="vertical-align:middle;" class="table-success">Student name</th><th rowspan="3" style="vertical-align:middle;" class="table-success">Gender</th>';
                            echo '</tr>';

                            echo '<tr>';

                            $start = "SELECT * FROM schoolstart WHERE month = '$currentMonth' AND year = '$currentYear'";
                            $startResult = $conn->query($start);
                            $startRow = $startResult->fetch_assoc();

                            for ($i = $startRow['start_date']; $i <= $startRow['end_date']; $i++) {
                                $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

                                if ($day == 'Sat' || $day == 'Sun') {
                                    continue;
                                } else {
                                    echo '<th style="text-align:center" class="table-success">' . $i . '</th>';
                                }
                            }
                            echo '</tr>';

                            echo '<tr>';
                            // Generate headers for each weekday
                            for ($i = $startRow['start_date']; $i <= $startRow['end_date']; $i++) {
                                $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));
                                if ($day == 'Sat' || $day == 'Sun') {
                                    $weekdays++;
                                } else {
                                    echo '<th class="table-primary">' . $day . '</th>';
                                }
                            }
                            echo '</tr>';

                            while ($student = mysqli_fetch_assoc($students)) {
                                echo '<tr>';
                                echo '<td>' . $student['name'] . '<a href="add_remarks.php?id=' . $student['id'] . '"    
                                        style="text-decoration: none; font-size: 10px; margin-left: 5px;"> <i class="fa-regular fa-pen-to-square"></i> </a>
                                    </td>';

                                echo '<td style="text-align:center;">' . $student['sex'] . '</td>';

                                for ($i = $startRow['start_date']; $i <= $startRow['end_date']; $i++) {
                                    $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

                                    if ($day == 'Sat' || $day == 'Sun') {
                                        continue;
                                    } else {
                                        // Check if a record exists in the database for the current student and day
                                        $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM sf2 WHERE student_id = ? AND day = ? AND attendance_month = ?");
                                        $checkRecordStmt->bind_param("isi", $student['id'], $i, $currentMonth);
                                        $checkRecordStmt->execute();
                                        $checkRecordStmt->store_result();
                                        $checkRecordStmt->bind_result($recordCount);
                                        $checkRecordStmt->fetch();

                                        echo '<td style="text-align: center;">';
                                        echo '<input type="checkbox" name="attendance[' . $student['id'] . '][' . $i . ']" onchange="deleteAttendance(' . $student['id'] . ', ' . $i . ', ' . $currentMonth . ', this)" ' . ($recordCount > 0 ? 'checked' : '') . '>';
                                        echo '</td>';

                                        $checkRecordStmt->free_result();
                                        $checkRecordStmt->close();
                                    }
                                }

                                echo '</tr>';
                            }

                            echo '</table>';

                            ?>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="add_student">Save</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function deleteAttendance(studentId, day, month, checkbox) {
            if (checkbox.checked) {
                // If the checkbox is checked, do nothing (no confirmation needed)
                return;
            }

            if (!confirm("Are you sure you want to delete this attendance record?")) {
                // If the user cancels the confirmation, re-check the checkbox
                checkbox.checked = true;
                return;
            }

            // Perform AJAX request to delete the record
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle any response or update UI as needed
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "delete_attendance.php?delete_attendance=true&student_id=" + studentId + "&day=" + day + "&month=" + month, true);
            xhttp.send();
        }
    </script>

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
$conn->close();
