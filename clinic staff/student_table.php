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
    <title>Student</title>
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
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mt-0">
                    <div>
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Student table</li>
                        </ol>
                    </div>
                </div>
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">'
                        . $msg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }

                if (isset($_GET['errmsg'])) {
                    $errmsg = $_GET['errmsg'];
                    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">'
                        . $errmsg .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                }
                ?>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Student table
                        </div>
                        <a href="sf8.php" style="border: none; background: transparent;" target="_blank">
                            <i class="fa-solid fa-print"></i>
                        </a>

                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Section</th>
                                    <th>LRN</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <!-- <th>Weight (kg)</th>
                                    <th>Height (m)</th>
                                    <th>Height<sup>2</sup> (m<sup>2</sup>)</th> -->
                                    <th>BMI<br>(kg/m<sup>2</sup>)</th>
                                    <th>BMI<br>Category</th>
                                    <th>Height for Age <br>(HFA)</th>
                                    <th>HFA<br>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $clinicSection = $_SESSION['section'];
                                $student = "SELECT * FROM `student` WHERE `section` = '$clinicSection'";
                                $studentResult = $conn->query($student);
                                while ($studentRow = $studentResult->fetch_assoc()) :
                                    $studentName = $studentRow['name'];
                                    $sf8 = "SELECT * FROM `sf8` WHERE `name` = '$studentName'";
                                    $sf8Result = $conn->query($sf8);
                                ?>
                                    <tr>
                                        <td><?php echo $studentRow["id"] ?></td>
                                        <td><?php echo $studentRow["section"] ?></td>
                                        <td><?php echo $studentRow["lrn"] ?></td>
                                        <td><?php echo $studentRow["name"] ?></td>
                                        <td><?php echo $studentRow["age"] ?></td>
                                        <td><?php echo $studentRow["sex"] ?></td>
                                        <td><?php echo $studentRow["bmi"] ?></td>
                                        <td><?php echo $studentRow["bmi_category"] ?></td>
                                        <td><?php echo $studentRow["hfa"] ?></td>
                                        <td><?php echo $studentRow["hfa_category"] ?></td>
                                        <td>
                                            <a href="add_bmi.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent; text-decoration:none;" class="text-success me-1">
                                                <i class="fa-solid fa-plus"></i>
                                            </a>
                                            <a href="edit_student.php?id=<?php echo $studentRow['id'] ?>" style="border: none; background: transparent;">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
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
if (isset($_POST["add_bmi"])) {
    $lrn = mysqli_real_escape_string($conn, $_POST["lrn"]);
    $student = "SELECT * FROM `student` WHERE `lrn` = '$lrn'";
    $studentResult = $conn->query($student);
    $studentRow = $studentResult->fetch_assoc();
    $name = $studentRow['name'];
    $birth_date = $studentRow['birth_date'];
    $age = $studentRow['age'];
    $section = $studentRow['section'];
    $sex = $studentRow['sex'];
    $weight = floatval($_POST["weight"]);
    $height = floatval($_POST["height"]);
    $height2 = $height * $height;
    $bmi = $weight / $height2;

    if ($bmi <= 16.5) {
        $bmi_category = "Severly wasted";
    } elseif ($bmi < 18.5) {
        $bmi_category = "Wasted";
    } elseif ($bmi <= 24.9) {
        $bmi_category = "Normal";
    } elseif ($bmi <= 29.9) {
        $bmi_category = "Overweight";
    } elseif ($bmi >= 30.0) {
        $bmi_category = "Obese";
    };

    $select = "SELECT * FROM `sf8` WHERE `lrn` = '$lrn'";
    $result = $conn->query($select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'student_table.php?errmsg=The student already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `sf8`(`lrn`, `name`, `birth_date`, `age`, `weight`, `height`, `height2`, `bmi`, `bmi_category`, `hfa`, `section`, `sex`) VALUES ('$lrn','$name','$birth_date','$age','$weight','$height','$height2','$bmi','$bmi_category','$hfa','$section','$sex')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'student_table.php?msg=Student successfully added!';</script>");
        exit();
    }
}
$conn->close();
?>