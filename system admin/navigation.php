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
    <div class="ms-auto me-2" style="width: 55px;">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <?php
                $id = $_SESSION['id'];
                $profilePic = "SELECT `profile_picture` FROM `user` WHERE id = '$id'";
                $profilePicResult = $conn->query($profilePic);
                $profilePicRow = $profilePicResult->fetch_assoc();
                $profilePicImage = $profilePicRow['profile_picture'];
                if ($profilePicRow['profile_picture'] != '') { ?>
                    <a class="nav-link dropdown-toggle me-lg-2 me-md-1" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../profile_pic/<?php echo $profilePicImage ?>" style="border-radius: 100px; margin-right: 0;" width="25px" height="25px">
                    </a>
                <?php } else { ?>
                    <a class="nav-link dropdown-toggle me-lg-2 me-md-1" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../profile_pic/default_profile.jpg" style="border-radius: 100px; margin-right: 0;" width="25px" height="25px">
                    </a>
                <?php }
                ?>

                <ul class="dropdown-menu dropdown-menu-end me-2" aria-labelledby="navbarDropdown">
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
                    <!-- FACULTY -->
                    <a class="nav-link collapsed" href="user_table.php">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        User
                    </a>
                    <!-- TRACK AND STRAND -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#trackStrandCollapse" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-pencil"></i>
                        </div>
                        Track and Strand
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="trackStrandCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="track_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Track table
                            </a>
                            <a class="nav-link" href="strand_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Strand table
                            </a>
                        </nav>
                    </div>
                    <!-- SUBJECT -->
                    <a class="nav-link collapsed" href="subject_table.php">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        Subject
                    </a>
                    <!-- SCHOOL YEAR -->
                    <a class="nav-link collapsed" href="sy_table.php">
                        <div class="sb-nav-link-icon">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        School Year
                    </a>
                    <!-- SECTION -->
                    <a class="nav-link collapsed" href="section_table.php">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        Section
                    </a>
                    <!-- School Settings -->
                    <a class="nav-link collapsed" href="school_settings.php">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        School Settings
                    </a>
                    <!-- About us -->
                    <a class="nav-link collapsed" href="about.php">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        About us
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background: #03045e;">
                <div class="small">Logged in as:</div>
                <span class="text-capitalize text-white"><?php echo $_SESSION['name'] ?></span>
            </div>
        </nav>
    </div>