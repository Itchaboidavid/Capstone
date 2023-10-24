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
    <title>EDIT SECTION</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#track1").change(function() {
                var track_name = $(this).val();
                $.ajax({
                    url: "dropdown.php",
                    method: "POST",
                    data: {
                        trackName: track_name
                    },
                    success: function(data) {
                        $("#strand1").html(data);
                    }
                })
            })
        })
    </script>
</head>

<body>
    <div class="container-fluid g-0">
        <div class="row flex-nowrap g-0">
            <?php include("navigation.php") ?>
            <!-- CONTENT -->
            <main class="py-4 px-3 pb-0">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h2>Update Section</h2>
                    </div>
                    <?php
                    $id = $_GET["id"];
                    $select = "SELECT * FROM section WHERE id = $id";
                    $result = mysqli_query($conn, $select);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="card-body">
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $row["name"] ?>" required />
                                <label for="name">Name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a name.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="track" id="track1">
                                    <option value="<?php echo $row["track"] ?>" selected><?php echo $row["track"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM track ORDER BY `name` ASC";
                                    $result = mysqli_query($conn, $select);
                                    while ($rowTrack = mysqli_fetch_assoc($result)) {
                                        if ($rowTrack["name"] != "All") {
                                    ?>
                                            <option value="<?php echo $rowTrack["name"] ?>"><?php echo $rowTrack["name"] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                                <label for="track1">Track</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select track.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="strand" id="strand1">
                                    <option value="<?php echo $row["strand"] ?>" selected><?php echo $row["strand"] ?></option>
                                </select>
                                <label for="strand1">Strand</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select strand.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <?php
                                $id = $_GET["id"];
                                $select = "SELECT * FROM section WHERE id = $id";
                                $result = mysqli_query($conn, $select);
                                $row = mysqli_fetch_assoc($result);
                                ?>
                                <select class="form-select" name="grade" id="grade">
                                    <option value="11" <?php echo ($row['grade'] == '11') ? "selected" : ""; ?>>11</option>
                                    <option value="12" <?php echo ($row['grade'] == '12') ? "selected" : ""; ?>>12</option>
                                </select>
                                <label for="grade">grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the grade.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="faculty" id="faculty">
                                    <option value="<?php echo $row["faculty"] ?>" selected><?php echo $row["faculty"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM user";
                                    $result = mysqli_query($conn, $select);
                                    while ($row_faculty = mysqli_fetch_assoc($result)) {
                                        if ($row_faculty["name"] != "admin") {
                                    ?>
                                            <option value="<?php echo $row_faculty["name"] ?>"><?php echo $row_faculty["name"] ?></option>
                                    <?php  }
                                    }
                                    ?>
                                </select>
                                <label for="faculty">faculty</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a faculty.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="semester" id="semester">
                                    <option value="<?php echo $row["semester"] ?>" selected><?php echo $row["semester"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM `semester`";
                                    $result = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row["output"] ?>"><?php echo $row["output"] ?></option>
                                    <?php  }
                                    ?>
                                </select>
                                <label for="semester">semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a semester.</div>
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
    $track = mysqli_real_escape_string($conn, $_POST["track"]);
    $strand = mysqli_real_escape_string($conn, $_POST["strand"]);
    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);
    $faculty = mysqli_real_escape_string($conn, $_POST["faculty"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);

    $select_semester = "SELECT * FROM `semester` WHERE `output` = '$semester'";
    $result_semester = mysqli_query($conn, $select_semester);
    $row_semester = mysqli_fetch_assoc($result_semester);

    $semester_name = $row_semester["name"];
    $start_year = $row_semester["start_year"];
    $end_year = $row_semester["end_year"];

    $update = "UPDATE `section` SET `name`='$name',`track`='$track',`strand`='$strand',`grade`='$grade',`faculty`='$faculty',`semester`='$semester',`semester_name`='$semester_name',`start_year`='$start_year',`end_year`='$end_year' WHERE id = $id";
    $result = mysqli_query($conn, $update);

    if ($result) {
        echo ("<script>location.href = 'section_table.php?msg=Section updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'section_table.php?errmsg=Section updating unsuccessful.';</script>");
        exit();
    }
}
ob_end_flush();
?>