<?php
include("../config.php");
session_start();
//REMEDIAL
$id = $_GET["id"];
$student = "SELECT * FROM `student` WHERE `id` = '$id'";
$studentResult = mysqli_query($conn, $student);
$studentRow = mysqli_fetch_assoc($studentResult);
$studentName = $studentRow['name'];

if (isset($_POST['submitRemedial'])) {
    $subject_typeRemedial = mysqli_real_escape_string($conn, $_POST["subject_typeRemedial"]);
    $subject_titleRemedial = mysqli_real_escape_string($conn, $_POST["subject_titleRemedial"]);
    $final_gradeRemedial = mysqli_real_escape_string($conn, $_POST["final_gradeRemedial"]);
    $remedial_mark = mysqli_real_escape_string($conn, $_POST["remedial_mark"]);
    $recomputed_fg = round(($final_gradeRemedial + $remedial_mark) / 2);
    $action_remedial = ($recomputed_fg >= 75) ? "Passed" : "Failed";
    $sem_remedial = mysqli_real_escape_string($conn, $_POST["sem_remedial"]);

    $checkRemedial = "SELECT * FROM `sf10Remedial` WHERE `student_name` = '$studentName' AND `subject_titleRemedial` = '$subject_titleRemedial'";
    $checkResultRemedial = $conn->query($checkRemedialRemedial);
    $checkCountRemedial = $checkResultRemedial->num_rows;

    if ($checkCountRemedial > 0) {
        echo ("<script>location.href = 'student_table.php?errmsg=Subject is already graded!';</script>");
    } else {
        $insert = "INSERT INTO `sf10Remedial`(`student_name`, `subject_typeRemedial`, `subject_titleRemedial`, `final_gradeRemedial`, `remedial_mark`, `recomputed_fg`, `action_remedial`, `sem_remedial`) VALUES ('$studentName','$subject_typeRemedial','$subject_titleRemedial','$final_gradeRemedial','$remedial_mark','$recomputed_fg','$action_remedial','$sem_remedial')";
        $insertResult = $conn->query($insert);
        echo ("<script>location.href = 'student_table.php?msg=Information added successfully!';</script>");
        exit();
    }
}
