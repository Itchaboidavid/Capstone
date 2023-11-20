<?php
include("../config.php");
session_start();

$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = $conn->query($student);
$studentRow = $studentResult->fetch_assoc();
$studentName = $studentRow['name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>EDIT SF 9</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="../index.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', 'input[name^="sem"], select[name^="subject_type"]', function() {
                var semester = $(this).closest('tr').find('input[name^="sem"]').val();
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
                            <li class="breadcrumb-item active">Edit SF 9</li>
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
                                    $sf91 = "SELECT * FROM `sf9` WHERE `student_name` = '$studentName' AND `semester` = '1st'";
                                    $sf91Result = $conn->query($sf91);
                                    $i = 1;

                                    $fetchedData = [];
                                    while ($sf91Row = $sf91Result->fetch_assoc()) {
                                        $fetchedData[$i] = $sf91Row;
                                        $i++;
                                    }
                                    for ($i = 1; $i <= 10; $i++) {
                                        echo '<tr>';

                                        // Display form fields with fetched data
                                        echo '<td>
                                            <input type="hidden" name="id' . $i . '" value="' . $fetchedData[$i]['id'] . '" />
                                            <input type="text" name="sem1' . $i . '" placeholder="Semester" class="form-control bg-body-tertiary text-center" value="1st" readonly />
                                            </td>';
                                        echo '<td><select class="form-select-sm bg-body-tertiary w-100" name="subject_type1' . $i . '">';
                                        echo '<option value="' . $fetchedData[$i]['subject_type'] . '" selected>' . $fetchedData[$i]['subject_type'] . '</option>';
                                        echo '<option value="Core">Core</option>';
                                        echo '<option value="Applied">Applied</option>';
                                        echo '<option value="Specialized">Specialized</option>';
                                        echo '</select></td>';

                                        echo '<td><select class="form-select-sm bg-body-tertiary w-100" name="subject_title1' . $i . '">';
                                        echo '<option value="' . $fetchedData[$i]['subject_title'] . '" selected>' . $fetchedData[$i]['subject_title'] . '</option>';
                                        echo '</select></td>';

                                        echo '<td><input type="number" name="first1' . $i . '" id="first1' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" value="' . $fetchedData[$i]['sem_grade1'] . '"/></td>';

                                        echo '<td><input type="number" name="second1' . $i . '" id="second1' . $i . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage(' . $i . ')" step="0.01" max="100" value="' . $fetchedData[$i]['sem_grade2'] . '" /></td>';

                                        echo '<td><input type="text" name="final_grade1' . $i . '" id="final_grade1' . $i . '" placeholder="Final Grade" class="form-control bg-body-tertiary" disabled value="' . $fetchedData[$i]['final_grade'] . '" /></td>';

                                        echo '</tr>';
                                    }

                                    ?>
                                    <!-- 2ndSEM -->
                                    <tr>
                                        <td colspan="6" class="fw-bold text-center">2nd Semester</td>
                                    </tr>
                                    <?php
                                    $sf92 = "SELECT * FROM `sf9` WHERE `student_name` = '$studentName' AND `semester` = '2nd'";
                                    $sf92Result = $conn->query($sf92);
                                    $x = 1;

                                    $fetchedData2 = [];
                                    while ($sf92Row = $sf92Result->fetch_assoc()) {
                                        $fetchedData2[$x] = $sf92Row;
                                        $x++;
                                    }
                                    for ($x = 1; $x <= 10; $x++) {
                                        echo '<tr>';

                                        // Display form fields with fetched data
                                        echo '<td>
                                            <input type="hidden" name="id2' . $x . '" value="' . $fetchedData2[$x]['id'] . '" />
                                            <input type="text" name="sem2' . $x . '" placeholder="Semester" class="form-control bg-body-tertiary text-center" value="2nd" readonly />
                                            </td>';
                                        echo '<td><select class="form-select-sm bg-body-tertiary w-100" name="subject_type2' . $x . '">';
                                        echo '<option value="' . $fetchedData2[$x]['subject_type'] . '" selected>' . $fetchedData2[$x]['subject_type'] . '</option>';
                                        echo '<option value="Core">Core</option>';
                                        echo '<option value="Applied">Applied</option>';
                                        echo '<option value="Specialized">Specialized</option>';
                                        echo '</select></td>';

                                        echo '<td><select class="form-select-sm bg-body-tertiary w-100" name="subject_title2' . $x . '">';
                                        echo '<option value="' . $fetchedData2[$x]['subject_title'] . '" selected>' . $fetchedData2[$x]['subject_title'] . '</option>';
                                        echo '</select></td>';

                                        echo '<td><input type="number" name="first2' . $x . '" id="first2' . $x . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage2ndSem(' . $x . ')" step="0.01" max="100" value="' . $fetchedData2[$x]['sem_grade1'] . '"/></td>';

                                        echo '<td><input type="number" name="second2' . $x . '" id="second2' . $x . '" placeholder="Grade" class="form-control bg-body-tertiary" oninput="calculateAverage2ndSem(' . $x . ')" step="0.01" max="100" value="' . $fetchedData2[$x]['sem_grade2'] . '" /></td>';

                                        echo '<td><input type="text" name="final_grade2' . $x . '" id="final_grade2' . $x . '" placeholder="Final Grade" class="form-control bg-body-tertiary" disabled value="' . $fetchedData2[$x]['final_grade'] . '" /></td>';

                                        echo '</tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <?php
                            $modality = "SELECT * FROM `sf9_modality` WHERE `student_name` = '$studentName'";
                            $modalityResult = $conn->query($modality);
                            $modalityRow = $modalityResult->fetch_assoc();
                            ?>
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
                                        <?php
                                        if ($modalityRow['blended_q1'] == 1) {
                                            echo  '<td><input type="checkbox" name="blended_q1" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="blended_q1" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['blended_q2'] == 1) {
                                            echo  '<td><input type="checkbox" name="blended_q2" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="blended_q2" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['blended_q3'] == 1) {
                                            echo  '<td><input type="checkbox" name="blended_q3" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="blended_q3" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['blended_q4'] == 1) {
                                            echo  '<td><input type="checkbox" name="blended_q4" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="blended_q4" value="1" class="w-100"></td>';
                                        };
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">MODULAR DISTANCE LEARNING</td>
                                        <?php
                                        if ($modalityRow['mdl_q1'] == 1) {
                                            echo  '<td><input type="checkbox" name="mdl_q1" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="mdl_q1" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['mdl_q2'] == 1) {
                                            echo  '<td><input type="checkbox" name="mdl_q2" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="mdl_q2" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['mdl_q3'] == 1) {
                                            echo  '<td><input type="checkbox" name="mdl_q3" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="mdl_q3" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['mdl_q4'] == 1) {
                                            echo  '<td><input type="checkbox" name="mdl_q4" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="mdl_q4" value="1" class="w-100"></td>';
                                        };
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">IN-PERSON</td>
                                        <?php
                                        if ($modalityRow['ip_q1'] == 1) {
                                            echo  '<td><input type="checkbox" name="ip_q1" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="ip_q1" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['ip_q2'] == 1) {
                                            echo  '<td><input type="checkbox" name="ip_q2" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="ip_q2" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['ip_q3'] == 1) {
                                            echo  '<td><input type="checkbox" name="ip_q3" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="ip_q3" value="1" class="w-100"></td>';
                                        };

                                        if ($modalityRow['ip_q4'] == 1) {
                                            echo  '<td><input type="checkbox" name="ip_q4" value="1" class="w-100" checked></td>';
                                        } else {
                                            echo  '<td><input type="checkbox" name="ip_q4" value="1" class="w-100"></td>';
                                        };
                                        ?>
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
                                <?php
                                $editOV = "SELECT * FROM `sf9_ov` WHERE `student_name` = '$studentName'";
                                $editOVResult = $conn->query($editOV);
                                $editOVRow = $editOVResult->fetch_assoc();
                                ?>
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
                                                <option value="<?php echo $editOVRow['mdq1'] ?>"><?php echo $editOVRow['mdq1'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq2" id="" required>
                                                <option value="<?php echo $editOVRow['mdq2'] ?>"><?php echo $editOVRow['mdq2'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq3" id="" required>
                                                <option value="<?php echo $editOVRow['mdq3'] ?>"><?php echo $editOVRow['mdq3'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq4" id="" required>
                                                <option value="<?php echo $editOVRow['mdq4'] ?>"><?php echo $editOVRow['mdq4'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mdq5'] ?>"><?php echo $editOVRow['mdq5'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq6" id="" required>
                                                <option value="<?php echo $editOVRow['mdq6'] ?>"><?php echo $editOVRow['mdq6'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq7" id="" required>
                                                <option value="<?php echo $editOVRow['mdq7'] ?>"><?php echo $editOVRow['mdq7'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mdq8" id="" required>
                                                <option value="<?php echo $editOVRow['mdq8'] ?>"><?php echo $editOVRow['mdq8'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mkq1'] ?>"><?php echo $editOVRow['mkq1'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq2" id="" required>
                                                <option value="<?php echo $editOVRow['mkq2'] ?>"><?php echo $editOVRow['mkq2'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq3" id="" required>
                                                <option value="<?php echo $editOVRow['mkq3'] ?>"><?php echo $editOVRow['mkq3'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq4" id="" required>
                                                <option value="<?php echo $editOVRow['mkq4'] ?>"><?php echo $editOVRow['mkq4'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mkq5'] ?>"><?php echo $editOVRow['mkq5'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq6" id="" required>
                                                <option value="<?php echo $editOVRow['mkq6'] ?>"><?php echo $editOVRow['mkq6'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq7" id="" required>
                                                <option value="<?php echo $editOVRow['mkq7'] ?>"><?php echo $editOVRow['mkq7'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkq8" id="" required>
                                                <option value="<?php echo $editOVRow['mkq8'] ?>"><?php echo $editOVRow['mkq8'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mkkq1'] ?>"><?php echo $editOVRow['mkkq1'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq2" id="" required>
                                                <option value="<?php echo $editOVRow['mkkq2'] ?>"><?php echo $editOVRow['mkkq2'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq3" id="" required>
                                                <option value="<?php echo $editOVRow['mkkq3'] ?>"><?php echo $editOVRow['mkkq3'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mkkq4" id="" required>
                                                <option value="<?php echo $editOVRow['mkkq4'] ?>"><?php echo $editOVRow['mkkq4'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mbq1'] ?>"><?php echo $editOVRow['mbq1'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq2" id="" required>
                                                <option value="<?php echo $editOVRow['mbq2'] ?>"><?php echo $editOVRow['mbq2'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq3" id="" required>
                                                <option value="<?php echo $editOVRow['mbq3'] ?>"><?php echo $editOVRow['mbq3'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq4" id="" required>
                                                <option value="<?php echo $editOVRow['mbq4'] ?>"><?php echo $editOVRow['mbq4'] ?></option>
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
                                                <option value="<?php echo $editOVRow['mbq5'] ?>"><?php echo $editOVRow['mbq5'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq6" id="" required>
                                                <option value="<?php echo $editOVRow['mbq6'] ?>"><?php echo $editOVRow['mbq6'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq7" id="" required>
                                                <option value="<?php echo $editOVRow['mbq7'] ?>"><?php echo $editOVRow['mbq7'] ?></option>
                                                <option value="AO">AO</option>
                                                <option value="SO">SO</option>
                                                <option value="RO">RO</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="mbq8" id="" required>
                                                <option value="<?php echo $editOVRow['mbq8'] ?>"><?php echo $editOVRow['mbq8'] ?></option>
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
                                <button type="submit" class="btn btn-primary" name="edit_sf9">Save</button>
                                <a href="student_table.php" type="button" class="btn btn-danger">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
        </main>
    </div>

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
if (isset($_POST['edit_sf9'])) {
    $studentName = $studentRow['name'];
    $sex = $studentRow['sex'];
    $section = $studentRow['section'];

    // Process form submission and update the database
    for ($i = 1; $i <= 10; $i++) {
        // Process form data and update the database
        $id = $_POST['id' . $i];
        $sem1 = $_POST['sem1' . $i];
        $subjectType1 = $_POST['subject_type1' . $i];
        $subjectTitle1 = $_POST['subject_title1' . $i];
        $first1 = (float)$_POST['first1' . $i];
        $second1 = (float)$_POST['second1' . $i];
        $finalGrade1 = ($first1 + $second1) / 2;

        // Update the database
        $sql = "UPDATE `sf9` SET `student_name`='$studentName',`subject_type`='$subjectType1',`subject_title`='$subjectTitle1',`sem_grade1`='$first1',`sem_grade2`='$second1',`final_grade`='$finalGrade1',`semester`='$sem1',`sex`='$sex',`section`='$section' WHERE `id` = '$id'";
        $sqlResult = $conn->query($sql);
    }

    // Process form submission and update the database
    for ($x = 1; $x <= 10; $x++) {
        // Process form data and update the database
        $id2 = $_POST['id2' . $x];
        $sem2 = $_POST['sem2' . $x];
        $subjectType2 = $_POST['subject_type2' . $x];
        $subjectTitle2 = $_POST['subject_title2' . $x];
        $first2 = (float)$_POST['first2' . $x];
        $second2 = (float)$_POST['second2' . $x];
        $finalGrade2 = ($first2 + $second2) / 2;

        // Update the database
        $sql = "UPDATE `sf9` SET `student_name`='$studentName',`subject_type`='$subjectType2',`subject_title`='$subjectTitle2',`sem_grade1`='$first2',`sem_grade2`='$second2',`final_grade`='$finalGrade2',`semester`='$sem2' WHERE `id` = '$id2'";
        $sqlResult = $conn->query($sql);
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

    $updateModality = "UPDATE `sf9_modality` SET `student_name`='$studentName',`blended_q1`='$blendedQ1',`blended_q2`='$blendedQ2',`blended_q3`='$blendedQ3',`blended_q4`='$blendedQ4',`mdl_q1`='$mdlQ1',`mdl_q2`='$mdlQ2',`mdl_q3`='$mdlQ3',`mdl_q4`='$mdlQ4',`ip_q1`='$ipQ1',`ip_q2`='$ipQ2',`ip_q3`='$ipQ3',`ip_q4`='$ipQ4' WHERE `student_name` = '$studentName'";
    $updateModalityResult = $conn->query($updateModality);

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

    $updateOV = "UPDATE `sf9_ov` SET `student_name`='$studentName',`mdq1`='$mdq1',`mdq2`='$mdq2',`mdq3`='$mdq3',`mdq4`='$mdq4',`mdq5`='$mdq5',`mdq6`='$mdq6',`mdq7`='$mdq7',`mdq8`='$mdq8',`mkq1`='$mkq1',`mkq2`='$mkq2',`mkq3`='$mkq3',`mkq4`='$mkq4',`mkq5`='$mkq5',`mkq6`='$mkq6',`mkq7`='$mkq7',`mkq8`='$mkq8',`mkkq1`='$mkkq1',`mkkq2`='$mkkq2',`mkkq3`='$mkkq3',`mkkq4`='$mkkq4',`mbq1`='$mbq1',`mbq2`='$mbq2',`mbq3`='$mbq3',`mbq4`='$mbq4',`mbq5`='$mbq5',`mbq6`='$mbq6',`mbq7`='$mbq7',`mbq8`='$mbq8' WHERE `student_name` = '$studentName'";
    $updateOVResult = $conn->query($updateOV);

    echo "<script>location.href = 'student_table.php?msg=SF 9 updated successfully!';</script>";
    exit();
}
?>