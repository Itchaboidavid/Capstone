<?php
include("../config.php");
session_start();

$sySQL = "SELECT * FROM school_year WHERE is_archived = 0";
$syResult = $conn->query($sySQL);
$syRow = $syResult->fetch_assoc();

$school_year_id = $syRow['id'];

$sectionName = $_SESSION['section'];
$section = "SELECT * FROM `section` WHERE `name` = '$sectionName' AND is_archived = 0 AND school_year_id = '$school_year_id'";
$sectionResult = $conn->query($section);
$sectionRow = $sectionResult->fetch_assoc();
$grade = $sectionRow['grade'];
$strand = $sectionRow['strand'];
$output = '';
$subjectType = $_POST['subjectType'];
$semester = $_POST['semester'];

$selectedSubjects = $_POST['selectedSubjects'];

// Prepare and execute the query
if (empty($selectedSubjects)) {
    // For the first row, don't include conditions related to previous rows
    $select = $conn->prepare("SELECT * FROM `subject` WHERE `subject_type` = ? AND `semester` = ? AND `grade` = ? AND (`strand` = ? OR `strand` = 'All') AND `status` = 'Active'");
    $select->bind_param("ssss", $subjectType, $semester, $grade, $strand);
} else {
    // For subsequent rows, include conditions related to previous rows
    $select = $conn->prepare("SELECT * FROM `subject` WHERE `subject_type` = ? AND `semester` = ? AND `grade` = ? AND (`strand` = ? OR `strand` = 'All') AND `status` = 'Active' AND `name` NOT IN (" . implode(",", array_fill(0, count($selectedSubjects), "?")) . ")");
    $select->bind_param("ssss" . str_repeat("s", count($selectedSubjects)), $subjectType, $semester, $grade, $strand, ...$selectedSubjects);
}

$select->execute();

// Check for errors
if ($select->error) {
    die('Error executing query: ' . $select->error);
}

$result = $select->get_result();

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}
echo $output;
