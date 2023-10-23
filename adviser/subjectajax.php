<?php
include("../config.php");
$output = '';
$select = "SELECT * FROM `subject` WHERE `subject_type` = '" . $_POST['subjectType'] . "'";
$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}
echo $output;
