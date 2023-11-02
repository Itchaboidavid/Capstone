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
    <title>SF 9 & 10</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#subject_type").change(function() {
                var subject_type = $(this).val();
                $.ajax({
                    url: "subjectajax.php",
                    method: "POST",
                    data: {
                        subjectType: subject_type
                    },
                    success: function(data) {
                        $("#subject_title").html(data);
                    }
                })
            })
        })

        $(document).ready(function() {
            $("#subject_typeRemedial").change(function() {
                var subject_type = $(this).val();
                $.ajax({
                    url: "subjectajax.php",
                    method: "POST",
                    data: {
                        subjectType: subject_type
                    },
                    success: function(data) {
                        $("#subject_titleRemedial").html(data);
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
            <main class="py-4 px-3">
                <?php
                $id = $_GET["id"];
                $student = "SELECT * FROM `student` WHERE `id` = '$id'";
                $studentResult = mysqli_query($conn, $student);
                $studentRow = mysqli_fetch_assoc($studentResult);
                ?>
                <div class="card bg-body-secondary">
                    <div class="card-header bg-primary text-light fs-2">
                        <span style="text-shadow: 1px 1px 1px black;"><?php echo $studentRow['name'] ?></span>
                    </div>
                    <div class="card-body">
                        <h2 style="text-shadow: 1px 1px 2px black;">School form 10</h2>
                        <form action="" method="POST" class="needs-validation w-100" validate>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="subject_type" id="subject_type">
                                    <option value="" selected>--Subject type--</option>
                                    <option value="Core">Core</option>
                                    <option value="Applied">Applied</option>
                                    <option value="Specialized">Specialized</option>
                                </select>
                                <label for="subject_type">Subject type</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="subject_title" id="subject_title">
                                    <option value="" selected disabled>--Subject title--</option>
                                </select>
                                <label for="subject_title">Subject title</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select subject title.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="number" name="first" id="first" placeholder="first" class="form-control bg-body-tertiary" oninput="calculateAverage()" step="0.01" min="0" max="100" />
                                <label for="first">1st Quarter</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter 1st quarter grade.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="number" name="second" id="second" placeholder="second" class="form-control bg-body-tertiary" oninput="calculateAverage()" step="0.01" min="0" max="100" />
                                <label for="second">2nd Quarter</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please enter 2nd quarter grade.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="final_grade" id="final_grade" placeholder="final_grade" class="form-control bg-body-tertiary" disabled />
                                <label for="final_grade">Sem Final Grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="action" id="action" placeholder="action" class="form-control bg-body-tertiary" disabled />
                                <label for="action">Action Taken</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="sem" id="sem">
                                    <option value="" selected>--Semester--</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                                <label for="sem">Semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select semester.</div>
                            </div>
                            <hr>
                            <!-- REMEDIAL -->
                            <h2 style="text-shadow: 1px 1px 2px black;">School form 10 remedial</h2>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="subject_typeRemedial" id="subject_typeRemedial">
                                    <option value="" selected>--Subject type--</option>
                                    <option value="Core">Core</option>
                                    <option value="Applied">Applied</option>
                                    <option value="Specialized">Specialized</option>
                                </select>
                                <label for="subject_typeRemedial">Subject type</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="subject_titleRemedial" id="subject_titleRemedial">
                                    <option value="" selected disabled>--Subject title--</option>
                                </select>
                                <label for="subject_titleRemedial">Subject title</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select subject title.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="number" name="final_gradeRemedial" id="final_gradeRemedial" placeholder="final_gradeRemedial" class="form-control bg-body-tertiary" min="0" max="74" oninput="calculateAverageRemedial()" step="0.01" />
                                <label for="final_gradeRemedial">Sem Final Grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="number" name="remedial_mark" id="remedial_mark" placeholder="remedial_mark" class="form-control bg-body-tertiary" min="60" max="100" oninput="calculateAverageRemedial()" step="0.01" />
                                <label for="remedial_mark">Remedial Class Mark</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="recomputed_fg" id="recomputed_fg" placeholder="recomputed_fg" class="form-control bg-body-tertiary" disabled />
                                <label for="recomputed_fg">Recomputed Final Grade</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <input type="text" name="action_remedial" id="action_remedial" placeholder="action_remedial" class="form-control bg-body-tertiary" disabled />
                                <label for="action_remedial">Action Taken</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1">.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="sem_remedial" id="sem_remedial">
                                    <option value="" selected>--Semester--</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                                <label for="sem_remedial">Semester</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select semester.</div>
                            </div>
                            <div class="me-auto">
                                <input type="submit" class="btn btn-primary" value="Add" name="submit">
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
    <script>
        function calculateAverage() {
            var first = parseFloat(document.getElementById("first").value);
            var second = parseFloat(document.getElementById("second").value);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade").value = roundedAverage;

                var status = (average >= 75) ? "Passed" : "Failed";
                document.getElementById("action").value = status;
            }
        }

        function calculateAverageRemedial() {
            var final_gradeRemedial = parseFloat(document.getElementById("final_gradeRemedial").value);
            var remedial_mark = parseFloat(document.getElementById("remedial_mark").value);

            if (!isNaN(final_gradeRemedial) && !isNaN(remedial_mark)) {
                var averageRemedial = (final_gradeRemedial + remedial_mark) / 2;
                var roundedAverageRemedial = Math.round(averageRemedial);
                document.getElementById("recomputed_fg").value = roundedAverageRemedial;

                var statusRemedial = (averageRemedial >= 75) ? "Passed" : "Failed";
                document.getElementById("action_remedial").value = statusRemedial;
            }
        }
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $studentName = $studentRow['name'];
    $subject_type = mysqli_real_escape_string($conn, $_POST["subject_type"]);
    $subject_title = mysqli_real_escape_string($conn, $_POST["subject_title"]);
    $first = mysqli_real_escape_string($conn, $_POST["first"]);
    $second = mysqli_real_escape_string($conn, $_POST["second"]);
    $final_grade = round(($first + $second) / 2);
    $action = ($final_grade >= 75) ? "Passed" : "Failed";
    $sem = mysqli_real_escape_string($conn, $_POST["sem"]);

    //REMEDIAL
    $subject_typeRemedial = mysqli_real_escape_string($conn, $_POST["subject_typeRemedial"]);
    $subject_titleRemedial = mysqli_real_escape_string($conn, $_POST["subject_titleRemedial"]);
    $final_gradeRemedial = mysqli_real_escape_string($conn, $_POST["final_gradeRemedial"]);
    $remedial_mark = mysqli_real_escape_string($conn, $_POST["remedial_mark"]);
    $recomputed_fg = round(($final_gradeRemedial + $remedial_mark) / 2);
    $action_remedial = ($recomputed_fg >= 75) ? "Passed" : "Failed";
    $sem_remedial = mysqli_real_escape_string($conn, $_POST["sem_remedial"]);

    $check = "SELECT * FROM `sf10` WHERE `student_name` = '$studentName' AND `subject_title` = '$subject_title' OR `subject_titleRemedial` = '$subject_titleRemedial'";
    $checkResult = $conn->query($check);
    $checkCount = $checkResult->num_rows;

    if ($checkCount > 0) {
        echo ("<script>location.href = 'student_table.php?errmsg=Subject is already graded!';</script>");
    } else {
        $insert = "INSERT INTO `sf10`(`student_name`, `subject_type`, `subject_title`, `first`, `second`, `final_grade`, `action`, `sem`, `subject_typeRemedial`, `subject_titleRemedial`, `final_gradeRemedial`, `remedial_mark`, `recomputed_fg`, `action_remedial`, `sem_remedial`) VALUES ('$studentName','$subject_type','$subject_title','$first','$second','$final_grade','$action','$sem','$subject_typeRemedial','$subject_titleRemedial','$final_gradeRemedial','$remedial_mark','$recomputed_fg','$action_remedial','$sem_remedial')";
        $insertResult = $conn->query($insert);
        echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
        exit();
    }
}
?>