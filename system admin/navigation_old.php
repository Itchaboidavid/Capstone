<?php
include("../config.php");
session_start();
include("user_modal.php");
include("section_modal.php");
include("subject_modal.php");
include("strand_modal.php");
include("semester_modal.php");
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

    <!-- TRACK -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#trackSubmenu" role="button">
        <i class="bi bi-pencil me-2"></i>
        <span>Track</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="trackSubmenu">
        <li class="w-100">
            <a href="track_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">List of track</span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addTrackModal">
                <i class="bi bi-journal-plus"></i>
                <span class="d-none d-sm-inline ms-1">Add track</span>
            </a>
        </li>
    </ul>

    <!-- STRAND -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#strandSubmenu" role="button">
        <i class="bi bi-bar-chart-steps me-2"></i>
        <span>Strand</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="strandSubmenu">
        <li class="w-100">
            <a href="strand_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">List of strand<span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addStrandModal">
                <i class="bi bi-journal-plus"></i>
                <span class="d-none d-sm-inline ms-1">Add strand<span>
            </a>
        </li>
    </ul>

    <!-- SECTION -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#sectionSubmenu" role="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-video3 me-2" viewBox="0 0 16 16">
            <path d="M14 9.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm-6 5.7c0 .8.8.8.8.8h6.4s.8 0 .8-.8-.8-3.2-4-3.2-4 2.4-4 3.2Z" />
            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h5.243c.122-.326.295-.668.526-1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v7.81c.353.23.656.496.91.783.059-.187.09-.386.09-.593V4a2 2 0 0 0-2-2H2Z" />
        </svg>
        <span>Section</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="sectionSubmenu">
        <li class="w-100">
            <a href="section_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list me-1"></i>
                <span class="d-none d-sm-inline ms-1">List of section</span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                <i class="fa-solid fa-people-group"></i>
                <span class="d-none d-sm-inline ms-1">Add section</span>
            </a>
        </li>
    </ul>

    <!-- USER -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#userSubmenu" role="button">
        <!-- <i class="bi bi-people me-2"></i> -->
        <i class="bi bi-person me-2"></i>
        <span>User</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="userSubmenu">
        <li class="w-100">
            <a href="user_table.php" class="nav-link text-light">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">List of users</span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <!-- <i class="bi bi-person-plus-fill"></i> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                </svg>
                <span class="d-none d-sm-inline ms-1">Add user</span>
            </a>
        </li>
    </ul>

    <!-- SUBJECT -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#subjectSubmenu" role="button">
        <i class="bi bi-journal me-2"></i>
        <span>Subject</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="subjectSubmenu">
        <li class="w-100">
            <a href="subject_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">List of subject</span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                <i class="bi bi-journal-plus"></i>
                <span class="d-none d-sm-inline ms-1">Add subject</span>
            </a>
        </li>
    </ul>

    <!-- SEMESTER -->
    <a class="d-flex text-decoration-none text-light fs-5 align-items-center mb-2 pb-2" style="border-bottom: 1px solid gray; text-shadow: 1px 1px 1px black;" data-bs-toggle="collapse" href="#semesterSubmenu" role="button">
        <i class="bi bi-box-seam me-2"></i>
        <span>Semester</span>
        <span class="dropdown-toggle align-self-center ms-auto"></span>
    </a>
    <ul class="collapse nav mb-2" id="semesterSubmenu">
        <li class="w-100">
            <a href="semester_table.php" class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-sm-inline ms-1">List of Semester</span>
            </a>
        </li>
        <li class="w-100">
            <a href="#" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#addSemesterModal">
                <i class="fa-solid fa-add"></i>
                <span class="d-none d-sm-inline ms-1">Add Semester</span>
            </a>
        </li>
    </ul>
</div>

<div class="col">
    <!-- NAVBAR -->
    <nav class="navbar sticky-top bg-body-tertiary" style="height: 70px; box-shadow: 0px 3px 10px black" id="topnav">
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
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </nav>