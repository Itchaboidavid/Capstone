<?php
include("../config.php");

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $track = mysqli_real_escape_string($conn, $_POST["track"]);
    $strand = mysqli_real_escape_string($conn, $_POST["strand"]);
    $grade = mysqli_real_escape_string($conn, $_POST["grade"]);
    $faculty = mysqli_real_escape_string($conn, $_POST["faculty"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);

    $select_semester = "SELECT * FROM `semester` WHERE `output` = '$semester'";
    $result_semester = mysqli_query($conn, $select_semester);
    $row_semester = mysqli_fetch_assoc($result_semester);

    $semester_name = $row_semester["name"];
    $start_year = $row_semester["start_year"];
    $end_year = $row_semester["end_year"];

    $select = "SELECT * FROM `section` WHERE `name` = '$name'";
    $result = mysqli_query($conn, $select);

    $select2 = "SELECT * FROM `section` WHERE `faculty` = '$faculty'";
    $result2 = mysqli_query($conn, $select2);

    $select3 = "SELECT * FROM `section` WHERE `track` = '$track' AND `strand` = '$strand' AND `grade` = '$grade'";
    $result3 = $conn->query($select3);

    if (mysqli_num_rows($result) > 0) {
        header("location:section_table.php?errmsg=The section name already exist!");
        exit();
    } elseif (mysqli_num_rows($result2) > 0) {
        header("location:section_table.php?errmsg=The faculty is already assigned!");
        exit();
    } elseif (mysqli_num_rows($result3) > 0) {
        header("location:section_table.php?errmsg=Track, strand and grade is duplicated!");
    } else {
        $insert = "INSERT INTO `section`(`name`, `track`, `strand`, `grade`, `faculty`, `semester`, `semester_name`, `start_year`, `end_year`) VALUES ('$name','$track','$strand', '$grade', '$faculty', '$semester', '$semester_name', '$start_year', '$end_year')";
        mysqli_query($conn, $insert);
        header("location:section_table.php?msg=Section added successfully!");
        exit();
    }
}
