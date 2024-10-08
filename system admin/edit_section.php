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
                                <label for="grade">Grade level</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the grade.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="strand" id="strand" required>
                                    <option value="<?php echo $sectionRow["strand"] ?>" selected><?php echo $sectionRow["strand"] ?></option>
                                    <?php
                                    $selected = $sectionRow["strand"];
                                    $strand = "SELECT * FROM `strand` WHERE name != '$selected'";
                                    $strandResult = $conn->query($strand);
                                    while ($strandRow = $strandResult->fetch_assoc()) :
                                        if ($strandRow['name'] != 'All') :
                                    ?>
                                            <option value="<?php echo $strandRow['name'] ?>"><?php echo $strandRow['name'] ?></option>
                                    <?php
                                        endif;
                                    endwhile;
                                    ?>
                                </select>
                                <label for="strand">Strand</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select strand.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="faculty" id="faculty" placeholder="faculty" required>
                                    <option value="<?php echo $sectionRow["adviser_id"] ?>" selected><?php echo $sectionRow["adviser"] ?></option>
                                    <?php
                                    $select = "SELECT * FROM `user` WHERE user_type = 'adviser' AND section = ''";
                                    $result = mysqli_query($conn, $select);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <label for="faculty">Class Adviser</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a class adviser.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control bg-body-tertiary" name="sy" id="sy" value="<?php echo $sectionRow["school_year"] ?>" readonly>
                                <label for="sy">School year</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select school year.</div>
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

    //To get track
    $forTrack = "SELECT * FROM `strand` WHERE `name` = '$strand'";
    $forTrackResult = $conn->query($forTrack);
    $forTrackRow = $forTrackResult->fetch_assoc();
    $track = $forTrackRow['track'];

    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);

    //Adviser ID
    $facultyID = mysqli_real_escape_string($conn, $_POST["faculty"]);
    $faculty = "SELECT * FROM user WHERE id = '$facultyID'";
    $facultyResult = $conn->query($faculty);
    $facultyRow = $facultyResult->fetch_assoc();

    //Adviser name
    $facultyName = $facultyRow['name'];

    $activeSY = "SELECT * FROM school_year WHERE is_archived = 0";
    $activeSYResult = $conn->query($activeSY);
    $activeSYRow = $activeSYResult->fetch_assoc();
    //School year ID
    $sy_id = $activeSYRow['id'];
    $sy = $activeSYRow['sy'];

    $update = "UPDATE user SET section = '$name' WHERE id = '$facultyID'";
    $conn->query($update);

    $update2 = "UPDATE `section` SET `name`='$name',`track`='$track',`strand`='$strand',`grade`='$grade',`adviser_id`='$facultyID',`adviser`='$facultyName',`school_year_id`='$sy_id',`school_year`='$sy' WHERE id = $id";
    $result = mysqli_query($conn, $update2);

    if ($result) {
        echo ("<script>location.href = 'section_table.php?msg=Section updated successfully!';</script>");
        exit();
    } else {
        echo ("<script>location.href = 'section_table.php?errmsg=Section updating unsuccessful.';</script>");
        exit();
    }
}
