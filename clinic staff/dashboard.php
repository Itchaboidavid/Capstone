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
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">Students</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $section = $_SESSION['section'];
                                $students = "SELECT * FROM `student` WHERE `section` = '$section'";
                                $studentsResult = $conn->query($students);
                                $studentsCount = $studentsResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $studentsCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="student_table.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">BMI</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $bmi = "SELECT * FROM `student` WHERE `bmi_category` != '' AND `section` = '$section'";
                                $bmiResult = $conn->query($bmi);
                                $bmiCount = $bmiResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $bmiCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="student_table.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">HFA</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $hfa = "SELECT * FROM `student` WHERE `hfa` != '' AND `section` = '$section'";
                                $hfaResult = $conn->query($hfa);
                                $hfaCount = $hfaResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $hfaCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="student_table.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CHARTS -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-pie"></i>
                                BMI Chart
                            </div>
                            <div class="card-body">
                                <div id="bmiChart" style="width:100%; height:250px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-bar"></i>
                                HFA Chart
                            </div>
                            <div class="card-body">
                                <div id="hfaChart" style="width:100%; height:250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; All rights reserved 2023</div>
                </div>
            </div>
        </footer>
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
//BMI CHART
$severe = "SELECT * FROM `student` WHERE `section` = '$section' AND `bmi_category` = 'Severly wasted'";
$severeResult = mysqli_query($conn, $severe);
$severeCount = mysqli_num_rows($severeResult);

$wasted = "SELECT * FROM `student` WHERE `section` = '$section' AND `bmi_category` = 'Wasted'";
$wastedResult = mysqli_query($conn, $wasted);
$wastedCount = mysqli_num_rows($wastedResult);

$normal = "SELECT * FROM `student` WHERE `section` = '$section' AND `bmi_category` = 'Normal'";
$normalResult = mysqli_query($conn, $normal);
$normalCount = mysqli_num_rows($normalResult);

$overweight = "SELECT * FROM `student` WHERE `section` = '$section' AND `bmi_category` = 'Overweight'";
$overweightResult = mysqli_query($conn, $overweight);
$overweightCount = mysqli_num_rows($overweightResult);

$obese = "SELECT * FROM `student` WHERE `section` = '$section' AND `bmi_category` = 'obese'";
$obeseResult = mysqli_query($conn, $obese);
$obeseCount = mysqli_num_rows($obeseResult);

//HFA CHART
$severelyStunted = "SELECT * FROM `student` WHERE `section` = '$section' AND `hfa_category` = 'Severly stunted'";
$severelyStuntedResult = mysqli_query($conn, $severelyStunted);
$severelyStuntedCount = mysqli_num_rows($severelyStuntedResult);

$stunted = "SELECT * FROM `student` WHERE `section` = '$section' AND `hfa_category` = 'Stunted'";
$stuntedResult = mysqli_query($conn, $stunted);
$stuntedCount = mysqli_num_rows($stuntedResult);

$normalHeight = "SELECT * FROM `student` WHERE `section` = '$section' AND `hfa_category` = 'Normal'";
$normalHeightResult = mysqli_query($conn, $normalHeight);
$normalHeightCount = mysqli_num_rows($normalHeightResult);

$tall = "SELECT * FROM `student` WHERE `section` = '$section' AND `hfa_category` = 'Tall'";
$tallResult = mysqli_query($conn, $tall);
$tallCount = mysqli_num_rows($tallResult);

?>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        bmiChart();
        hfaChart();
    };

    function bmiChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['Severly Wasted', <?php echo $severeCount ?>],
            ['Wasted', <?php echo $wastedCount ?>],
            ['Normal', <?php echo $normalCount ?>],
            ['Overweight', <?php echo $overweightCount ?>],
            ['Obese', <?php echo $obeseCount ?>]
        ]);

        const options = {
            title: 'BMI Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('bmiChart'));
        chart.draw(data, options);
    };

    function hfaChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['Severly Stunted', <?php echo $severelyStuntedCount ?>],
            ['Stunted', <?php echo $stuntedCount ?>],
            ['Normal', <?php echo $normalHeightCount ?>],
            ['Tall', <?php echo $tallCount ?>],
        ]);

        const options = {
            title: 'HFA Chart'
        };

        const chart = new google.visualization.BarChart(document.getElementById('hfaChart'));
        chart.draw(data, options);
    };
</script>