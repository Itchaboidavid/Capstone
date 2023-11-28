<?php
include("../config.php");
session_start();

if (isset($_POST['add_student'])) {
    function getStudentInfo($conn, $studentId)
    {
        $stmt = $conn->prepare("SELECT name, section, sex FROM student WHERE id = ?");
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    try {
        foreach ($_POST['attendance'] as $studentId => $attendanceData) {
            foreach ($attendanceData as $day => $status) {
                // Check if a record already exists in the database for the current student, day, and status
                $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM sf2 WHERE student_id = ? AND day = ? AND attendance_status = ?");
                $checkRecordStmt->bind_param("iss", $studentId, $day, $status);
                $checkRecordStmt->execute();
                $checkRecordStmt->store_result();
                $checkRecordStmt->bind_result($recordCount);
                $checkRecordStmt->fetch();

                if ($recordCount == 0) {
                    // Record doesn't exist, insert a new one
                    $insertStmt = $conn->prepare("INSERT INTO sf2 (student_id, student_name, student_section, sex, day, attendance_status) VALUES (?, ?, ?, ?, ?, ?)");
                    $studentInfo = getStudentInfo($conn, $studentId);
                    $insertStmt->bind_param("isssss", $studentId, $studentInfo['name'], $studentInfo['section'], $studentInfo['sex'], $day, $status);
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
                            <li class="breadcrumb-item active">Add SF 2</li>
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
                        <div class="card-header">
                            <h4>School Form 2</h4>
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
                            echo '<table class="table table-sm border table-striped">';
                            echo '<tr>';
                            echo '<td class="fw-bold">Month: ' . date('F', strtotime('2023-' . $currentMonth . '-01')) . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th rowspan="3" style="vertical-align:middle;">Student name</th><th rowspan="3" style="vertical-align:middle;">Gender</th>';
                            echo '</tr>';

                            echo '<tr>';
                            for ($i = 1; $i <= $daysInMonth; $i++) {
                                $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

                                if ($day == 'Sat' || $day == 'Sun') {
                                    continue;
                                } else {
                                    echo '<th style="text-align:center">' . $i . '</th>';
                                }
                            }
                            echo '</tr>';

                            echo '<tr>';
                            // Generate headers for each weekday
                            for ($i = 1; $i <= $weekdays; $i++) {
                                $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));
                                if ($day == 'Sat' || $day == 'Sun') {
                                    $weekdays++;
                                } else {
                                    echo '<th>' . $day . '</th>';
                                }
                            }
                            echo '</tr>';

                            while ($student = mysqli_fetch_assoc($students)) {
                                echo '<tr>';
                                echo '<td>' . $student['name'] . '</td>';
                                echo '<td style="text-align:center;">' . $student['sex'] . '</td>';

                                for ($i = 1; $i <= $daysInMonth; $i++) {
                                    $day = date('D', strtotime($currentYear . '-' . $currentMonth . '-' . $i));

                                    if ($day == 'Sat' || $day == 'Sun') {
                                        continue;
                                    } else {
                                        // Check if a record exists in the database for the current student and day
                                        $checkRecordStmt = $conn->prepare("SELECT COUNT(*) FROM sf2 WHERE student_id = ? AND day = ?");
                                        $checkRecordStmt->bind_param("is", $student['id'], $i);
                                        $checkRecordStmt->execute();
                                        $checkRecordStmt->store_result();
                                        $checkRecordStmt->bind_result($recordCount);
                                        $checkRecordStmt->fetch();

                                        echo '<td style="text-align: center;">';
                                        echo '<input type="checkbox" name="attendance[' . $student['id'] . '][' . $i . ']" ' . ($recordCount > 0 ? 'checked' : '') . '>';
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
