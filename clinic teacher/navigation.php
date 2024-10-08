<?php
if (!isset($_SESSION['id'])) {
    header("location:../index.php");
}
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #001233;">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-uppercase fs-6" href="dashboard.php"><?php echo $_SESSION['user_type'] ?></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <div class="ms-auto me-0" style="width: 55px;">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    $id = $_SESSION['id'];
                    $profilePic = "SELECT `profile_picture` FROM `user` WHERE id = '$id'";
                    $profilePicResult = $conn->query($profilePic);
                    $profilePicRow = $profilePicResult->fetch_assoc();
                    $profilePicImage = $profilePicRow['profile_picture'];
                    if ($profilePicRow['profile_picture'] != '') { ?>
                        <img src="../profile_pic/<?php echo $profilePicImage ?>" style="border-radius: 100px; margin-right: 0;" width="25px" height="25px">
                    <?php } else { ?>
                        <img src="../profile_pic/default_profile.jpg" style="border-radius: 100px; margin-right: 0;" width="25px" height="25px">
                    <?php }
                    ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="account.php">Account</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #001233;">
            <div class=" sb-sidenav-menu">
                <div class="nav mt-3">
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="section_table.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Sections
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background: #03045e;">
                <div class="small">Logged in as:</div>
                <span class="text-capitalize text-white"><?php echo $_SESSION['name'] ?></span>
            </div>
        </nav>
    </div>