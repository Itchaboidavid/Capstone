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
    <title>Edit Section</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>

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

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Section</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="section_table.php">Section Table</a></li>
                            <li class="breadcrumb-item active">Edit Section</li>
                        </ol>
                    </div>
                </div>
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Section</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $section = "SELECT * FROM `section` WHERE id = $id";
                            $sectionResult = $conn->query($section);
                            $sectionRow = $sectionResult->fetch_assoc();
                            ?>
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $sectionRow["name"] ?>" required />
                                <label for="name">Name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a name.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="track" id="track1">
                                    <option value="<?php echo $sectionRow["track"] ?>" selected><?php echo $sectionRow["track"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM track ORDER BY `name` ASC";
                                    $result = mysqli_query($conn, $select);
                                    while ($sectionRowTrack = mysqli_fetch_assoc($result)) {
                                        if ($sectionRowTrack["name"] != "All") {
                                    ?>
                                            <option value="<?php echo $sectionRowTrack["name"] ?>"><?php echo $sectionRowTrack["name"] ?></option>
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
                                    <option value="<?php echo $sectionRow["strand"] ?>" selected><?php echo $sectionRow["strand"] ?></option>
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
                                $sectionRow = mysqli_fetch_assoc($result);
                                ?>
                                <select class="form-select" name="grade" id="grade">
                                    <option value="11" <?php echo ($sectionRow['grade'] == '11') ? "selected" : ""; ?>>11</option>
                                    <option value="12" <?php echo ($sectionRow['grade'] == '12') ? "selected" : ""; ?>>12</option>
                                </select>
                                <label for="grade">grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the grade.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="semester" id="semester">
                                    <option value="<?php echo $sectionRow["semester"] ?>" selected><?php echo $sectionRow["semester"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM `semester` ORDER BY output ASC";
                                    $result = mysqli_query($conn, $select);
                                    while ($semesterRow = mysqli_fetch_assoc($result)) {
                                        if ($sectionRow['semester'] != $semesterRow['output']) {

                                    ?>
                                            <option value="<?php echo $semesterRow["id"] ?>"><?php echo $semesterRow["output"] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="semester">semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a semester.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_section">Save</button>
                                <a href="section_table.php" type="button" class="btn btn-danger">Close</a>
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
//EDIT STRAND
if (isset($_POST['edit_section'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $strand = mysqli_real_escape_string($conn, $_POST["strand"]);

    $forTrack = "SELECT * FROM `strand` WHERE `name` = '$strand'";
    $forTrackResult = $conn->query($forTrack);
    $forTrackRow = $forTrackResult->fetch_assoc();
    $track = $forTrackRow['track'];
    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);
    $faculty = mysqli_real_escape_string($conn, $_POST["faculty"]);
    $semester_id = mysqli_real_escape_string($conn, $_POST["semester"]);

    $select_semester = "SELECT * FROM `semester` WHERE `id` = '$semester_id'";
    $result_semester = mysqli_query($conn, $select_semester);
    $row_semester = mysqli_fetch_assoc($result_semester);

    $semester = $row_semester['output'];
    $semester_name = $row_semester["name"];
    $start_year = $row_semester["start_year"];
    $end_year = $row_semester["end_year"];
    $start_date = $row_semester["start_date"];
    $end_date = $row_semester["end_date"];

    $update = "UPDATE `section` SET `name`='$name',`track`='$track',`strand`='$strand',`grade`='$grade',`adviser`='$faculty',`semester_id`='$semester_id',`semester`='$semester',`semester_name`='$semester_name',`start_year`='$start_year',`end_year`='$end_year' WHERE id = $id";
    $result = mysqli_query($conn, $update);

    if ($result) {
        echo ("<script>location.href = 'section_table.php?msg=Section updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'section_table.php?errmsg=Section updating unsuccessful.';</script>");
        exit();
    }
}
