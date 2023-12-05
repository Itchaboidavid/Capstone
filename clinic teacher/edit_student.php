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
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="student_table.php">Student Table</a></li>
                            <li class="breadcrumb-item active">Edit Student</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Student</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $select = "SELECT * FROM `student` WHERE `id` = '$id'";
                            $result = mysqli_query($conn, $select);
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="weight" id="weight" placeholder="weight" class="form-control bg-body-tertiary" value="<?php echo $row['weight'] ?>" required />
                                <label for="weight">Weight</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student's weight.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="height" id="height" placeholder="height" class="form-control bg-body-tertiary" value="<?php echo $row['height'] ?>" required />
                                <label for="height">Height</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student's height.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_bmi">Save</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php
include("functions.php");

if (isset($_POST['edit_bmi'])) {
    $weight = floatval($_POST["weight"]);
    $height = floatval($_POST["height"]);
    $age = intval($row['age']);
    $sex = $row['sex'];

    $height2 = $height * $height;
    $bmi = $weight / $height2;
    $formattedBMI = number_format($bmi, 2);

    if ($bmi <= 16.5) {
        $bmi_category = "Severely wasted";
    } elseif ($bmi < 18.5) {
        $bmi_category = "Wasted";
    } elseif ($bmi <= 24.9) {
        $bmi_category = "Normal";
    } elseif ($bmi <= 29.9) {
        $bmi_category = "Overweight";
    } elseif ($bmi >= 30.0) {
        $bmi_category = "Obese";
    };

    // Compute HFA
    $hfaInCm = $height * 100;
    $hfaZScore = computeHFAZScore($age, $hfaInCm, $sex);

    if ($hfaZScore < -2) {
        $hfaCategory = "Severely stunted";
    } elseif ($hfaZScore < -1) {
        $hfaCategory = "Stunted";
    } elseif ($hfaZScore <= 2) {
        $hfaCategory = "Normal";
    } else {
        $hfaCategory = "Tall";
    };

    $update = "UPDATE `student` SET `weight`='$weight',`height`='$height',`height2`='$height2',`bmi`='$formattedBMI',`bmi_category`='$bmi_category',`hfa_category`='$hfaCategory' WHERE `id` = '$id'";
    $updateResult = mysqli_query($conn, $update);
    echo ("<script>location.href = 'student_table.php?msg=Information updated successfully!';</script>");
    exit();
}
