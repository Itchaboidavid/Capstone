<?php
include("../config.php");
session_start();

if (isset($_POST["add_subject"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $subject_type = mysqli_real_escape_string($conn, $_POST["subject_type"]);
    $strand = mysqli_real_escape_string($conn, $_POST["strand"]);

    $forTrack = "SELECT * FROM `strand` WHERE `name` = '$strand'";
    $forTrackResult = $conn->query($forTrack);
    $forTrackRow = $forTrackResult->fetch_assoc();
    $track = $forTrackRow['track'];
    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $subject = "SELECT * FROM `subject` WHERE name = '$name' AND semester = '$semester'";
    $subjectResult = $conn->query($subject);

    if (mysqli_num_rows($subjectResult) > 0) {
        header("location:subject_table.php?errmsg=The subject/subject code already exist!");
        exit();
    } else {
        $insert = "INSERT INTO `subject`(`name`, `subject_type`, `track`,`strand`, `grade`,`semester`,`status`) VALUES ('$name','$subject_type', '$track','$strand','$grade','$semester','$status')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'subject_table.php?msg=Subject added successfully!';</script>");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        // This script removes the 'msg' and 'errmsg' parameters from the URL without refreshing the page
        const url = new URL(window.location.href);
        url.searchParams.delete('msg');
        url.searchParams.delete('errmsg');
        window.history.replaceState({}, document.title, url);
    </script>
    <script>
        $(document).ready(function() {
            // When the filterSemester dropdown changes
            $("#filterSemester").change(function() {
                var selectedSemester = $(this).val();
                $("#datatablesSimple tbody tr").each(function() {
                    var semester = $(this).find("td:eq(5)").text(); // Assuming semester is in the 6th column
                    if (selectedSemester === "all" || selectedSemester === semester) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("navigation.php") ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center mt-0">
                    <div>
                        <h1 class="mt-4">Subject</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subject table</li>
                        </ol>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" style="align-self: end;" class="btn btn-sm btn-success px-3 py-1 mb-3" data-bs-toggle="modal" data-bs-target="#trackModal">
                        Add subject
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class=" modal-title fs-5" id="trackModalLabel">Add subject</h1>
                                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST" class="needs-validation" novalidate>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                                            <label for="name">Subject Title</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter a title.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="subject_type" id="subject_type" required>
                                                <option value="" selected>Subject type</option>
                                                <option value="Core">Core</option>
                                                <option value="Applied">Applied</option>
                                                <option value="Specialized">Specialized</option>
                                            </select>
                                            <label for="subject_type">Subject type</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select subject type.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="strand" id="strand2" required>
                                                <option value="" selected disabled>Strand</option>
                                                <?php
                                                $strand = "SELECT * FROM `strand`";
                                                $strandResult = $conn->query($strand);
                                                while ($strandRow = $strandResult->fetch_assoc()) :
                                                ?>
                                                    <option value="<?php echo $strandRow['name'] ?>"><?php echo $strandRow['name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                            <label for="strand">Strand</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select strand.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="grade" id="grade" required>
                                                <option value="" selected>Grade</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <label for="grade">Grade</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select the grade level.</div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select bg-body-tertiary" name="semester" id="semester" placeholder="semester" required>
                                                <option value="" selected>Semester</option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                            </select>
                                            <label for=" semester">Semester</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a semester.</div>
                                        </div>
                                        <div class="form-floating">
                                            <select class="form-select bg-body-tertiary" name="status" id="status" placeholder="status" required>
                                                <option value="Active" class="text-success" selected>Active</option>
                                                <option value="Disabled" class="text-danger">Disabled</option>
                                            </select>
                                            <label for="status">Status</label>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select a status.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="add_subject">Add</button>
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
                            Subject table
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Subject title</th>
                                    <th>Subject type</th>
                                    <th>Strand</th>
                                    <th>Grade</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subject = "SELECT * FROM `subject` ORDER BY subject_type ASC";
                                $subjectResult = $conn->query($subject);
                                $subjectCount = 1;
                                while ($subjectRow = $subjectResult->fetch_assoc()) :
                                    if ($subjectRow['name'] != "All") :
                                ?>
                                        <tr>
                                            <td><?php echo $subjectCount ?></td>
                                            <td><?php echo $subjectRow["name"] ?></td>
                                            <td><?php echo $subjectRow["subject_type"] ?></td>
                                            <td><?php echo $subjectRow["strand"] ?></td>
                                            <td><?php echo $subjectRow["grade"] ?></td>
                                            <td><?php echo $subjectRow["semester"] ?></td>
                                            <td>
                                                <?php
                                                if ($subjectRow['status'] == 'Active') {
                                                    echo '<span class="text-success">Active</span>';
                                                } else {
                                                    echo '<span class="text-danger">Disabled</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit_subject.php?id=<?php echo $subjectRow['id'] ?>" style="border: none; background: transparent; text-decoration: none;">
                                                    Edit <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                        $subjectCount++;
                                    endif;
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
$conn->close();
?>