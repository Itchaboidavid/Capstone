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
    <title>Admin Dashboard</title>
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
                            <div class="card-header text-center">
                                <h3 style="text-shadow: 1px 1px 3px black;">Faculty</h3>
                            </div>
                            <div class="card-body text-center p-0">
                                <?php
                                $faculty = "SELECT * FROM `user`";
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
                            <div class="card-header text-center">
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
                            <div class="card-header text-center">
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
                            <div class="card-header text-center">
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
                                Faculty Chart
                            </div>
                            <div class="card-body"><canvas id="facultyChart" width="100%" height="40"></canvas></div>
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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable Example
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                </tr>
                                <tr>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; All rights reserved 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
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
?>
<script>
    //USER CHART
    var xValues = ["Adviser", "Registrar", "HR", "Clinic"];
    var yValues = [<?php echo $adviserCount ?>, <?php echo $registrarCount ?>, <?php echo $hrCount ?>, <?php echo $clinicCount ?>];
    var barColors = ["#003049", "#d62828", "#f77f00", "#5f0f40"];
    const facultyChart = new Chart("facultyChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: "Faculty Chart"
            }
        }
    });

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
</script>