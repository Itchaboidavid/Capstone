<?php
include("../config.php");
session_start();

//EDIT SUBJECT
if (isset($_POST['edit_subject'])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $subject_type = mysqli_real_escape_string($conn, $_POST["subject_type"]);
    $strand = mysqli_real_escape_string($conn, $_POST["strand"]);

    $forTrack = "SELECT * FROM `strand` WHERE `name` = '$strand'";
    $forTrackResult = $conn->query($forTrack);
    $forTrackRow = $forTrackResult->fetch_assoc();
    $track = $forTrackRow['track'];
    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);


    $update = "UPDATE `subject` SET `name`='$name', `subject_type`='$subject_type', `track`='$track', `strand`='$strand', `grade`='$grade', `semester`='$semester' WHERE id = $id";

    $result = mysqli_query($conn, $update);
    echo ("<script>location.href = 'subject_table.php?msg=Record updated successfully!';</script>");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Subject</title>
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
                        <h1 class="mt-4">Edit Subject</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="subject_table.php">Subject Table</a></li>
                            <li class="breadcrumb-item active">Edit Subject</li>
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
                <form action="" method="POST" class="needs-validation" novalidate>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Edit Subject</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $id = $_GET["id"];
                            $subject = "SELECT * FROM `subject` WHERE id = $id";
                            $subjectResult = $conn->query($subject);
                            $subjectRow = $subjectResult->fetch_assoc();
                            ?>

                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" value="<?php echo $subjectRow["name"] ?>" required />
                                <label for="name">Name</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter a name.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="subject_type" id="subject_type">
                                    <option value="Core" <?php echo ($subjectRow['subject_type'] == 'Core') ? "selected" : ""; ?>>Core</option>
                                    <option value="Applied" <?php echo ($subjectRow['subject_type'] == 'Applied') ? "selected" : ""; ?>>Applied</option>
                                    <option value="Specialized" <?php echo ($subjectRow['subject_type'] == 'Specialized') ? "selected" : ""; ?>>Specialized</option>
                                </select>
                                <label for="subject_type">Subject type</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select bg-body-tertiary" name="strand" id="strand3">
                                    <option value="<?php echo $subjectRow["strand"] ?>" selected><?php echo $subjectRow["strand"] ?></option>
                                    <?php
                                    $currentStrand = $subjectRow['strand'];
                                    $sql = "SELECT * FROM strand WHERE name != '$currentStrand'";
                                    $sqlResult = $conn->query($sql);
                                    while ($sqlRow = $sqlResult->fetch_assoc()) {
                                        if ($sqlRow['name'] != 'All') { ?>
                                            <option value="<?php echo $sqlRow['name'] ?>"><?php echo $sqlRow['name'] ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                                <label for="strand">Strand</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select strand.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <?php
                                $id = $_GET["id"];
                                $select = "SELECT * FROM `subject` WHERE id = $id";
                                $result = mysqli_query($conn, $select);
                                $subjectRow = mysqli_fetch_assoc($result);
                                ?>
                                <select class="form-select" name="grade" id="grade">
                                    <option value="11" <?php echo ($subjectRow['grade'] == '11') ? "selected" : ""; ?>>11</option>
                                    <option value="12" <?php echo ($subjectRow['grade'] == '12') ? "selected" : ""; ?>>12</option>
                                </select>
                                <label for="grade">Grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select the grade level.</div>
                            </div>
                            <div class="form-floating">
                                <select class="form-select bg-body-tertiary" name="semester" id="semester">
                                    <option value="1st" <?php echo ($subjectRow['semester'] == '1st') ? "selected" : ""; ?>>1st</option>
                                    <option value="2nd" <?php echo ($subjectRow['semester'] == '2nd') ? "selected" : ""; ?>>2nd</option>
                                </select>
                                <label for="semester">Semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select a semester.</div>
                            </div>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="edit_subject">Save</button>
                                <a href="subject_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </div>
                </form>
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