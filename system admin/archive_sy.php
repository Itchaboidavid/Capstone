<?php
include("../config.php");
session_start();

$id = $_GET['id'];

//ARCHIVED
$default = "UPDATE school_year SET is_archived = 1 WHERE is_archived = 0";
$conn->query($default);

$archiveStudents = "UPDATE student SET is_archived = 1 WHERE is_archived = 0";
$conn->query($archiveStudents);

$archiveSections = "UPDATE section SET is_archived = 1 WHERE is_archived = 0";
$conn->query($archiveSections);

//REMOVE SECTION OF ADVISER
$check = "SELECT * FROM user WHERE user_type = 'Adviser' AND section != ''";
$checkResult = $conn->query($check);
while ($checkRow = $checkResult->fetch_assoc()) {
    $userID = $checkRow['id'];
    $sectionName = $checkRow['section'];
    $section = "SELECT * FROM section WHERE name = '$sectionName'";
    $sectionResult = $conn->query($section);
    $sectionRow = $sectionResult->fetch_assoc();

    if ($sectionRow['is_archived'] == 1) {
        $remove = "UPDATE user SET section = '' WHERE id = '$userID'";
        $conn->query($remove);
    }
}

//ACTIVE
$active = "UPDATE school_year SET is_archived = 0 WHERE id = '$id'";
$conn->query($active);

$activeStudents = "UPDATE student SET is_archived = 0 WHERE school_year_id = '$id'";
$conn->query($activeStudents);

$activeSections = "UPDATE section SET is_archived = 0 WHERE school_year_id = '$id'";
$conn->query($activeSections);

//ADD SECTION OF ADVISER
$assign = "SELECT * FROM user WHERE user_type = 'Adviser' AND section = ''";
$assignResult = $conn->query($assign);
while ($assignRow = $assignResult->fetch_assoc()) {
    $userID = $assignRow['id'];
    $section = "SELECT * FROM section WHERE adviser_id = '$userID'";
    $sectionResult = $conn->query($section);
    if ($sectionResult->num_rows > 0) {
        $sectionRow = $sectionResult->fetch_assoc();
        $sectionName = $sectionRow['name'];

        if ($sectionRow['is_archived'] == 0) {
            $remove = "UPDATE user SET section = '$sectionName' WHERE id = '$userID'";
            $conn->query($remove);
        }
    }
}

echo ("<script>location.href = 'sy_table.php?msg=Archived successfully!';</script>");
exit();
$conn->close();
