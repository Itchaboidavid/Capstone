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
    <title>SF 10</title>
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

        // This function adds a new row to the table
        let rowCounter = 1;

        function addNewRow() {
            var newRow = `<tr>
                            <!-- The structure for the new row will be the same as the initial row -->
                            <!-- ... Insert structure of a row here ... -->
                            <td>
                                            <div class="form-floating">
                                                <select class="form-select bg-body-tertiary" name="sem[]" id="sem_${rowCounter}">
                                                    <option value="" selected>--Semester--</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                </select>
                                                <label for="sem">Semester</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select semester.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <select class="form-select bg-body-tertiary" name="subject_type[]" id="subject_type_${rowCounter}">
                                                    <option value="" selected>--Subject type--</option>
                                                    <option value="Core">Core</option>
                                                    <option value="Applied">Applied</option>
                                                    <option value="Specialized">Specialized</option>
                                                </select>
                                                <label for="subject_type">Subject type</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <select class="form-select bg-body-tertiary" name="subject_title[]" id="subject_title_${rowCounter}">
                                                    <option value="" selected disabled>--Subject title--</option>
                                                </select>
                                                <label for="subject_title">Subject title</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject title.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="number" name="first[]" id="first_${rowCounter}" placeholder="first" class="form-control bg-body-tertiary" oninput="calculateAverage(${rowCounter})" step="0.01" min="0" max="100" />
                                                <label for="first">1st Quarter</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 1st quarter grade.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="number" name="second[]" id="second_${rowCounter}" placeholder="second" class="form-control bg-body-tertiary" oninput="calculateAverage(${rowCounter})" step="0.01" min="0" max="100" />
                                                <label for="second">2nd Quarter</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 2nd quarter grade.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="text" name="final_grade[]" id="final_grade_${rowCounter}" placeholder="final_grade" class="form-control bg-body-tertiary" disabled />
                                                <label for="final_grade">Sem Final Grade</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1">.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="text" name="action[]" id="action_${rowCounter}" placeholder="action" class="form-control bg-body-tertiary" disabled />
                                                <label for="action">Action Taken</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1">.</div>
                                            </div>
                                        </td>
                        </tr>`;

            $('tbody').append(newRow); // Append the new row to the table body
            rowCounter++;
        }

        $(document).ready(function() {
            // Event delegation to handle change event for dynamically added rows
            $(document).on('change', 'select[name^="sem"]', function() {
                addNewRow();
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
                            <li class="breadcrumb-item active">SF 10</li>
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
                                    <tr class="fw-bold" style="font-size: 14px;">
                                        <td>Semester</td>
                                        <td>Subject Type</td>
                                        <td>Subject Title</td>
                                        <td>1st</td>
                                        <td>2nd</td>
                                        <td>Sem Final Grade</td>
                                        <td>Action Taken</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-floating">
                                                <select class="form-select bg-body-tertiary" name="sem[]" id="sem">
                                                    <option value="" selected>--Semester--</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                </select>
                                                <label for="sem">Semester</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select semester.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <select class="form-select bg-body-tertiary" name="subject_type[]" id="subject_type">
                                                    <option value="" selected>--Subject type--</option>
                                                    <option value="Core">Core</option>
                                                    <option value="Applied">Applied</option>
                                                    <option value="Specialized">Specialized</option>
                                                </select>
                                                <label for="subject_type">Subject type</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <select class="form-select bg-body-tertiary" name="subject_title[]" id="subject_title">
                                                    <option value="" selected disabled>--Subject title--</option>
                                                </select>
                                                <label for="subject_title">Subject title</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject title.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="number" name="first[]" id="first" placeholder="first" class="form-control bg-body-tertiary" oninput="calculateAverage1stRow()" step="0.01" min="0" max="100" />
                                                <label for="first">1st Quarter</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 1st quarter grade.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="number" name="second[]" id="second" placeholder="second" class="form-control bg-body-tertiary" oninput="calculateAverage1stRow()" step="0.01" min="0" max="100" />
                                                <label for="second">2nd Quarter</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 2nd quarter grade.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="text" name="final_grade[]" id="final_grade" placeholder="final_grade" class="form-control bg-body-tertiary" disabled />
                                                <label for="final_grade">Sem Final Grade</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1">.</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-floating mb-3 ">
                                                <input type="text" name="action[]" id="action" placeholder="action" class="form-control bg-body-tertiary" disabled />
                                                <label for="action">Action Taken</label>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1">.</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="add_sf10">Save</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
        </main>
    </div>

    <script>
        function calculateAverage(index) {
            var first = parseFloat(document.getElementById("first_" + index).value);
            var second = parseFloat(document.getElementById("second_" + index).value);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade_" + index).value = roundedAverage;

                var status = (average >= 75) ? "Passed" : "Failed";
                document.getElementById("action_" + index).value = status;
            }
        }
    </script>

    <script>
        function calculateAverage1stRow() {
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

    $rowCount = count($_POST['sem']); // Get the total count of rows

    // Loop through each dynamically added row
    for ($index = 0; $index < $rowCount - 1; $index++) {
        $subject_type = mysqli_real_escape_string($conn, $_POST['subject_type'][$index]);
        $subject_title = mysqli_real_escape_string($conn, $_POST['subject_title'][$index]);
        $first = (float)$_POST['first'][$index];
        $second = (float)$_POST['second'][$index];

        // Check if $first and $second are valid numbers and not empty
        if ($first !== '' && $second !== '' && is_numeric($first) && is_numeric($second)) {
            $final_grade = round(($first + $second) / 2);
            $action = ($final_grade >= 75) ? "Passed" : "Failed";
            $sem = mysqli_real_escape_string($conn, $_POST['sem'][$index]);

            // Insert data for each row into the database
            $insert = "INSERT INTO `sf10`(`student_name`, `subject_type`, `subject_title`, `first`, `second`, `final_grade`, `action`, `sem`) VALUES ('$studentName','$subject_type','$subject_title','$first','$second','$final_grade','$action','$sem')";
            $insertResult = $conn->query($insert);
        } else {
            // Handle the case where $first or $second is empty or not a valid number
            echo "Error: Invalid values for first or second in row $index";
            // Handle accordingly, such as skipping the insertion or displaying an error message
        }
    }

    echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
    exit();
}




// if (isset($_POST['add_sf10'])) {
//     $studentName = $studentRow['name'];
//     $subject_type = mysqli_real_escape_string($conn, $_POST["subject_type"]);
//     $subject_title = mysqli_real_escape_string($conn, $_POST["subject_title"]);
//     $first = mysqli_real_escape_string($conn, $_POST["first"]);
//     $second = mysqli_real_escape_string($conn, $_POST["second"]);
//     $final_grade = round(($first + $second) / 2);
//     $action = ($final_grade >= 75) ? "Passed" : "Failed";
//     $sem = mysqli_real_escape_string($conn, $_POST["sem"]);

//     $check = "SELECT * FROM `sf10` WHERE `student_name` = '$studentName' AND `subject_title` = '$subject_title' AND `sem` = '$sem'";
//     $checkResult = $conn->query($check);
//     $checkCount = $checkResult->num_rows;
//     if ($checkCount > 0) {
//         echo ("<script>location.href = 'student_table.php?errmsg=Subject is already graded!';</script>");
//     } else {
//         $insert = "INSERT INTO `sf10`(`student_name`, `subject_type`, `subject_title`, `first`, `second`, `final_grade`, `action`, `sem`) VALUES ('$studentName','$subject_type','$subject_title','$first','$second','$final_grade','$action','$sem')";
//         $insertResult = $conn->query($insert);
//         echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
//         exit();
//     }
// }
?>