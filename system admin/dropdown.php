<?php
include("../config.php");
$output = '';
$tn = $_POST['trackName'];
$select = "SELECT * FROM `strand` WHERE `track` = '$tn' ORDER BY `name` ASC";
$result = mysqli_query($conn, $select);
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
}
echo $output;
