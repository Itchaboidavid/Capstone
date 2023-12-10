<?php
include("../config.php");
session_start();

$id = $_GET['id'];

//ARCHIVED
$default = "UPDATE semester SET is_archived = 1 WHERE is_archived = 0";
$conn->query($default);

$archiveStudents = "UPDATE student SET is_archived = 1 WHERE is_archived = 0";
$conn->query($archiveStudents);

$archiveSections = "UPDATE section SET is_archived = 1 WHERE is_archived = 0";
$conn->query($archiveSections);

//ACTIVE
$active = "UPDATE semester SET is_archived = 0 WHERE id = '$id'";
$conn->query($active);

$activeStudents = "UPDATE student SET is_archived = 0 WHERE semester_id = '$id'";
$conn->query($activeStudents);

$activeSections = "UPDATE section SET is_archived = 0 WHERE semester_id = '$id'";
$conn->query($activeSections);

echo ("<script>location.href = 'semester_table.php?msg=Semester archived successfully!';</script>");
exit();
$conn->close();
