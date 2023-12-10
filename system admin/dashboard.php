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
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">Faculty</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $faculty = "SELECT * FROM `user` WHERE user_type != 'system admin'";
                                $facultyResult = $conn->query($faculty);
                                $facultyCount = $facultyResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $facultyCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="user_table.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">Sections</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $section = "SELECT * FROM `section`";
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">Strands</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $strand = "SELECT * FROM `strand`";
                                $strandResult = $conn->query($strand);
                                $strandCount = $strandResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $strandCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="strand_table.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-header">
                                <h3 style="text-shadow: 1px 1px 3px black;">Subjects</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $subject = "SELECT * FROM `subject`";
                                $subjectResult = $conn->query($subject);
                                $subjectCount = $subjectResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $subjectCount ?></span>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="subject_table.php">View Details</a>
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
                                Subject Chart
                            </div>
                            <div class="card-body">
                                <div id="subjectChart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-pie"></i>
                                Section Chart
                            </div>
                            <div class="card-body">
                                <div id="sectionChart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-bar"></i>
                                Faculty Chart
                            </div>
                            <div class="card-body">
                                <div id="facultyChart" style="width:100%; height:300px;"></div>
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
//USER CHART
$adviser = "SELECT * FROM `user` WHERE `user_type` = 'adviser'";
$adviserResult = mysqli_query($conn, $adviser);
$adviserCount = mysqli_num_rows($adviserResult);

$registrar = "SELECT * FROM `user` WHERE `user_type` = 'registrar'";
$registrarResult = mysqli_query($conn, $registrar);
$registrarCount = mysqli_num_rows($registrarResult);

$librarian = "SELECT * FROM `user` WHERE `user_type` = 'librarian'";
$librarianResult = mysqli_query($conn, $librarian);
$librarianCount = mysqli_num_rows($librarianResult);

$hr = "SELECT * FROM `user` WHERE `user_type` = 'human resources'";
$hrResult = mysqli_query($conn, $hr);
$hrCount = mysqli_num_rows($hrResult);

$clinic = "SELECT * FROM `user` WHERE `user_type` = 'clinic staff'";
$clinicResult = mysqli_query($conn, $clinic);
$clinicCount = mysqli_num_rows($clinicResult);


//SECTION CHART
$sectionG11 = "SELECT * FROM `section` WHERE `grade` = '11'";
$resultG11 = mysqli_query($conn, $sectionG11);
$rowG11 = mysqli_num_rows($resultG11);

$sectionG12 = "SELECT * FROM `section` WHERE `grade` = '12'";
$resultG12 = mysqli_query($conn, $sectionG12);
$rowG12 = mysqli_num_rows($resultG12);

//SUBJECT CHART
$subjectG11 = "SELECT * FROM `subject` WHERE `grade` = '11'";
$subjectResultG11 = mysqli_query($conn, $subjectG11);
$subjectRowG11 = mysqli_num_rows($subjectResultG11);

$subjectG12 = "SELECT * FROM `subject` WHERE `grade` = '12'";
$subjectResultG12 = mysqli_query($conn, $subjectG12);
$subjectRowG12 = mysqli_num_rows($subjectResultG12);
?>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        subjectChart();
        sectionChart();
        facultyChart()
    };

    function subjectChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['G11', <?php echo $subjectRowG11 ?>],
            ['G12', <?php echo $subjectRowG12 ?>],
        ]);

        const options = {
            title: 'Subject Chart',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('subjectChart'));
        chart.draw(data, options);
    };

    function sectionChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['G11', <?php echo $rowG11 ?>],
            ['G12', <?php echo $rowG12 ?>],
        ]);

        const options = {
            title: 'Section Chart'
        };

        const chart = new google.visualization.PieChart(document.getElementById('sectionChart'));
        chart.draw(data, options);
    };

    function facultyChart() {
        const data = google.visualization.arrayToDataTable([
            ['Contry', 'Mhl'],
            ['Class Adviser', <?php echo $adviserCount ?>],
            ['Clinic Teacher', <?php echo $clinicCount ?>],
            ['Registrar', <?php echo $registrarCount ?>],
        ]);

        const options = {
            title: 'User Chart'
        };

        const chart = new google.visualization.BarChart(document.getElementById('facultyChart'));
        chart.draw(data, options);
    };
</script>