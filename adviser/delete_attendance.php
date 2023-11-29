<?php
include("../config.php");
session_start();

if (isset($_REQUEST['delete_attendance'])) {
    $studentId = $_REQUEST['student_id'];
    $day = $_REQUEST['day'];
    $month = $_REQUEST['month'];

    try {
        $deleteStmt = $conn->prepare("DELETE FROM sf2 WHERE student_id = ? AND day = ? AND attendance_month = ?");
        $deleteStmt->bind_param("isi", $studentId, $day, $month);
        $deleteStmt->execute();
        $deleteStmt->close();

        // You can return a success message or any relevant data if needed
        echo "Attendance record deleted successfully!";
    } catch (Exception $e) {
        // Handle exceptions or errors
        echo "Error: " . $e->getMessage();
    }
}
