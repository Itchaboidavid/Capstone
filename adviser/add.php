<?php
include("../config.php");
session_start();

$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id' AND is_archived = 0";
$studentResult = $conn->query($student);
$studentRow = $studentResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>School Form</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', 'input[name^="sem"], select[name^="sem"], select[name^="subject_type"]', function() {
                var semesterInput = $(this).closest('tr').find('input[name^="sem"]');
                var semesterSelect = $(this).closest('tr').find('select[name^="sem"]');
                var semester = semesterInput.length > 0 ? semesterInput.val() : semesterSelect.val();

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
                            <li class="breadcrumb-item active">School Form</li>
                        </ol>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h4><?php echo $studentRow['name'] ?></h4>
                    </div>
                    <form action="" method="POST" class="needs-validation">
                        <div class=" card-body">
                            <h4 class="mb-3">School Form 5B</h4>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="completed" id="completed" required>
                                    <option selected value=""></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <label for="completed">Completed SHS in 2 School Year</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select Yes/No.</div>
                            </div>
                            <div class="form-floating mb-3 ">
                                <select class="form-select bg-body-tertiary" name="nc" id="nc">
                                    <option selected value=""></option>
                                    <option value="NC I">NC I</option>
                                    <option value="NC II">NC II</option>
                                    <option value="NC III">NC III</option>
                                </select>
                                <label for="nc">National Certification Level Attained(only if applicable)</label>
                                <div class="valid-feedback ps-1">Great!</div>
                                <div class="invalid-feedback ps-1"> Please select Yes/No.</div>
                            </div>
                            <hr>
                            <h4 class="mb-3">School Form 9</h4>
                            <h5>REPORT OF LEARNING PROGRESS AND ACHIEVEMENT</h5>
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr class="fw-bold" style="font-size: 14px;">
                                        <td style="width: 100px;">Semester</td>
                                        <td style="width: 150px;">Subject Type</td>
                                        <td>Subject Title</td>
                                        <td style="width: 100px;">Quarter Grade</td>
                                        <td style="width: 100px;">Quarter Grade</td>
                                        <td style="width: 130px;">Sem Final Grade</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 1; $i <= 10; $i++) {
                                        echo
                                        '
                                    <tr>
                                        <td>
                                            <input type="text" name="sem1' . $i . '" placeholder="Semester" class="form-control bg-body-tertiary text-center" value="1st" readonly />
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_type1' . $i . '">
                                                <option value="" selected>--Subject type--</option>
                                                <option value="Core">Core</option>
                                                <option value="Applied">Applied</option>
                                                <option value="Specialized">Specialized</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_title1' . $i . '">
                                                <option value="" selected>--Subject title--</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="first1' . $i . '" id="first1' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="number" name="second1' . $i . '" id="second1' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="text" name="final_grade1' . $i . '" id="final_grade1' . $i . '" placeholder="Final Grade" class="form-control bg-body-tertiary" readonly />
                                        </td>
                                    </tr>
                                        ';
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="6" class="fw-bold text-center">2nd Semester</td>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= 10; $i++) {
                                        echo
                                        '
                                    <tr>
                                        <td>
                                            <input type="text" name="sem2' . $i . '" placeholder="Semester" class="form-control bg-body-tertiary text-center" value="2nd" readonly />
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_type2' . $i . '">
                                                <option value="" selected>--Subject type--</option>
                                                <option value="Core">Core</option>
                                                <option value="Applied">Applied</option>
                                                <option value="Specialized">Specialized</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select-sm bg-body-tertiary w-100" name="subject_title2' . $i . '">
                                                <option value="" selected>--Subject title--</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="first2' . $i . '" id="first2' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage2ndSem(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="number" name="second2' . $i . '" id="second2' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage2ndSem(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="text" name="final_grade2' . $i . '" id="final_grade2' . $i . '" placeholder="Final Grade" class="form-control bg-body-tertiary" readonly />
                                        </td>
                                    </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <h5>LEARNING MODALITY</h5>
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
                                        <td class="fw-bold" style="font-size: small;">BLENDED</td>
                                        <td><input type="checkbox" name="blended_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="blended_q4" value="1" class="w-100"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold" style="font-size: small;">MODULAR DISTANCE LEARNING</td>
                                        <td><input type="checkbox" name="mdl_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="mdl_q4" value="1" class="w-100"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold" style="font-size: small;">IN-PERSON</td>
                                        <td><input type="checkbox" name="ip_q1" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q2" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q3" value="1" class="w-100"></td>
                                        <td><input type="checkbox" name="ip_q4" value="1" class="w-100"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h5>REPORT ON LEARNER’S OBSERVED VALUES</h5>
                            <!-- OBSERVED VALUES -->
                            <div class="d-flex justify-content-center align-items-center">
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
                                <img src="../images/sf9ov.png" alt="sf9 OV table" class="ms-3">
                            </div>
                            <hr>
                            <h4 class="mb-3">School Form 10 Remedial</h4>
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
                                                <option value="" selected readonly>Subject title</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="first' . $i . '" id="first' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage10(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="number" name="second' . $i . '" id="second' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage10(' . $i . ')" step="0.01" max="100" />
                                        </td>
                                        <td>
                                            <input type="text" name="final_grade' . $i . '" id="final_grade' . $i . '" placeholder="Final Grade" class="form-control bg-body-tertiary" readonly />
                                        </td>
                                        <td>
                                            <input type="text" id="action' . $i . '" name="action' . $i . '" placeholder="Action" class="form-control bg-body-tertiary" readonly />
                                        </td>
                                    </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <table class="table table-sm table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <td>Semester</td>
                                        <td>Start of remedial</td>
                                        <td>End of remedial</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="remedialSem1" value="1st" readonly></td>
                                        <td><input type="date" name="startDate1"></td>
                                        <td><input type="date" name="endDate1"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="remedialSem2" value="2nd" readonly></td>
                                        <td><input type="date" name="startDate2"></td>
                                        <td><input type="date" name="endDate2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer pe-0">
                            <div class="ms-auto" style="width: 150px;">
                                <button type="submit" class="btn btn-primary" name="submit">Add</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
        </main>
    </div>
    <!-- SF9 SCRIPT -->
    <script>
        function calculateAverage(index) {
            var first = parseFloat(document.getElementById("first1" + index).value);
            var second = parseFloat(document.getElementById("second1" + index).value);
            var finalGrade = document.getElementById("final_grade1" + index);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade1" + index).value = roundedAverage;
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
        function calculateAverage2ndSem(index) {
            var first = parseFloat(document.getElementById("first2" + index).value);
            var second = parseFloat(document.getElementById("second2" + index).value);
            var finalGrade = document.getElementById("final_grade2" + index);

            if (!isNaN(first) && !isNaN(second)) {
                var average = (first + second) / 2;
                var roundedAverage = Math.round(average);
                document.getElementById("final_grade2" + index).value = roundedAverage;
                finalGrade.value = roundedAverage;

                if (average >= 75) {
                    finalGrade.style.color = 'green';
                } else {
                    finalGrade.style.color = 'red';
                }
            }
        }
    </script>
    <!-- SF10 REMEDIAL SCRIPT -->
    <script>
        function calculateAverage10(index) {
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
if (isset($_POST['submit'])) {
    $studentName = $studentRow['name'];
    $sex = $studentRow['sex'];
    $section = $studentRow['section'];
    $lrn = $studentRow['lrn'];

    $completed = $conn->escape_string($_POST['completed']);
    $nc = $conn->escape_string($_POST['nc']);

    $sf5b = "SELECT * FROM `sf5b` WHERE `student_name` = '$studentName'";
    $sf5bResult = $conn->query($sf5b);
    $sf5bCount = $sf5bResult->num_rows;

    if ($sf5bCount > 0) {
        echo "<script>location.href = 'student_table.php?errmsg=Duplication of entry in SF5B!';</script>";
    } else {
        $insertSF5B = "INSERT INTO `sf5b`(`lrn`, `student_name`, `completed`, `nc`, `section`, `sex`) VALUES ('$lrn','$studentName','$completed','$nc','$section','$sex')";
        $conn->query($insertSF5B);
    }

    for ($i = 1; $i <= 10; $i++) {
        $sem1 = $_POST['sem1' . $i];
        $subjectType1 = $_POST['subject_type1' . $i];
        $subjectTitle1 = $_POST['subject_title1' . $i];
        $first1 = (float)$_POST['first1' . $i];
        $second1 = (float)$_POST['second1' . $i];
        $finalGrade1 = ($first1 + $second1) / 2;

        $stmt = $conn->prepare("INSERT INTO `sf9`(`student_name`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`, `sex`, `section`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $studentName, $subjectType1, $subjectTitle1, $first1, $second1, $finalGrade1, $sem1, $sex, $section);
        $stmt->execute();
        $stmt->close();
    }

    for ($i = 1; $i <= 10; $i++) {
        $sem2 = $_POST['sem2' . $i];
        $subjectType2 = $_POST['subject_type2' . $i];
        $subjectTitle2 = $_POST['subject_title2' . $i];
        $first2 = (float)$_POST['first2' . $i];
        $second2 = (float)$_POST['second2' . $i];
        $finalGrade2 = ($first2 + $second2) / 2;

        $stmt2 = $conn->prepare("INSERT INTO `sf9`(`student_name`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`, `sex`, `section`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("sssssssss", $studentName, $subjectType2, $subjectTitle2, $first2, $second2, $finalGrade2, $sem2, $sex, $section);
        $stmt2->execute();
        $stmt2->close();
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
    }

    //SF 10 REMEDIAL
    for ($i = 1; $i <= 5; $i++) {
        $sem = $conn->real_escape_string($_POST['semester' . $i]);
        $subjectType = $conn->real_escape_string($_POST['subject_type' . $i]);
        $subjectTitle = $conn->real_escape_string($_POST['subject_title' . $i]);
        $first = (float)$_POST['first' . $i];
        $second = (float)$_POST['second' . $i];
        $finalGrade = ($first + $second) / 2;
        $action = $conn->real_escape_string($_POST['action' . $i]);

        $sql = "INSERT INTO `sf10remedial`(`student_name`, `subject_type`, `subject_title`, `old_grade`, `new_grade`, `final_grade`, `semester`,`action`, `sex`, `section`) VALUES ('$studentName','$subjectType','$subjectTitle','$first','$second','$finalGrade','$sem','$action', '$sex', '$section')";
        $sqlResult = $conn->query($sql);
    }

    $startDate1 = $_POST['startDate1'];
    $endDate1 = $_POST['endDate1'];
    $startDate2 = $_POST['startDate2'];
    $endDate2 = $_POST['endDate2'];

    $check = "SELECT * FROM `sf10remedialDate` WHERE `student_name` = '$studentName'";
    $checkResult = $conn->query($check);
    $checkCount = $checkResult->num_rows;

    if ($checkCount > 0) {
        echo ("<script>location.href = 'student_table.php?errmsg=Duplication of entry in SF10 remedial!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `sf10remedialdate`( `student_name`, `start_date1`, `end_date1`, `start_date2`, `end_date2`) VALUES ('$studentName','$startDate1','$endDate1','$startDate2','$endDate2')";
        $insertResult = $conn->query($insert);
        echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
        exit();
    }
}
?>