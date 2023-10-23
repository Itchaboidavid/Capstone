<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/fb9a379660.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../index.css">
    <script src="../index.js"></script>


    <!-- DATA TABLES -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <script defer src="data_table.js"></script>

    <!-- CHART -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

    <title>ADMIN</title>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation_old.php") ?>
            <!-- CONTENT -->
            <main>
                <div class="container py-4 text-center px-5">
                    <div class="row d-flex justify-content-evenly align-items-center border rounded-4 bg-dark-subtle" style="box-shadow: 1px 1px 5px black;">
                        <div class="col">
                            <h1 style="text-shadow: 1px 1px 1px;" class="fw-bold"><span class="text-primary" style="font-size: 60px; text-shadow: 2px 2px 3px black;">Tagaytay City</span><br>National High School - Integrated High School</h1>
                        </div>
                        <!-- ---------------------------------------------------------------------------------------- -->
                        <div class="col">
                            <div id="carouselExampleAutoplaying" class="carousel slide rounded rounded-5 bg-body-tertiary carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner rounded rounded-5 p-3 bg-dark-subtle">
                                    <div class="carousel-item active" data-bs-interval="2500">
                                        <img src="../images/tc.jpg" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="TCNHS">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2500">
                                        <img src="../images/tc2.jpg" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="Teachers of TCNHS">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2500">
                                        <img src="../images/dashboard_students.png" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="Teachers of TCNHS">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2500">
                                        <img src="../images/dashboard_award.png" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="Teachers of TCNHS">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2500">
                                        <img src="../images/family.png" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="Teachers of TCNHS">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="2500">
                                        <img src="../images/mass.png" style="height: 250px; width:100%;" class="d-block rounded rounded-5" alt="Teachers of TCNHS">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row p-5">
                        <!-- SECTION CHART -->
                        <canvas id="sectionChart" class="col-6 pb-3" style="max-width: 50%; border-bottom: 1px solid black;"></canvas>
                        <canvas id="subjectChart" class="col-6 pb-3" style="max-width: 50%; border-bottom: 1px solid black; border-left: 1px solid black;"></canvas>
                        <canvas id="userChart" class="col"></canvas>
                        <?php
                        $sectionG11 = "SELECT * FROM `section` WHERE `grade` = '11'";
                        $resultG11 = mysqli_query($conn, $sectionG11);
                        $rowG11 = mysqli_num_rows($resultG11);

                        $sectionG12 = "SELECT * FROM `section` WHERE `grade` = '12'";
                        $resultG12 = mysqli_query($conn, $sectionG12);
                        $rowG12 = mysqli_num_rows($resultG12);

                        $subjectG11 = "SELECT * FROM `subject` WHERE `grade` = '11'";
                        $resultSubjectG11 = mysqli_query($conn, $subjectG11);
                        $rowSubjectG11 = mysqli_num_rows($resultSubjectG11);

                        $subjectG12 = "SELECT * FROM `subject` WHERE `grade` = '12'";
                        $resultSubjectG12 = mysqli_query($conn, $subjectG12);
                        $rowSubjectG12 = mysqli_num_rows($resultSubjectG12);

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
                        ?>

                        <script>
                            //SECTION CHART
                            var xValues = ["Grade 11", "Grade 12"];
                            var yValues = [<?php echo $rowG11 ?>, <?php echo $rowG12 ?>];
                            var barColors = ["#003049", "#ba181b"];
                            const sectionChart = new Chart("sectionChart", {
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
                                        text: "Section Chart"
                                    }
                                }
                            });

                            //SUBJECT CHART
                            var xValues = ["Grade 11", "Grade 12"];
                            var yValues = [<?php echo $rowSubjectG11 ?>, <?php echo $rowG12 ?>];
                            var barColors = ["#003049", "#ba181b"];
                            new Chart("subjectChart", {
                                type: "pie",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Subject Chart"
                                    }
                                }
                            });

                            //USER CHART
                            var xValues = ["Adviser", "Registrar", "HR", "CLINIC"];
                            var yValues = [<?php echo $adviserCount ?>, <?php echo $registrarCount ?>, <?php echo $hrCount ?>, <?php echo $clinicCount ?>, ];
                            var barColors = ["#b91d47", "#00aba9", "#2b5797", "#1e7145"];
                            new Chart("userChart", {
                                type: "doughnut",
                                data: {
                                    labels: xValues,
                                    datasets: [{
                                        backgroundColor: barColors,
                                        data: yValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "User Chart"
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>