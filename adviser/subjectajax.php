<?php
include("../config.php");
session_start();
$sectionName = $_SESSION['section'];
$section = "SELECT * FROM `section` WHERE `name` = '$sectionName' AND is_archived = 0";
$sectionResult = $conn->query($section);
$sectionRow = $sectionResult->fetch_assoc();
$grade = $sectionRow['grade'];
$strand = $sectionRow['strand'];
$output = '';
$subjectType = $_POST['subjectType'];
$semester = $_POST['semester'];

$select = "SELECT * FROM `subject` WHERE `subject_type` = '$subjectType' AND `semester` = '$semester' AND `grade` = '$grade' AND(`strand` = '$strand' OR `strand` = 'All')";
$result = mysqli_query($conn, $select);

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}
echo $output;
