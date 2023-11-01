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
                                <h3 style="text-shadow: 1px 1px 3px black;">Students</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $students = "SELECT * FROM `student`";
                                $studentsResult = $conn->query($students);
                                $studentsCount = $studentsResult->num_rows;
                                ?>
                                <span class="fs-1" style="text-shadow: 1px 1px 3px black;"><?php echo $studentsCount ?></span>
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
                                <i class="fa-solid fa-chart-simple me-1"></i>
                                Subject Chart
                            </div>
                            <div class="card-body"><canvas id="subjectChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fa-solid fa-chart-pie me-1"></i>
                                Section Chart
                            </div>
                            <div class="card-body"><canvas id="sectionChart" width="100%" height="40"></canvas></div>
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
    //SECTION CHART
    var xValues = ["Grade 11", "Grade 12"];
    var yValues = [<?php echo $rowG11 ?>, <?php echo $rowG12 ?>];
    var barColors = ["#003049", "#d62828"];
    const sectionChart = new Chart("sectionChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: true,
            },
            title: {
                display: true,
                text: "Section Chart"
            }
        }
    });

    //SUBJECT CHART
    var xValues = ["Grade 11", "Grade 12"];
    var yValues = [<?php echo $subjectRowG11 ?>, <?php echo $subjectRowG12 ?>];
    var barColors = ["#003049", "#d62828"];
    const subjectChart = new Chart("subjectChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: true,
            },
            title: {
                display: true,
                text: "Subject Chart"
            }
        }
    });
</script>