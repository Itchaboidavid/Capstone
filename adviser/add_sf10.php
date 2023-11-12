<?php
include("../config.php");
session_start();

$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = $conn->query($student);
$studentRow = $studentResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SF 10 REMEDIAL</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', 'select[name^="sem"], select[name^="subject_type"]', function() {
                var semester = $(this).closest('tr').find('select[name^="sem"]').val();
                var subjectType = $(this).closest('tr').find('select[name^="subject_type"]').val();
                var subjectTitle = $(this).closest('tr').find('select[name^="subject_title"]');

                $.ajax({
                    url: "subjectajax.php",
                    method: "POST",
                    data: {
                        subjectType: subjectType,
                        semester: semester
                    },
                    success: function(data) {
                        subjectTitle.html(data);
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
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <h1 class="mt-4">Student</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="student_table.php">Student Table</a></li>
                            <li class="breadcrumb-item active">SF 10 REMEDIAL</li>
                        </ol>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><?php echo $studentRow['name'] ?></h4>
                    </div>
                    <form action="" method="POST" class="needs-validation" novalidate>
                        <div class="card-body">
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr class="fw-bold" style="font-size: 14px; text-align:center;">
                                        <td style="width: 100px;">Semester</td>
                                        <td style="width: 130px;">Subject Type</td>
                                        <td>Subject Title</td>
                                        <td style="width: 95px;">Sem Final Grade</td>
                                        <td style="width: 95px;">Remedial Class Mark</td>
                                        <td style="width: 115px;">Recomputed Final Grade</td>
                                        <td style="width: 90px;">Action Taken</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo
                                        '
                                    <tr>
                                        <td>
                                        <select class="form-select-sm bg-body-tertiary w-100" name="semester' . $i . '">
                                        <option value="" selected>Semester</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                    </select>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_type' . $i . '">
                                                <option value="" selected>Subject type</option>
                                                <option value="Core">Core</option>
                                                <option value="Applied">Applied</option>
                                                <option value="Specialized">Specialized</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_title' . $i . '">
                                                <option value="" selected disabled>Subject title</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="first' . $i . '" id="first' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="number" name="second' . $i . '" id="second' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="text" name="final_grade' . $i . '" id="final_grade' . $i . '" placeholder="Final Grade" class="form-control bg-body-tertiary" disabled />
                                        </td>
                                        <td>
                                        <input type="text" id="action' . $i . '" placeholder="Action" class="form-control bg-body-tertiary" disabled />
                                        </td>
                                    </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="add_sf10">Add</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
        </main>
    </div>

    <script>
        function calculateAverage(index) {
            var first = parseFloat(document.getElementById("first" + index).value);
            var second = parseFloat(document.getElementById("second" + index).value);
            var finalGrade = document.getElementById("final_grade" + index);
            var action = document.getElementById("action" + index);


            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade" + index).value = roundedAverage;
                finalGrade.value = roundedAverage;

                if (average >= 75) {
                    finalGrade.style.color = 'green';
                    action.style.color = 'green';
                    action.value = 'PASSED';
                } else {
                    finalGrade.style.color = 'red';
                    action.style.color = 'red';
                    action.value = 'FAILED';
                }
            }
        }
    </script>

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
if (isset($_POST['add_sf10'])) {
    $studentName = $studentRow['name'];

    for ($i = 1; $i <= 5; $i++) {
        $sem = $conn->real_escape_string($_POST['semester' . $i]);
        $subjectType = $conn->real_escape_string($_POST['subject_type' . $i]);
        $subjectTitle = $conn->real_escape_string($_POST['subject_title' . $i]);
        $first = (float)$_POST['first' . $i];
        $second = (float)$_POST['second' . $i];
        $finalGrade = ($first + $second) / 2;

        $check = "SELECT * FROM `sf10Remedial` WHERE `student_name` = '$studentName' AND `subject_type` = '$subjectType' AND `subject_title` = '$subjectTitle' AND `old_grade` = '$first' AND `new_grade` = '$second' AND `final_grade` = '$finalGrade' AND `semester` = '$sem'";
        $checkResult = $conn->query($check);
        $checkCount = $checkResult->num_rows;

        if ($checkCount > 0) {
            echo ("<script>location.href = 'student_table.php?errmsg=Duplication of entry!';</script>");
        } else {
            if (!empty($sem) && !empty($subjectType) && !empty($subjectTitle) && !empty($first) && !empty($second)) {
                $sql = "INSERT INTO `sf10remedial`(`student_name`, `subject_type`, `subject_title`, `old_grade`, `new_grade`, `final_grade`, `semester`) VALUES ('$studentName','$subjectType','$subjectTitle','$first','$second','$finalGrade','$sem')";
                $sqlResult = $conn->query($sql);
            }
        }
    }
    echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
    exit();
}

?>