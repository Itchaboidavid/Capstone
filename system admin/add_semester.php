<?php
include("../config.php");

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $start_year = mysqli_real_escape_string($conn, $_POST["start_year"]);
    $end_year = mysqli_real_escape_string($conn, $_POST["end_year"]);
    $output = $name . " (" . $start_year . " - " . $end_year . ")";

    $select = "SELECT * FROM `semester` WHERE `output` = '$output'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'semester_table.php?errmsg=The semester already exist!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `semester` (`name`,`start_year`,`end_year`,`output`) VALUES ('$name','$start_year','$end_year','$output')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'semester_table.php?msg=Semester successfully added!';</script>");
        exit();
    }
}
