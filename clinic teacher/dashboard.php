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
                                <h4 style="text-shadow: 1px 1px 3px black;">Sections</h4>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $sy = "SELECT * FROM school_year WHERE is_archived = 0";
                                $syResult = $conn->query($sy);
                                if ($syResult->num_rows > 0) {
                                    $syRow = $syResult->fetch_assoc();
                                    $syID = $syRow['id'];

                                    $section = "SELECT * FROM `section` WHERE is_archived = 0 AND school_year_id = '$syID'";
                                    $sectionResult = $conn->query($section);
                                    $sectionCount = $sectionResult->num_rows; ?>
                                    <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $sectionCount ?></span>
                                <?php }
                                ?>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="section_table.php">View Details</a>
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
$severe = "SELECT * FROM `student` WHERE `bmi_category` = 'Severly wasted' AND is_archived = 0";
$severeResult = mysqli_query($conn, $severe);
$severeCount = mysqli_num_rows($severeResult);

$wasted = "SELECT * FROM `student` WHERE `bmi_category` = 'Wasted' AND is_archived = 0";
$wastedResult = mysqli_query($conn, $wasted);
$wastedCount = mysqli_num_rows($wastedResult);

$normal = "SELECT * FROM `student` WHERE `bmi_category` = 'Normal' AND is_archived = 0";
$normalResult = mysqli_query($conn, $normal);
$normalCount = mysqli_num_rows($normalResult);

$overweight = "SELECT * FROM `student` WHERE `bmi_category` = 'Overweight' AND is_archived = 0";
$overweightResult = mysqli_query($conn, $overweight);
$overweightCount = mysqli_num_rows($overweightResult);

$obese = "SELECT * FROM `student` WHERE `bmi_category` = 'obese' AND is_archived = 0";
$obeseResult = mysqli_query($conn, $obese);
$obeseCount = mysqli_num_rows($obeseResult);

//HFA CHART
$severelyStunted = "SELECT * FROM student WHERE hfa_category = 'Severely stunted' AND is_archived = 0";
$severelyStuntedResult = $conn->query($severelyStunted);
$severelyStuntedCount = $severelyStuntedResult->num_rows;

$stunted = "SELECT * FROM `student` WHERE `hfa_category` = 'Stunted' AND is_archived = 0";
$stuntedResult = mysqli_query($conn, $stunted);
$stuntedCount = mysqli_num_rows($stuntedResult);

$normalHeight = "SELECT * FROM `student` WHERE `hfa_category` = 'Normal' AND is_archived = 0";
$normalHeightResult = mysqli_query($conn, $normalHeight);
$normalHeightCount = mysqli_num_rows($normalHeightResult);

$tall = "SELECT * FROM `student` WHERE `hfa_category` = 'Tall' AND is_archived = 0";
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
            ['Contry', 'Highlight'],
            ['Severly Stunted', <?php echo $severelyStuntedCount ?>],
            ['Stunted', <?php echo $stuntedCount ?>],
            ['Normal', <?php echo $normalHeightCount ?>],
            ['Tall', <?php echo $tallCount ?>],
        ]);

        const options = {
            title: 'HFA Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('hfaChart'));
        chart.draw(data, options);
    };
</script>