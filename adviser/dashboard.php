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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <?php
                    $id = $_SESSION['id'];
                    $advised = "SELECT * FROM user WHERE id = '$id'";
                    $advisedResult = $conn->query($advised);
                    $advisedRow = $advisedResult->fetch_assoc();

                    if ($advisedRow['section'] != "") {
                    ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-header">
                                    <h4 style="text-shadow: 1px 1px 3px black;">
                                        <?php
                                        $sectionName = $advisedRow['section'];
                                        $section = "SELECT * FROM section WHERE name = '$sectionName'";
                                        $sectionResult = $conn->query($section);
                                        $sectionRow = $sectionResult->fetch_assoc();

                                        echo $sectionRow['name'] . " - " . $sectionRow['grade'];
                                        ?>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <span style="text-shadow: 1px 1px 3px black;" class="fs-6">
                                        <?php
                                        $lalaki = "SELECT * FROM student WHERE section = '$sectionName' AND sex = 'M'";
                                        $lalakiResult = $conn->query($lalaki);
                                        $lalakiCount = $lalakiResult->num_rows;

                                        $babae = "SELECT * FROM student WHERE section = '$sectionName' AND sex = 'F'";
                                        $babaeResult = $conn->query($babae);
                                        $babaeCount = $babaeResult->num_rows;
                                        echo 'Male : ' . $lalakiCount . '<br>';
                                        echo 'Female : ' . $babaeCount . '<br>';
                                        echo 'Total students : ' . $lalakiCount + $babaeCount;
                                        ?>
                                    </span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="student_table.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else { ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-header">
                                    <h4 style="text-shadow: 1px 1px 3px black;">No Class Advisory</h4>
                                </div>
                                <div class="card-body text-center p-0">
                                    <span class="fs-6" style="text-shadow: 1px 1px 3px black;">0</span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="student_table.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-header">
                                <h4 style="text-shadow: 1px 1px 3px black;"><?php echo $currentMonth = date('F'); ?> Attendance</h4>
                            </div>
                            <div class="card-body">
                                <?php
                                $currentMonth = date('m');
                                $section = $_SESSION['section'];
                                $attendance = "SELECT * FROM sf2 WHERE `student_section` = '$section' AND attendance_month = '$currentMonth'";
                                $attendanceResult = $conn->query($attendance);
                                $attendanceCount = $attendanceResult->num_rows;
                                ?>
                                <span class="fs-6" style="text-shadow: 1px 1px 3px black;">Total attendance for this month : <?php echo $attendanceCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="sf2.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CHARTS -->
                <div class="row">
                    <div class="col-xl-5">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-pie"></i>
                                Gender Chart
                            </div>
                            <div class="card-body">
                                <div id="genderChart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-bar"></i>
                                S.Y Attendance Chart
                            </div>
                            <div class="card-body">
                                <div id="attendanceChart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
$section = $advisedRow['section'];
$students = "SELECT * FROM `student` WHERE `section` = '$section'";
$studentsResult = $conn->query($students);
$studentsCount = $studentsResult->num_rows;

if ($studentsCount > 0) {
    //GENDER CHART
    $male = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'M'";
    $maleResult = $conn->query($male);
    $maleCount = $maleResult->num_rows;

    $female = "SELECT * FROM `student` WHERE `section` = '$section' AND `sex` = 'F'";
    $femaleResult = $conn->query($female);
    $femaleCount = $femaleResult->num_rows;

    //HFA CHART
    $january = "SELECT * FROM sf2 WHERE attendance_month = '1' AND student_section = '$section'";
    $januaryResult = $conn->query($january);
    $januaryCount = $januaryResult->num_rows;

    $february = "SELECT * FROM sf2 WHERE attendance_month = '2' AND student_section = '$section'";
    $februaryResult = $conn->query($february);
    $februaryCount = $februaryResult->num_rows;

    $march = "SELECT * FROM sf2 WHERE attendance_month = '3' AND student_section = '$section'";
    $marchResult = $conn->query($march);
    $marchCount = $marchResult->num_rows;

    $april = "SELECT * FROM sf2 WHERE attendance_month = '4' AND student_section = '$section'";
    $aprilResult = $conn->query($april);
    $aprilCount = $aprilResult->num_rows;

    $may = "SELECT * FROM sf2 WHERE attendance_month = '5' AND student_section = '$section'";
    $mayResult = $conn->query($may);
    $mayCount = $mayResult->num_rows;

    $june = "SELECT * FROM sf2 WHERE attendance_month = '6' AND student_section = '$section'";
    $juneResult = $conn->query($june);
    $juneCount = $juneResult->num_rows;

    $july = "SELECT * FROM sf2 WHERE attendance_month = '7' AND student_section = '$section'";
    $julyResult = $conn->query($july);
    $julyCount = $julyResult->num_rows;

    $august = "SELECT * FROM sf2 WHERE attendance_month = '8' AND student_section = '$section'";
    $augustResult = $conn->query($august);
    $augustCount = $augustResult->num_rows;

    $september = "SELECT * FROM sf2 WHERE attendance_month = '9' AND student_section = '$section'";
    $septemberResult = $conn->query($september);
    $septemberCount = $septemberResult->num_rows;

    $october = "SELECT * FROM sf2 WHERE attendance_month = '10' AND student_section = '$section'";
    $octoberResult = $conn->query($october);
    $octoberCount = $octoberResult->num_rows;

    $november = "SELECT * FROM sf2 WHERE attendance_month = '11' AND student_section = '$section'";
    $novemberResult = $conn->query($november);
    $novemberCount = $novemberResult->num_rows;

    $december = "SELECT * FROM sf2 WHERE attendance_month = '12' AND student_section = '$section'";
    $decemberResult = $conn->query($december);
    $decemberCount = $decemberResult->num_rows;
} else {
    $maleCount = 0;
    $femaleCount = 0;
    $januaryCount = 0;
    $februaryCount = 0;
    $marchCount = 0;
    $aprilCount = 0;
    $mayCount = 0;
    $juneCount = 0;
    $julyCount = 0;
    $augustCount = 0;
    $septemberCount = 0;
    $octoberCount = 0;
    $novemberCount = 0;
    $decemberCount = 0;
}
?>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        genderChart();
        attendanceChart();
    };

    function genderChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['Male', <?php echo $maleCount ?>],
            ['Female', <?php echo $femaleCount ?>],
        ]);

        const options = {
            title: 'Gender Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('genderChart'));
        chart.draw(data, options);
    };

    function attendanceChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['January', <?php echo $januaryCount ?>],
            ['February', <?php echo $februaryCount ?>],
            ['March', <?php echo $marchCount ?>],
            ['April', <?php echo $aprilCount ?>],
            ['May', <?php echo $mayCount ?>],
            ['June', <?php echo $juneCount ?>],
            ['July', <?php echo $julyCount ?>],
            ['August', <?php echo $augustCount ?>],
            ['September', <?php echo $septemberCount ?>],
            ['October', <?php echo $octoberCount ?>],
            ['November', <?php echo $novemberCount ?>],
            ['December', <?php echo $decemberCount ?>],
        ]);

        const options = {
            title: 'HFA Chart'
        };

        const chart = new google.visualization.BarChart(document.getElementById('attendanceChart'));
        chart.draw(data, options);
    };
</script>