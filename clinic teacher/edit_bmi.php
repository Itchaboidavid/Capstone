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
    <script src="https://cdn.jsdelivr.net/npm/@sisukas/nitti@1.0.9"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
    <title>ADD BMI</title>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3">
                <?php
                $id = $_GET["id"];
                $select = "SELECT * FROM `student` WHERE `id` = '$id'";
                $result = mysqli_query($conn, $select);
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="card bg-body-secondary">
                    <div class="card-header bg-primary text-light fs-2">
                        BMI
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="needs-validation w-100 row g-1" validate>
                            <div class="form-floating mb-3 col-6 d-inline-block">
                                <input type="number" name="weight" id="weight" placeholder="weight" class="form-control bg-body-tertiary" required value="<?php echo $row["weight"] ?>" />
                                <label for="weight">Weight(kg)</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter studnet weight.</div>
                            </div>
                            <div class="form-floating mb-3 col-6 d-inline-block">
                                <input type="text" name="height" id="height" placeholder="height" class="form-control bg-body-tertiary" required value="<?php echo $row["height"] ?>" />
                                <label for="height">Height(m)</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student height.</div>
                            </div>
                            <hr>
                            <h2>HFA</h2>
                            <div class="form-floating mb-3 col-6 d-inline-block">
                                <input type="text" name="mother_height" id="mother_height" placeholder="mother_height" class="form-control bg-body-tertiary" value="<?php echo $row["mother_height"] ?>" required />
                                <label for="mother_height">Mother's Height(cm)</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student mother's height.</div>
                            </div>
                            <div class="form-floating mb-3 col-6 d-inline-block">
                                <input type="text" name="father_height" id="father_height" placeholder="father_height" class="form-control bg-body-tertiary" value="<?php echo $row["father_height"] ?>" required />
                                <label for="father_height">Father's Height(cm)</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter student father's height.</div>
                            </div>
                            <div class="me-auto">
                                <input type="submit" value="Add" class="btn btn-primary" name="submit">
                                <a type="button" class="btn btn-danger" href="student_table.php">Back</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-primary">

                    </div>
                </div>

            </main>
        </div>
    </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $height = mysqli_real_escape_string($conn, $_POST["height"]);
    $weight = mysqli_real_escape_string($conn, $_POST["weight"]);
    $height2 = $height * $height;
    $bmi = $weight / $height2;

    $mother_height = mysqli_real_escape_string($conn, $_POST["mother_height"]);
    $father_height = mysqli_real_escape_string($conn, $_POST["father_height"]);
    $parent_height = ($mother_height + $father_height) / 2;

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
    }

    $update = "UPDATE `student` SET `height`='$height',`weight`='$weight',`height2`='$height2',`bmi`='$bmi',`bmi_category`='$bmi_category',`hfa`='$float_hfa' WHERE id = $id";
    $result = mysqli_query($conn, $update);
    echo ("<script>location.href = 'student_table.php?msg=BMI & HFA updated successfully!';</script>");
    exit();
}
?>