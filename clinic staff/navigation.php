<?php
include("../config.php");
session_start();
?>

<!-- SIDENAV -->
<div class="col-auto col-md-2 min-vh-100 p-3 collapse collapse-horizontal show" id="sidenav" style="background-color:#003459;">
    <div class="d-flex justify-content-center align-items-baseline gap-3 mb-2" style="border-bottom: 2px solid gray">
        <a href="dashboard.php" style="color: white; text-shadow: 3px 3px 10px black;" class="fs-4"><i class="bi bi-person-circle"></i></a>
        <a href="dashboard.php" class="text-light text-decoration-none fw-bold fs-4">
            <p class="text-capitalize" style="text-shadow: 3px 3px 10px black;"><?php echo $_SESSION["user_type"]; ?></p>
        </a>
    </div>
    <a href="dashboard.php" class="d-flex text-decoration-none align-items-baseline text-light fs-5 mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;">
        <i class="bi bi-speedometer2 me-2"></i>
        <span>Dashboard</span>
    </a>

    <!-- STUDENTS -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#classSubmenu" role=" button">
        <i class="bi bi-people-fill me-2"></i>
        <span>Students</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-3" id="classSubmenu">
        <li class="w-100">
            <a href="student_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">Student list</span>
            </a>
        </li>
    </ul>
</div>
<div class="col">
    <!-- NAVBAR -->
    <nav class="navbar" style="height: 70px; box-shadow: 0px 3px 10px black">
        <div class="container-fluid px-3 d-flex">
            <!-- SIDENAV TOGGLER -->
            <button class="btn navbar-toggler-icon fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#sidenav" accesskey="s">
            </button>
            <!-- ACCOUNT SETTINGS -->
            <div class="dropstart">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill fs-5" style="color:#003459"></i>
                    <span class="d-none d-sm-inline mx-1 text-dark text-capitalize"><?php echo $_SESSION["name"]; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </nav>