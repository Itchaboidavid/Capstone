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
    <script>
        // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        url.searchParams.delete('errmsg');
        window.history.replaceState({}, document.title, url);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
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
                    <button type="button" style="align-self: end;" class="btn btn-sm btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#sectionModal">
                        Add section
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="sectionModal" tabindex="-1">
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
                                            <select class="form-select bg-body-tertiary" name="grade" id="grade" required>
                                                <option selected value="">Grade</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <label for="grade">Grade</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select the grade level.</div>
                                        </div>
                                        <div class="form-floating mb-3 ">
                                            <select class="form-select bg-body-tertiary" name="strand" id="strand" required>
                                                <option value="" selected disabled>Strand</option>
                                                <?php
                                                $strand = "SELECT * FROM `strand` ORDER BY name ASC";
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
                                                <option value="" selected>Class Adviser</option>
                                                <?php
                                                $select = "SELECT * FROM `user` WHERE user_type = 'adviser' AND section = '' AND status = 'Active'";
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
                                            <?php
                                            $activeSY = "SELECT * FROM school_year WHERE is_archived = 0";
                                            $activeSYResult = $conn->query($activeSY);
                                            $activeSYRow = $activeSYResult->fetch_assoc();
                                            ?>
                                            <input type="text" class="form-control bg-body-tertiary" name="sy" id="sy" value="<?php echo $activeSYRow["sy"] ?>" readonly>
                                            <label for="sy">School year</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select school year.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_section">Add</button>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Section table
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Section</th>
                                    <th>Strand</th>
                                    <th>Class Adviser</th>
                                    <th>Grade</th>
                                    <th>School year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $section = "SELECT * FROM `section` WHERE is_archived = 0";
                                $sectionResult = $conn->query($section);
                                $sectionCount = 1;
                                while ($sectionRow = $sectionResult->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?php echo $sectionCount ?></td>
                                        <td><?php echo $sectionRow["name"] ?></td>
                                        <td><?php echo $sectionRow["strand"] ?></td>
                                        <td><?php echo $sectionRow["adviser"] ?></td>
                                        <td><?php echo $sectionRow["grade"] ?></td>
                                        <td><?php echo $sectionRow["school_year"] ?></td>
                                        <td>
                                            <a href="edit_section.php?id=<?php echo $sectionRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;">
                                                Edit <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $sectionCount++;
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
if (isset($_POST["add_section"])) {
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

    //School year ID
    $sy_id = $activeSYRow['id'];
    $sy = $activeSYRow['sy'];

    $select = "SELECT * FROM `section` WHERE `name` = '$name' AND is_archived = 0";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        header("location:section_table.php?errmsg=The section already exist!");
        exit();
    } else {
        $update = "UPDATE user SET section = '$name' WHERE id = '$facultyID'";
        $conn->query($update);

        $insert = "INSERT INTO `section`(`name`, `track`, `strand`, `grade`, `adviser_id`, `adviser`, `school_year_id`, `school_year`) VALUES ('$name','$track','$strand', '$grade', '$facultyID', '$facultyName', '$sy_id', '$sy')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'section_table.php?msg=Section added successfully!';</script>");
        exit();
    }
}

$conn->close();
?>