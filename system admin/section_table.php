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
    <title>Section</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#track2").change(function() {
                var track_name = $(this).val();
                $.ajax({
                    url: "dropdown.php",
                    method: "POST",
                    data: {
                        trackName: track_name
                    },
                    success: function(data) {
                        $("#strand2").html(data);
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
                <div class="d-flex justify-content-between align-items-center mt-0">
                    <div>
                        <h1 class="mt-4">Section</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Section Table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
                        Add
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="userModalLabel">Add section</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3 ">
                                            <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                                            <label for="name">Section</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a section name.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="grade" id="grade">
                                                <option selected>Grade</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <label for="grade">Grade</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select the grade level.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="track" id="track">
                                                <option value="" selected>Track</option>
                                                <?php
                                                $select = "SELECT * FROM track ORDER BY `name` ASC";
                                                $result = mysqli_query($conn, $select);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($row["name"] != "All") {
                                                ?>
                                                        <option value="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></option>
                                                <?php }
                                                }
                                                ?>
                                            </select>
                                            <label for="track">Track</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select track.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="strand" id="strand">
                                                <option value="" selected disabled>Strand</option>
                                            </select>
                                            <label for="strand">Strand</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select strand.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="faculty" id="faculty">
                                                <option value="" selected>Faculty</option>
                                                <?php
                                                $select = "SELECT * FROM `user` WHERE `user_type` = 'adviser' ORDER BY `name` ASC";
                                                $result = mysqli_query($conn, $select);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($row["name"] != "admin") {
                                                ?>
                                                        <option value="<?php echo $row["name"] ?>"><?php echo $row["name"] ?></option>
                                                <?php  }
                                                }
                                                ?>
                                            </select>
                                            <label for="faculty">faculty</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a faculty.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="semester" id="semester" placeholder="semester" required>
                                                <?php
                                                $select = "SELECT * FROM `semester`";
                                                $result = mysqli_query($conn, $select);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option value="<?php echo $row["output"] ?>"><?php echo $row["output"] ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for=" semester">Semester</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a semester.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_user">Add</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Section table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Track</th>
                                    <th>Strand</th>
                                    <th>Grade</th>
                                    <th>Faculty</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Section</th>
                                    <th>Track</th>
                                    <th>Strand</th>
                                    <th>Grade</th>
                                    <th>Faculty</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $section = "SELECT * FROM `section`";
                                $sectionResult = $conn->query($section);
                                while ($sectionRow = $sectionResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $sectionRow["name"] ?></td>
                                        <td><?php echo $sectionRow["track"] ?></td>
                                        <td><?php echo $sectionRow["strand"] ?></td>
                                        <td><?php echo $sectionRow["grade"] ?></td>
                                        <td><?php echo $sectionRow["faculty"] ?></td>
                                        <td><?php echo $sectionRow["semester"] ?></td>
                                        <td>
                                            <a href="edit_section.php?id=<?php echo $sectionRow['id'] ?>" style="border: none; background: transparent;">
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
if (isset($_POST["submit"])) {
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

    $select = "SELECT * FROM `section` WHERE `name` = '$name'";
    $result = mysqli_query($conn, $select);

    $select2 = "SELECT * FROM `section` WHERE `faculty` = '$faculty'";
    $result2 = mysqli_query($conn, $select2);

    $select3 = "SELECT * FROM `section` WHERE `track` = '$track' AND `strand` = '$strand' AND `grade` = '$grade'";
    $result3 = $conn->query($select3);

    if (mysqli_num_rows($result) > 0) {
        header("location:section_table.php?errmsg=The section name already exist!");
        exit();
    } elseif (mysqli_num_rows($result2) > 0) {
        header("location:section_table.php?errmsg=The faculty is already assigned!");
        exit();
    } elseif (mysqli_num_rows($result3) > 0) {
        header("location:section_table.php?errmsg=Track, strand and grade is duplicated!");
    } else {
        $insert = "INSERT INTO `section`(`name`, `track`, `strand`, `grade`, `faculty`, `semester`, `semester_name`, `start_year`, `end_year`) VALUES ('$name','$track','$strand', '$grade', '$faculty', '$semester', '$semester_name', '$start_year', '$end_year')";
        mysqli_query($conn, $insert);
        header("location:section_table.php?msg=Section added successfully!");
        exit();
    }
}

$conn->close();
?>