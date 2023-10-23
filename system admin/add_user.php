<?php
include("../config.php");

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = md5($_POST["password"]);
    $password2 = $_POST["password"];
    $user_type = mysqli_real_escape_string($conn, $_POST["user_type"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    $select = "SELECT * FROM user WHERE username = '$username' AND `name` = '$name'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        echo ("<script>location.href = 'user_table.php?errmsg=The class adviser account already exist / The class advisory is already been assigned!';</script>");
        exit();
    } else {
        $insert = "INSERT INTO `user`(`name`, `username`, `password`, `password2`, `user_type`, `status`) VALUES ('$name', '$username', '$password', '$password2', '$user_type', '$status')";
        mysqli_query($conn, $insert);
        echo ("<script>location.href = 'user_table.php?msg=Account successfully registered!';</script>");
        exit();
    }
}
