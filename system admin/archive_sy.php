<?php
include("../config.php");
session_start();

$id = $_GET['id'];

//ARCHIVED
$default = "UPDATE school_year SET is_archived = 1 WHERE is_archived = 0";
$conn->query($default);

// $archiveStudents = "UPDATE student SET is_archived = 1 WHERE is_archived = 0";
// $conn->query($archiveStudents);

$archiveSections = "UPDATE section SET is_archived = 1 WHERE is_archived = 0";
$conn->query($archiveSections);

//ACTIVE
$active = "UPDATE school_year SET is_archived = 0 WHERE id = '$id'";
$conn->query($active);

// $activeStudents = "UPDATE student SET is_archived = 0 WHERE semester_id = '$id'";
// $conn->query($activeStudents);

$activeSections = "UPDATE section SET is_archived = 0 WHERE school_year_id = '$id'";
$conn->query($activeSections);

echo ("<script>location.href = 'sy_table.php?msg=Archived successfully!';</script>");
exit();
$conn->close();
