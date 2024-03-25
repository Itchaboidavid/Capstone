<?php
include("../config.php");
session_start();

if (isset($_POST['add_student'])) {
    $currentMonth = date('m');
    $currentYear = date('Y');

    function getStudentInfo($conn, $studentId, $currentMonth, $currentYear)
    {
        $stmt = $conn->prepare("SELECT name, section, sex, school_year_id FROM student WHERE id = ? AND is_archived = 0");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Add the month and year to the result array
        $studentInfo = $result->fetch_assoc();
        $studentInfo['month'] = $currentMonth;
        $studentInfo['year'] = $currentYear;

        return $studentInfo;
    }


    try {
        // Inside the foreach loop where you handle attendance data
        foreach ($_POST['attendance'] as $studentId => $attendanceData) {
            foreach ($attendanceData as $day => $status) {
                $currentMonth = date('m');
                $currentYear = date('Y');

                // Check if a record already exists in the database for the current student, day, and status
                $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM sf2 WHERE student_id = ? AND day = ? AND attendance_status = ? AND attendance_month = ? AND attendance_year = ?");
                $checkRecordStmt->bind_param("issss", $studentId, $day, $status, $currentMonth, $currentYear);
                $checkRecordStmt->execute();
                $checkRecordStmt->store_result();
                $checkRecordStmt->bind_result($recordCount);
                $checkRecordStmt->fetch();

                if ($recordCount == 0) {
                    // Record doesn't exist, insert a new one
                    $insertStmt = $conn->prepare("INSERT INTO sf2 (student_id, student_name, student_section, sex, school_year_id, day, attendance_status, attendance_month, attendance_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    // Get student information including school_year_id
                    $studentInfo = getStudentInfo($conn, $studentId, $currentMonth, $currentYear);

                    $insertStmt->bind_param("isssisssi", $studentId, $studentInfo['name'], $studentInfo['section'], $studentInfo['sex'], $studentInfo['school_year_id'], $day, $status, $currentMonth, $currentYear);
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
    <script>
        function checkAllCheckboxes(masterCheckbox) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="attendance"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = masterCheckbox.checked;
            });
        }

        // Existing deleteAttendance function...
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
                            <div>
                                <form id="printForm" action="sf2PDF.php" method="GET" target="_blank">
                                    <input type="hidden" name="month" id="month" value="">
                                    <input type="hidden" name="year" id="year" value="">
                                    <label for="selected_month">Month:</label>
                                    <select name="selected_month" id="selected_month">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <label for="selected_year">Year:</label>
                                    <input type="number" name="selected_year" id="selected_year" min="2020" max="2100" value="<?php echo date('Y'); ?>">
                                    <?php
                                    $sy = "SELECT * FROM school_year WHERE is_archived = 0";
                                    $syResult = $conn->query($sy);
                                    $syRow = $syResult->fetch_assoc();
                                    $school_year_id = $syRow['id'];

                                    $sectionName = $_SESSION['section'];
                                    $section = "SELECT * FROM `section` WHERE `name` = '$sectionName' AND is_archived = 0 AND school_year_id = '$school_year_id'";
                                    $sectionResult = $conn->query($section);
                                    $sectionRow = $sectionResult->fetch_assoc();

                                    $availableStudent = "SELECT * FROM student WHERE school_year_id = '$school_year_id' AND section = '$sectionName'";
                                    $availableStudentResult = $conn->query($availableStudent);
                                    if ($availableStudentResult->num_rows > 0) { ?>
                                        <button type="button" onclick="openPDF()" style="border: none; background: transparent; cursor: pointer;">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="openPDF()" style="border: none; background: transparent; cursor: pointer; display: none;">
                                            <i class="fa-solid fa-print"></i>
                                        </button>
                                    <?php }
                                    ?>

                                </form>
                            </div>

                            <script>
                                function openPDF() {
                                    var selectedMonth = document.getElementById('selected_month').value;
                                    var selectedYear = document.getElementById('selected_year').value;

                                    // Set the values of hidden input fields
                                    document.getElementById('month').value = selectedMonth;
                                    document.getElementById('year').value = selectedYear;

                                    // Get the URL with query parameters
                                    var url = 'sf2PDF.php?month=' + selectedMonth + '&year=' + selectedYear;

                                    // Open the new tab/window with the URL
                                    window.open(url, '_blank');
                                }
                            </script>


                            <!-- <a href="sf2PDF.php" style="border: none; background: transparent;" target="_blank">
                                <i class="fa-solid fa-print"></i>
                            </a> -->
                        </div>
                        <div class="card-body row g-1">
                            <?php
                            $sy = "SELECT * FROM school_year WHERE is_archived = 0";
                            $syResult = $conn->query($sy);
                            $syRow = $syResult->fetch_assoc();
                            $school_year_id = $syRow['id'];

                            $section = $_SESSION['section'];
                            // Get student information
                            $students = mysqli_query($conn, "SELECT * FROM student WHERE section = '$section' AND is_archived = 0 AND school_year_id = $school_year_id ORDER BY `sex`, `name` ASC");

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
                            echo '<td colspan="2">                            
                                    <div>
                                        <!-- Add this checkbox at the beginning of the table -->
                                        <label for="checkAll" class="fw-bold">Check all</label>
                                        <input type="checkbox" id="checkAll" onchange="checkAllCheckboxes(this)" class="ms-1">
                                    </div>
                                 </td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th rowspan="3" style="vertical-align:middle;" class="table-success">Student name</th><th rowspan="3" style="vertical-align:middle;" class="table-success">Gender</th>';
                            echo '</tr>';

                            echo '<tr>';

                            $start = "SELECT * FROM schoolstart WHERE month = '$currentMonth' AND year = '$currentYear'";
                            $startResult = $conn->query($start);
                            $startRow = $startResult->fetch_assoc();
                            if ($startResult->num_rows > 0) {
                                $start_date = $startRow['start_date'];
                                $end_date = $startRow['end_date'];
                            } else {
                                $start_date = 0;
                                $end_date = 0;
                            }

                            for ($i = $start_date; $i <= $end_date; $i++) {
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
                            for ($i = $start_date; $i <= $end_date; $i++) {
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

                                for ($i = $start_date; $i <= $end_date; $i++) {
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
