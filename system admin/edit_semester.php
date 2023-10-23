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
    <title>EDIT SEMESTER</title>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3 pb-0">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h2>Update Semester</h2>
                    </div>
                    <?php
                    $id = $_GET["id"];
                    $select = "SELECT * FROM semester WHERE id = $id";
                    $result = mysqli_query($conn, $select);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card-body">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $row["name"] ?>" required />
                                <label for="name">Semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a semester.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="start_year" id="start_year" placeholder="start_year" class="form-control bg-body-tertiary" maxlength="4" value="<?php echo $row["start_year"] ?>" required />
                                <label for="start_year">Beginning year of the semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a year.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="end_year" id="end_year" placeholder="end_year" class="form-control bg-body-tertiary" maxlength="4" value="<?php echo $row["end_year"] ?>" required />
                                <label for="end_year">End year of the semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a year.</div>
                            </div>
                            <div class="mt-4 me-auto">
                                <input type="submit" value="Update" class="btn btn-primary" name="submit">
                                <a href="section_table.php" class="btn btn-danger">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>
</body>

</html>
<?php
ob_start();
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $start_year = mysqli_real_escape_string($conn, $_POST["start_year"]);
    $end_year = mysqli_real_escape_string($conn, $_POST["end_year"]);
    $output = $name . " (" . $start_year . " - " . $end_year . ")";

    $update = "UPDATE `semester` SET `name`='$name',`start_year`='$start_year',`end_year`='$end_year',`output`='$output' WHERE `id` = $id";
    $result = mysqli_query($conn, $update);

    if ($result) {
        echo ("<script>location.href = 'semester_table.php?msg=Semester updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'semester_table.php?errmsg=Semester updating unsuccessful.';</script>");
        exit();
    }
}
ob_end_flush();
?>