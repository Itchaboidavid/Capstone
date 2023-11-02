<?php
include("../config.php");
session_start();
$faculty = $_SESSION['name'];
$section = "SELECT * FROM `section` WHERE `faculty` = '$faculty'";
$sectionResult = $conn->query($section);
$sectionRow = $sectionResult->fetch_assoc();
$grade = $sectionRow['grade'];

$output = '';
$subjectType = $_POST['subjectType'];
$semester = $_POST['semester'];

$select = "SELECT * FROM `subject` WHERE `subject_type` = '$subjectType' AND `semester_name` = '$semester' AND `grade` = $grade";
$result = mysqli_query($conn, $select);

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}
echo $output;
