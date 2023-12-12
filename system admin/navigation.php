<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-uppercase" href="dashboard.php"><?php echo $_SESSION['user_type'] ?></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <div class="ms-auto me-0" style="width: 55px;">
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="account.php">Account</a></li>
                    <li><a class="dropdown-item" href="school_settings.php">School settings</a></li>
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
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class=" sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Sub</div>
                    <!-- FACULTY -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#facultyCollapse" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        User
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="facultyCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="user_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                User table
                            </a>
                        </nav>
                    </div>
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
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#subjectCollapse" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        Subject
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="subjectCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="subject_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Subject table
                            </a>
                        </nav>
                    </div>
                    <!-- SCHOOL YEAR -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#schoolyearCollapse" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        School Year
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="schoolyearCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="sy_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                S.Y table
                            </a>
                        </nav>
                    </div>
                    <!-- SECTION -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#sectionCollapse" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-user-group"></i>
                        </div>
                        Section
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="sectionCollapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="section_table.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Section table
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer" style="background: #343a40;">
                <div class="small">Logged in as:</div>
                <span class="text-capitalize"><?php echo $_SESSION['name'] ?></span>
            </div>
        </nav>
    </div>