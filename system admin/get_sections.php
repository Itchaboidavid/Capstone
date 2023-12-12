<?php
include "../config.php";
session_start();

if (isset($_GET['user_type'])) {
    $userType = $_GET['user_type'];

    if ($userType === 'Clinic teacher') {
        $sectionQuery = "SELECT * FROM `section` WHERE name NOT IN (SELECT DISTINCT section FROM `user` WHERE user_type = 'Clinic teacher')";
    } else {
        $sectionQuery = "SELECT * FROM `section`";
    }

    // Execute the query and generate the options
    $sectionOptions = '';
    $sectionResult = $conn->query($sectionQuery);
    while ($sectionRow = $sectionResult->fetch_assoc()) {
        $sectionOptions .= '<option value="' . $sectionRow["name"] . '">' . $sectionRow["name"] . '</option>';
    }

    echo $sectionOptions;
}
