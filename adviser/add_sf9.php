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
    <title>SF 9</title>
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
                                                <select class="form-select bg-body-tertiary" name="sem[]" id="sem_${rowCounter}">
                                                    <option value="" selected>--Semester--</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                    <option value="3rd">3rd</option>
                                                </select>
                                        </td>
                                        <td>
                                                <select class="form-select-sm bg-body-tertiary w-100" name="subject_type[]" id="subject_type_${rowCounter}">
                                                    <option value="" selected>--Subject type--</option>
                                                    <option value="Core">Core</option>
                                                    <option value="Applied">Applied</option>
                                                    <option value="Specialized">Specialized</option>
                                                </select>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject type.</div>
                                        </td>
                                        <td>
                                                <select class="form-select-sm bg-body-tertiary w-100" name="subject_title[]" id="subject_title_${rowCounter}">
                                                    <option value="" selected disabled>--Subject title--</option>
                                                </select>
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please select subject title.</div>
                                        </td>
                                        <td>
                                                <input type="number" name="first[]" id="first_${rowCounter}" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(${rowCounter})" step="0.01" min="0" max="100" />
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 1st quarter grade.</div>
                                        </td>
                                        <td>
                                                <input type="number" name="second[]" id="second_${rowCounter}" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(${rowCounter})" step="0.01" min="0" max="100" />
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1"> Please enter 2nd quarter grade.</div>
                                        </td>
                                        <td>
                                                <input type="text" name="final_grade[]" id="final_grade_${rowCounter}" placeholder="Final Grade" class="form-control bg-body-tertiary" disabled />
                                                <div class="valid-feedback ps-1">Great!</div>
                                                <div class="invalid-feedback ps-1">.</div>
                                        </td>
                        </tr>`;

            $('.grades').append(newRow); // Append the new row to the table body
            rowCounter++;
        }

        $(document).ready(function() {
            // Event delegation to handle change event for dynamically added rows
            $(document).on('change', 'select[name^="sem"]:last', function() {
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
                            <li class="breadcrumb-item active">SF 9</li>
                        </ol>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><?php echo $studentRow['name'] ?></h4>
                    </div>
                    <form action="" method="POST" class="needs-validation">
                        <div class=" card-body">
                            <h4>REPORT OF LEARNING PROGRESS AND ACHIEVEMENT</h4>
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr class="fw-bold" style="font-size: 14px;">
                                        <td>Semester</td>
                                        <td>Subject Type</td>
                                        <td>Subject Title</td>
                                        <td>Quarter Grade</td>
                                        <td>Quarter Grade</td>
                                        <td>Sem Final Grade</td>
                                    </tr>
                                </thead>
                                <tbody class="grades">
                                    <tr>
                                        <td>
                                            <select class="form-select-sm w-100 bg-body-tertiary" name="sem[]" id="sem">
                                                <option value="" selected>--Semester--</option>
                                                <?php
                                                $semester = "SELECT DISTINCT `name` FROM `semester`";
                                                $semesterResult = $conn->query($semester);
                                                while ($semesterRow = $semesterResult->fetch_assoc()) :
                                                ?> <option value="<?php echo $semesterRow['name'] ?>"><?php echo $semesterRow['name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_type[]" id="subject_type">
                                                <option value="" selected>--Subject type--</option>
                                                <option value="Core">Core</option>
                                                <option value="Applied">Applied</option>
                                                <option value="Specialized">Specialized</option>
                                            </select>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select subject type.</div>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_title[]" id="subject_title">
                                                <option value="" selected disabled>--Subject title--</option>
                                            </select>
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please select subject title.</div>
                                        </td>
                                        <td>
                                            <input type="number" name="first[]" id="first" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage1stRow()" step="0.01" min="0" max="100" required />
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter 1st quarter grade.</div>
                                        </td>
                                        <td>
                                            <input type="number" name="second[]" id="second" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage1stRow()" step="0.01" min="0" max="100" />
                                            <div class="valid-feedback ps-1">Great!</div>
                                            <div class="invalid-feedback ps-1"> Please enter 2nd quarter grade.</div>
                                        </td>
                                        <td>
                                            <input type="text" name="final_grade[]" id="final_grade" placeholder="Final Grade" class="form-control bg-body-tertiary" disabled />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h4>LEARNING MODALITY</h4>
                            <!-- MODALITY -->
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr class="fw-bold" style="font-size: 14px;">
                                        <td>MODALITY</td>
                                        <td class="text-center">Q1</td>
                                        <td class="text-center">Q2</td>
                                        <td class="text-center">Q3</td>
                                        <td class="text-center">Q4</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">BLENDED</td>
                                        <td><input type="checkbox" name="blended_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q4" value="1" class="w-100"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">MODULAR DISTANCE LEARNING</td>
                                        <td><input type="checkbox" name="mdl_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q4" value="1" class="w-100"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">IN-PERSON</td>
                                        <td><input type="checkbox" name="ip_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q4" value="1" class="w-100"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h4>REPORT ON LEARNER’S OBSERVED VALUES</h4>
                            <!-- OBSERVED VALUES -->
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr class="fw-bold text-center" style="font-size: 14px;">
                                        <td>CORE VALUES</td>
                                        <td>BEHAVIOR STATEMENT</td>
                                        <td colspan="4">
                                            QUARTER
                                        </td>
                                    </tr>
                                    <tr class="fw-bold text-center" style="font-size: 14px;">
                                        <td></td>
                                        <td></td>
                                        <td>Q1</td>
                                        <td>Q2</td>
                                        <td>Q3</td>
                                        <td>Q4</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2" style="vertical-align:middle;">1. Maka-Diyos</td>
                                        <td>
                                            Expresses ones spiritual belief’s
                                            while respecting the spiritual
                                            beliefs of other
                                        </td>
                                        <td>
                                            <select name="mdq1" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq2" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq3" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq4" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Shows adherence to ethical
                                            principles by uplholding truth.
                                        </td>
                                        <td>
                                            <select name="mdq5" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq6" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq7" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq8" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <tr>
                                        <td rowspan="2" style="vertical-align:middle;">2. Makatao</td>
                                        <td>
                                            Is sensitive to individual, social
                                            and cultural differences
                                        </td>
                                        <td>
                                            <select name="mkq1" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq2" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq3" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq4" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Demonstrate contribution toward
                                            solidarity
                                        </td>
                                        <td>
                                            <select name="mkq5" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq6" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq7" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq8" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <tr>
                                        <td rowspan="" style="vertical-align:middle;">3.Makakalikasan</td>
                                        <td>
                                            Cares for the environment and
                                            utilizes resources wisely,
                                            judiciously, and economically.

                                        </td>
                                        <td>
                                            <select name="mkkq1" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq2" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq3" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq4" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <tr>
                                        <td rowspan="2" style="vertical-align:middle;">4.Makabansa</td>
                                        <td>
                                            Demonstrate pride in being a
                                            Filipino, exercises the rights and
                                            responsibilities of a
                                            Filipio citizen.
                                        </td>
                                        <td>
                                            <select name="mbq1" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq2" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq3" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq4" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Demonstrate appropriate behavior
                                            in carrying out activities in the
                                            school, community, and country.
                                        </td>
                                        <td>
                                            <select name="mbq5" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq6" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq7" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq8" id="" required>
                                                <option value="" selected></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="add_sf9">Add</button>
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
            var finalGrade = document.getElementById("final_grade_" + index);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade_" + index).value = roundedAverage;
                finalGrade.value = roundedAverage;

                if (average >= 75) {
                    finalGrade.style.color = 'green';
                } else {
                    finalGrade.style.color = 'red';
                }
            }
        }
    </script>

    <script>
        function calculateAverage1stRow() {
            var first = parseFloat(document.getElementById("first").value);
            var second = parseFloat(document.getElementById("second").value);
            var final_grade = parseFloat(document.getElementById("final_grade").value);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade").value = roundedAverage;

                var finalGradeElement = document.getElementById("final_grade");
                if (roundedAverage < 75) {
                    finalGradeElement.style.color = "red";
                } else {
                    finalGradeElement.style.color = "green";
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
if (isset($_POST['add_sf9'])) {
    $studentName = $studentRow['name'];
    $rowCount = count($_POST['sem']); // Get the total count of rows

    for ($index = 0; $index < $rowCount; $index++) {
        $subject_type = mysqli_real_escape_string($conn, $_POST['subject_type'][$index]);
        $subject_title = mysqli_real_escape_string($conn, $_POST['subject_title'][$index]);
        $first = (float)$_POST['first'][$index]; // Modified to use 'first' array
        $second = (float)$_POST['second'][$index]; // Modified to use 'second' array
        $sem = mysqli_real_escape_string($conn, $_POST['sem'][$index]);

        // Check if the required fields are not empty and are valid numbers
        if (!empty($subject_type) && !empty($subject_title) && is_numeric($first) && is_numeric($second)) {
            $final_grade = round(($first + $second) / 2);

            // Insert data for each non-empty and valid row into the database
            $insert = "INSERT INTO `sf9`(`student_name`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`) VALUES ('$studentName','$subject_type','$subject_title','$first','$second','$final_grade','$sem')";
            $insertResult = $conn->query($insert);
        } else {
            // Handle the case where fields are empty or not valid
            echo "Error: Invalid or empty values in row $index";
            // You might also consider logging the error for debugging purposes.
        }
    }

    $blendedQ1 = isset($_POST['blended_q1']) ? 1 : 0;
    $blendedQ2 = isset($_POST['blended_q2']) ? 1 : 0;
    $blendedQ3 = isset($_POST['blended_q3']) ? 1 : 0;
    $blendedQ4 = isset($_POST['blended_q4']) ? 1 : 0;
    $mdlQ1 = isset($_POST['mdl_q1']) ? 1 : 0;
    $mdlQ2 = isset($_POST['mdl_q2']) ? 1 : 0;
    $mdlQ3 = isset($_POST['mdl_q3']) ? 1 : 0;
    $mdlQ4 = isset($_POST['mdl_q4']) ? 1 : 0;
    $ipQ1 = isset($_POST['ip_q1']) ? 1 : 0;
    $ipQ2 = isset($_POST['ip_q2']) ? 1 : 0;
    $ipQ3 = isset($_POST['ip_q3']) ? 1 : 0;
    $ipQ4 = isset($_POST['ip_q4']) ? 1 : 0;

    $check = "SELECT * FROM `sf9_modality` WHERE `student_name` = '$studentName'";
    $checkResult = $conn->query($check);
    $checkCount = $checkResult->num_rows;

    if ($checkCount > 0) {
        echo "<script>location.href = 'student_table.php?errmsg=Duplication of entry in Modality!';</script>";
    } else {
        $insertModality = "INSERT INTO `sf9_modality`(`student_name`, `blended_q1`, `blended_q2`, `blended_q3`, `blended_q4`, `mdl_q1`, `mdl_q2`, `mdl_q3`, `mdl_q4`, `ip_q1`, `ip_q2`, `ip_q3`, `ip_q4`) VALUES ('$studentName','$blendedQ1','$blendedQ2','$blendedQ3','$blendedQ4','$mdlQ1','$mdlQ2','$mdlQ3','$mdlQ4','$ipQ1','$ipQ2','$ipQ3','$ipQ4')";
        $insertModalityResult = $conn->query($insertModality);
    }


    $mdq1 = $_POST['mdq1'];
    $mdq2 = $_POST['mdq2'];
    $mdq3 = $_POST['mdq3'];
    $mdq4 = $_POST['mdq4'];
    $mdq5 = $_POST['mdq5'];
    $mdq6 = $_POST['mdq6'];
    $mdq7 = $_POST['mdq7'];
    $mdq8 = $_POST['mdq8'];

    $mkq1 = $_POST['mkq1'];
    $mkq2 = $_POST['mkq2'];
    $mkq3 = $_POST['mkq3'];
    $mkq4 = $_POST['mkq4'];
    $mkq5 = $_POST['mkq5'];
    $mkq6 = $_POST['mkq6'];
    $mkq7 = $_POST['mkq7'];
    $mkq8 = $_POST['mkq8'];

    $mkkq1 = $_POST['mkkq1'];
    $mkkq2 = $_POST['mkkq2'];
    $mkkq3 = $_POST['mkkq3'];
    $mkkq4 = $_POST['mkkq4'];

    $mbq1 = $_POST['mbq1'];
    $mbq2 = $_POST['mbq2'];
    $mbq3 = $_POST['mbq3'];
    $mbq4 = $_POST['mbq4'];
    $mbq5 = $_POST['mbq5'];
    $mbq6 = $_POST['mbq6'];
    $mbq7 = $_POST['mbq7'];
    $mbq8 = $_POST['mbq8'];

    $checkOV = "SELECT * FROM `sf9_ov` WHERE `student_name` = '$studentName'";
    $checkOVResult = $conn->query($checkOV);
    $checkOVCount = $checkOVResult->num_rows;
    if ($checkOVCount > 0) {
        echo "<script>location.href = 'student_table.php?errmsg=Duplication of entry in OBSERVED VALUES!';</script>";
    } else {
        $insertOV = "INSERT INTO `sf9_ov`(`student_name`, `mdq1`, `mdq2`, `mdq3`, `mdq4`, `mdq5`, `mdq6`, `mdq7`, `mdq8`, `mkq1`, `mkq2`, `mkq3`, `mkq4`, `mkq5`, `mkq6`, `mkq7`, `mkq8`, `mkkq1`, `mkkq2`, `mkkq3`, `mkkq4`, `mbq1`, `mbq2`, `mbq3`, `mbq4`, `mbq5`, `mbq6`, `mbq7`, `mbq8`) VALUES ('$studentName','$mdq1','$mdq2','$mdq3','$mdq4','$mdq5','$mdq6','$mdq7','$mdq8','$mkq1','$mkq2','$mkq3','$mkq4','$mkq5','$mkq6','$mkq7','$mkq8','$mkkq1','$mkkq2','$mkkq3','$mkkq4','$mbq1','$mbq2','$mbq3','$mbq4','$mbq5','$mbq6','$mbq7','$mbq8')";
        $insertOVResult = $conn->query($insertOV);

        echo "<script>location.href = 'student_table.php?msg=SF 9 added successfully!';</script>";
        exit();
    }
}
?>