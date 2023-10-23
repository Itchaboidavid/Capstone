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
    <title>DASHBOARD</title>
</head>

<body id="up">
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3">
                <div class="container p-4 text-center px-5">
                    <div class="row d-flex justify-content-evenly align-items-center border rounded-4 bg-dark-subtle" style="box-shadow: 1px 1px 5px black;">
                        <div class="col">
                            <h1 style="text-shadow: 1px 1px 1px;" class="fw-bold"><span class="text-primary" style="font-size: 60px; text-shadow: 2px 2px 3px black;">Tagaytay City</span><br>National High School - Integrated High School</h1>
                            <p style="font-size:10px;">SY <?php echo date("Y"); ?></p>
                        </div>
                        <!-- ---------------------------------------------------------------------------------------- -->
                        <div class="col">
                            <div id="carouselExampleAutoplaying" class="carousel slide rounded rounded-5 bg-body-tertiary" data-bs-ride="carousel">
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
                <div class="container mt-5">
                    <div class="row"></div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>