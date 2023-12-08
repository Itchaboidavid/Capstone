<?php
include "../config.php";
session_start();

if (isset($_GET['user_type'])) {
    $userType = $_GET['user_type'];

    // Adjust the section query based on the user type
    if ($userType === 'adviser') {
        $sectionQuery = "SELECT * FROM `section` WHERE name NOT IN (SELECT DISTINCT section FROM `user` WHERE user_type = 'adviser')";
    } elseif ($userType === 'clinic teacher') {
        $sectionQuery = "SELECT * FROM `section` WHERE name NOT IN (SELECT DISTINCT section FROM `user` WHERE user_type = 'clinic teacher')";
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
