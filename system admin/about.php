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
    <title>About us</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
            <div class="container">
                <div class="row g-4 p-3">
                    <div class="col-3">
                        <div class="card" style="width: 16rem;">
                            <img src="../profile_pic/" class="card-img-top" style="height: 250px;" alt="Arcie's Profile">
                            <div class="card-body">
                                <h5 class="card-title">Arcie Marie C. Natuel</h5>
                                <p class="card-text fs-6">
                                    Arcie Marie C. Natuel, born on January 20, 2002, in Sta. Cruz, Manila, is an IT student at City College of Tagaytay. She is passionate about expanding her knowledge and skills in the evolving field of Information Technology.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 16rem;">
                            <img src="../profile_pic/jerome.jpg" class="card-img-top" style="height: 250px;" alt="Jerome's Profile">
                            <div class="card-body">
                                <h5 class="card-title">Jerome Jose</h5>
                                <p class="card-text">
                                    Jerome Jose, an IT student at City College of Tagaytay, balances his love for computers with a passion for motorcycles, finding excitement in both digital complexities and the thrill of the open road.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 16rem;">
                            <img src="../profile_pic/daryl.jpg" class="card-img-top" style="height: 250px;" alt="Daryl's Profile">
                            <div class="card-body">
                                <h5 class="card-title">Daryl Balbastro</h5>
                                <p class="card-text">
                                    Wynn Daryl Balbastro, an IT student with a strong foundation in PHP, HTML, and Visual Basic. Continually expanding my skills in cybersecurity, network administration, and database management.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card" style="width: 16rem;">
                            <img src="../profile_pic/david_profile.jpg" class="card-img-top" style="height: 250px;" alt="David's Profile">
                            <div class="card-body">
                                <h5 class="card-title">David Centeno</h5>
                                <p class="card-text">
                                    David N. Centeno, 23, is an IT student at City College of Tagaytay. He is dedicated to expanding his skills in the evolving tech field and has a love for animals, reflecting his compassionate and curious nature.
                                </p>
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
    <script src="../index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>

<?php
if (isset($_POST["add_sy"])) {
    $currentYear = date("Y");

    $start_year = $conn->real_escape_string($_POST['start_year']);
    $end_year = $conn->real_escape_string($_POST['end_year']);
    $sy = $start_year . " - " . $end_year;

    if ($start_year < $currentYear) {
        echo ("<script>location.href = 'sy_table.php?errmsg=The school year must be current or up to date.';</script>");
        exit();
    }

    if ($end_year < $start_year) {
        echo ("<script>location.href = 'sy_table.php?errmsg=The end of school year must be greater than the start of school year.';</script>");
        exit();
    }

    $select = "SELECT * FROM `school_year` WHERE `start_year` = '$start_year' AND end_year = '$end_year'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'sy_table.php?errmsg=The school year already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `school_year`(`start_year`, `end_year`, `sy`) VALUES ('$start_year','$end_year','$sy')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'sy_table.php?msg=School year successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>