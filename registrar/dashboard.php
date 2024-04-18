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
                                $syRow = $syResult->fetch_assoc();
                                $syID = $syRow['id'];

                                $section = "SELECT * FROM `section` WHERE is_archived = 0 AND school_year_id = '$syID'";
                                $sectionResult = $conn->query($section);
                                $sectionCount = $sectionResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $sectionCount ?></span>
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
                                Student Chart
                            </div>
                            <div class="card-body">
                                <div id="studentChart" style="width:100%; height:250px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-bar"></i>
                                Section Chart
                            </div>
                            <div class="card-body">
                                <div id="sectionChart" style="width:100%; height:250px;"></div>
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
//STUDENT CHART
$g11 = "SELECT * FROM `student` WHERE `grade` = '11' AND is_archived = 0 AND school_year_id = '$syID'";
$resultG11 = mysqli_query($conn, $g11);
$rowG11 = mysqli_num_rows($resultG11);

$g12 = "SELECT * FROM `student` WHERE `grade` = '12' AND is_archived = 0 AND school_year_id = '$syID'";
$resultG12 = mysqli_query($conn, $g12);
$rowG12 = mysqli_num_rows($resultG12);

//SECTION CHART
$g112 = "SELECT * FROM `section` WHERE `grade` = '11' AND is_archived = 0 AND school_year_id = '$syID'";
$resultG112 = mysqli_query($conn, $g11);
$rowG112 = mysqli_num_rows($resultG112);

$g122 = "SELECT * FROM `section` WHERE `grade` = '12' AND is_archived = 0 AND school_year_id = '$syID'";
$resultG122 = mysqli_query($conn, $g12);
$rowG122 = mysqli_num_rows($resultG122);
?>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        studentChart();
        sectionChart();
    };

    function studentChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['G11', <?php echo $rowG11 ?>],
            ['G12', <?php echo $rowG12 ?>],
        ]);

        const options = {
            title: 'Student Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('studentChart'));
        chart.draw(data, options);
    };

    function sectionChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', ''],
            ['G11', <?php echo $rowG112 ?>],
            ['G12', <?php echo $rowG122 ?>],
        ]);

        const options = {
            title: 'Section Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('sectionChart'));
        chart.draw(data, options);
    };
</script>