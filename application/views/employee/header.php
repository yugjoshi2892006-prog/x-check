<?php

$CI =& get_instance();

$CI->load->model('Profile_model');

$profile = $CI->Profile_model->getProfile();

?>
<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--favicon-->
    <!-- <link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png"> -->
        <link rel="icon" href="<?= base_url('assets/images/small_logo.png') ?>" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--plugins-->
    <link href="<?= base_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">

    <!-- loader-->
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">

    <!-- Google Fonts (CDN) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- App Styles -->
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sass/semi-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sass/bordered-theme.css') ?>">

    <title>X-Check employee site </title>

    <style>
        /* ========================================================
       XCHECK EXACT COLOR SCHEME OVERRIDE
       ======================================================== */

        /* 1. TOP LEFT LOGO AREA - White Box */
        .sidebar-wrapper .sidebar-header {
            background: #ffffff !important;
            border-bottom: 1px solid #f0f0f0 !important;
            border-right: 1px solid #f0f0f0 !important;
        }

        .sidebar-wrapper .sidebar-header .logo-text {
            color: #39c7c7 !important;
            font-weight: 700 !important;
        }

        .sidebar-wrapper .mobile-toggle-icon i {
            color: #39c7c7 !important;
        }

        /* 2. SIDEBAR - Default FULL width */
        .sidebar-wrapper {
            background: #39c7c7 !important;
            border-right: none !important;
            width: 250px !important;
            min-width: 250px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            height: 100% !important;
            z-index: 11 !important;
            transition: width 0.3s ease, transform 0.3s ease !important;
            overflow: hidden !important;
        }

        /* COLLAPSED STATE - toggled class lagane pe */
        .wrapper.toggled .sidebar-wrapper {
            width: 70px !important;
            min-width: 70px !important;
        }

        /* LOGO BOX */
        .company-logo-box {
            background: #fff;
            height: 70px !important;
            padding: 8px 15px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            box-sizing: border-box !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        #logoFull {
            max-width: 160px !important;
            max-height: 54px !important;
            width: auto !important;
            height: auto !important;
            display: block !important;
            object-fit: contain !important;
            transition: all 0.3s ease !important;
        }

        /* Logo small when collapsed (no separate icon asset available, so we just shrink the same logo) */
        .wrapper.toggled #logoFull {
            max-width: 45px !important;
            max-height: 45px !important;
        }

        #logoIcon {
            display: none;
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        /* Sidebar Menu Items */
        .sidebar-wrapper .metismenu {
            background: #39c7c7 !important;
        }

        .sidebar-wrapper .metismenu a {
            color: #ffffff !important;
            background: transparent !important;
            display: flex !important;
            align-items: center !important;
            padding: 12px 18px !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        /* Parent Icon */
        .sidebar-wrapper .metismenu .parent-icon {
            min-width: 30px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            flex-shrink: 0 !important;
        }

        .sidebar-wrapper .metismenu .parent-icon i {
            font-size: 22px !important;
            color: #ffffff !important;
        }

        /* Menu Title - visible by default */
        .sidebar-wrapper .metismenu a .menu-title {
            display: inline-block !important;
            opacity: 1 !important;
            visibility: visible !important;
            white-space: nowrap !important;
            transition: opacity 0.2s ease !important;
            margin-left: 8px !important;
        }

        /* Hide menu title when collapsed */
        .wrapper.toggled .sidebar-wrapper .metismenu a .menu-title {
            opacity: 0 !important;
            visibility: hidden !important;
            width: 0 !important;
            margin-left: 0 !important;
        }

        /* Arrow - hide when collapsed */
        .sidebar-wrapper .metismenu .has-arrow:after {
            color: #ffffff !important;
            transition: opacity 0.2s ease !important;
        }

        .wrapper.toggled .sidebar-wrapper .metismenu .has-arrow:after {
            opacity: 0 !important;
        }

        /* Hover State - Pill Shape */
        .sidebar-wrapper .metismenu a:hover,
        .sidebar-wrapper .metismenu a:focus {
            background: rgba(255, 255, 255, 0.20) !important;
            color: #ffffff !important;
            border-radius: 0 30px 30px 0 !important;
            margin-right: 15px !important;
        }

        /* Active Menu State */
        .sidebar-wrapper .metismenu .mm-active>a,
        .sidebar-wrapper .metismenu li.active>a {
            background: rgba(255, 255, 255, 0.30) !important;
            color: #ffffff !important;
            border-radius: 0 30px 30px 0 !important;
            margin-right: 15px !important;
        }

        /* Submenus */
        .sidebar-wrapper .metismenu ul {
            background: rgba(0, 0, 0, 0.05) !important;
        }

        /* Hide submenus when collapsed */
        .wrapper.toggled .sidebar-wrapper .metismenu ul {
            display: none !important;
        }

        .sidebar-wrapper .metismenu ul a {
            color: #ffffff !important;
            padding-left: 55px !important;
        }

        .sidebar-wrapper .metismenu ul a:hover {
            background: rgba(255, 255, 255, 0.20) !important;
            border-radius: 0 30px 30px 0 !important;
            margin-right: 15px !important;
        }

        /* 3. TOPBAR - Teal/Cyan */
        .topbar {
            background: #39c7c7 !important;
            border-bottom: none !important;
            left: 250px !important;
            width: calc(100% - 250px) !important;
            position: fixed !important;
            top: 0 !important;
            z-index: 10 !important;
            height: 70px !important;
            transition: left 0.3s ease, width 0.3s ease !important;
        }

        /* Topbar shift when collapsed */
        .wrapper.toggled .topbar {
            left: 70px !important;
            width: calc(100% - 70px) !important;
        }

        .topbar .navbar {
            background: transparent !important;
            height: 70px !important;
            min-height: 70px !important;
        }

        .topbar .mobile-toggle-menu {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            color: #ffffff !important;
            cursor: pointer !important;
        }

        .topbar .mobile-toggle-menu i {
            color: #ffffff !important;
            font-size: 26px !important;
        }

        .topbar .navbar i {
            color: #ffffff !important;
        }

        /* Logo itself is also clickable to toggle */
        .company-logo-box {
            cursor: pointer !important;
        }

        /* ========================================================
       PROFILE DROPDOWN CUSTOM STYLING 
       ======================================================== */

        .profile-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #ffffff !important;
            background: #ffffff;
        }

        .profile-card {
            width: 270px;
            border-radius: 18px;
            padding: 0;
            border: none;
            overflow: hidden;
            margin-top: 12px;
        }

        .profile-card-header {
            background: #e9f1ff;
            padding: 18px;
            border-radius: 18px 18px 0 0;
        }

        .profile-name {
            font-weight: 600;
            font-size: 16px;
        }

        .profile-role {
            font-size: 14px;
            color: #6c757d;
        }

        .profile-card-body {
            padding: 12px 0;
        }

        .profile-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: 0.2s;
        }

        .profile-item i {
            font-size: 20px;
        }

        .profile-item:hover {
            background: #f5f7fa;
        }

        /* Page content background */
        .page-wrapper {
            background: #f4fafa !important;
            margin-left: 250px !important;
            margin-top: 70px !important;
            transition: margin-left 0.3s ease !important;
        }

        .wrapper.toggled .page-wrapper {
            margin-left: 70px !important;
        }


        .profile-trigger {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #f5a623;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .profile-trigger img {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: contrast(1.3) brightness(0.85);
        }

        .profile-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
        }

        /* ========================================================
       RESPONSIVE: TABLET (≤ 991px)
       Sidebar becomes an off-canvas drawer; topbar/content go full width
       ======================================================== */
        @media (max-width: 991px) {

            .sidebar-wrapper {
                width: 250px !important;
                min-width: 250px !important;
                transform: translateX(-100%) !important;
                box-shadow: 4px 0 24px rgba(0, 0, 0, 0.25) !important;
            }

            /* On tablet/mobile, "toggled" means OPEN (drawer slides in) instead of collapsed-to-icons */
            .wrapper.toggled .sidebar-wrapper {
                width: 250px !important;
                min-width: 250px !important;
                transform: translateX(0) !important;
            }

            .wrapper.toggled #logoFull {
                max-width: 160px !important;
                max-height: 54px !important;
            }

            .wrapper.toggled .sidebar-wrapper .metismenu a .menu-title {
                opacity: 1 !important;
                visibility: visible !important;
                width: auto !important;
                margin-left: 8px !important;
            }

            .wrapper.toggled .sidebar-wrapper .metismenu .has-arrow:after {
                opacity: 1 !important;
            }

            .wrapper.toggled .sidebar-wrapper .metismenu ul {
                display: block !important;
            }

            .topbar,
            .wrapper.toggled .topbar {
                left: 0 !important;
                width: 100% !important;
            }

            .page-wrapper,
            .wrapper.toggled .page-wrapper {
                margin-left: 0 !important;
            }

            /* Dark overlay behind the open drawer, tap to close */
            .xc-emp-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 10;
            }

            .wrapper.toggled .xc-emp-sidebar-overlay {
                display: block;
            }
        }

        @media (max-width: 575px) {
            .sidebar-wrapper {
                width: 80vw !important;
                min-width: 80vw !important;
                max-width: 280px !important;
            }

            .wrapper.toggled .sidebar-wrapper {
                width: 80vw !important;
                min-width: 80vw !important;
                max-width: 280px !important;
            }

            .topbar {
                height: 60px !important;
            }

            .topbar .navbar {
                height: 60px !important;
                min-height: 60px !important;
            }

            .page-wrapper {
                margin-top: 60px !important;
            }

            .profile-avatar {
                width: 36px;
                height: 36px;
            }

            .profile-card {
                width: 240px;
            }
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!-- overlay used on tablet/mobile to dim content behind the open drawer -->
        <div class="xc-emp-sidebar-overlay" id="xcEmpSidebarOverlay"></div>

        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">

            <div class="sidebar-header company-logo-box" id="xcEmpLogoToggle"
                title="Click to collapse / expand sidebar">
                <img id="logoFull" src="<?= base_url('assets/images/small_logo.png') ?>" alt="X-CHECK Logo">
            </div>

            <!--navigation-->
            <ul class="metismenu" id="menu">

                <!-- Dashboard -->
                <li>
                    <a href="<?= base_url('employee/dashboard'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <!-- Layout Plan -->
                <li>
                    <a href="<?= base_url('employee/layout_plans'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-map-alt'></i>
                        </div>
                        <div class="menu-title">Layout Plan</div>
                    </a>
                </li>

                <!-- Layout Process -->
                <li>
                    <a href="<?= base_url('employee/layout_process'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-git-branch'></i>
                        </div>
                        <div class="menu-title">Layout Process</div>
                    </a>
                </li>

                <!-- Master -->


            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->

        <!--start header -->
        <header>
            <div class="topbar">
                <nav class="navbar navbar-expand gap-2 align-items-center">
                    <div class="mobile-toggle-menu d-flex" id="xcEmpMenuToggle"><i class='bx bx-menu'></i></div>

                    <div class="dropdown ms-auto me-4 position-relative">
                        <?php

                        $id = $this->session->userdata('id');
                        $role = $this->session->userdata('role');

                        if ($role == 'customer') {

                            $employee = $this->db
                                ->select('users.*, companies.company_name')
                                ->from('users')
                                ->join('companies', 'companies.id = users.company_id', 'left')
                                ->where('users.id', $id)
                                ->get()
                                ->row();

                        } else {

                            $employee = $this->db
                                ->select('team_members.*, companies.company_name')
                                ->from('team_members')
                                ->join('companies', 'companies.id = team_members.company_id', 'left')
                                ->where('team_members.id', $id)
                                ->get()
                                ->row();

                        }


                        $user_name = !empty($employee->name)
                            ? $employee->name
                            : 'Employee';

                        $business_name = !empty($employee->company_name)
                            ? $employee->company_name
                            : '';

                        $profile_image = !empty($employee->profile_photo)
                            ? base_url('uploads/profile/' . $employee->profile_photo)
                            : base_url('assets/images/user.png');
                        ?>

                        <!-- Avatar Button -->
                        <a href="#" class="profile-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= $profile_image ?>" class="profile-avatar">
                        </a>

                        <!-- Custom Dropdown Card -->
                        <div class="dropdown-menu dropdown-menu-end profile-card shadow-lg">
                            <div class="profile-card-header">
                                <div class="profile-name">
                                    <?= $user_name ?>
                                </div>
                                <div class="profile-role">
                                    <?= $business_name ?>
                                </div>
                            </div>

                            <div class="profile-card-body">

                                <a href="<?= base_url('employee/profile') ?>" class="profile-item">
                                    <span class="profile-item-icon"><i class="bx bx-user"></i></span>
                                    <span>My Profile</span>
                                </a>

                                <!-- <a href="<?= base_url('plan') ?>" class="profile-item">
        <i class="bx bx-package"></i>
        <span>Plan</span>
    </a> -->

                                <!-- <a href="<?= base_url('auth/change_password') ?>" class="profile-item">
        <i class="bx bx-lock-alt"></i>
        <span>Change Password</span>
    </a> -->

                                <a href="<?= base_url('auth/logout') ?>" class="profile-item logout">
                                    <span class="profile-item-icon"><i class="bx bx-log-out"></i></span>
                                    <span>Log Out</span>
                                </a>

                            </div>

                            <style>
                                .profile-item {
                                    display: flex;
                                    align-items: center;
                                    gap: 12px;
                                }

                                .profile-item-icon {
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    width: 20px;
                                    height: 20px;
                                    flex-shrink: 0;
                                }

                                .profile-item-icon i {
                                    font-family: 'boxicons' !important;
                                    font-style: normal !important;
                                    font-weight: normal !important;
                                    font-variant: normal !important;
                                    text-transform: none !important;
                                    line-height: 1;
                                    speak: none;
                                    -webkit-font-smoothing: antialiased;
                                    -moz-osx-font-smoothing: grayscale;

                                    font-size: 18px !important;
                                    color: #6b7280 !important;
                                    -webkit-text-fill-color: #6b7280 !important;
                                    opacity: 1 !important;
                                    visibility: visible !important;
                                    display: inline-block !important;
                                }

                                .profile-item:hover .profile-item-icon i {
                                    color: #0fb4a0 !important;
                                    -webkit-text-fill-color: #0fb4a0 !important;
                                }

                                .profile-item.logout .profile-item-icon i {
                                    color: #ef4444 !important;
                                    -webkit-text-fill-color: #ef4444 !important;
                                }
                            </style>
                        </div>
                    </div>
                </nav>
            </div>
            <script>
                $(document).ready(function () {

                    var STORAGE_KEY = 'xc_emp_sidebar_toggled';

                    function syncLogo() {
                        if ($(".wrapper").hasClass("toggled")) {
                            $("#logoFull").hide();
                            $("#logoIcon").show();
                        } else {
                            $("#logoFull").show();
                            $("#logoIcon").hide();
                        }
                    }

                    function doToggle() {
                        $(".wrapper").toggleClass("toggled");
                        syncLogo();
                        localStorage.setItem(
                            STORAGE_KEY,
                            $(".wrapper").hasClass("toggled") ? "1" : "0"
                        );
                    }

                    // Restore saved state on load
                    if (localStorage.getItem(STORAGE_KEY) === "1") {
                        $(".wrapper").addClass("toggled");
                    }
                    syncLogo();

                    // Both the hamburger icon and the logo box trigger the toggle
                    $("#xcEmpMenuToggle, #xcEmpLogoToggle").on("click", function (e) {
                        e.preventDefault();
                        doToggle();
                    });

                    // Tap the dimmed overlay (mobile/tablet only) to close the drawer
                    $("#xcEmpSidebarOverlay").on("click", function () {
                        if ($(window).width() <= 991 && $(".wrapper").hasClass("toggled")) {
                            doToggle();
                        }
                    });

                    // Tapping a menu link on mobile/tablet should also close the drawer
                    $("#menu a").on("click", function () {
                        if ($(window).width() <= 991 && $(".wrapper").hasClass("toggled")) {
                            doToggle();
                        }
                    });

                });
            </script>
        </header>
        <!--end header -->

