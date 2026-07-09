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
    <link rel="icon" href="" type="image/png">
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



    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <title>X-CHECK Admin</title>

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

        /* Logo small when collapsed */
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
        }

        .topbar .mobile-toggle-menu i {
            color: #ffffff !important;
            font-size: 26px !important;
        }

        .topbar .navbar i {
            color: #ffffff !important;
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
            .xc-admin-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 10;
            }

            .wrapper.toggled .xc-admin-sidebar-overlay {
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
        <div class="xc-admin-sidebar-overlay" id="xcAdminSidebarOverlay"></div>

        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">

            <div class="sidebar-header company-logo-box">
                <img id="logoFull" src="<?= base_url('assets/images/big_logo.jpeg') ?>" alt="Logo">
            </div>

            <!--navigation-->
            <ul class="metismenu" id="menu">

                <!-- Dashboard -->
                <li>
                    <a href="<?= base_url('index.php/admin/dashboard'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <!-- Project Monitoring -->
                <li>
                    <a href="<?= base_url('index.php/project/project_monitoring'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-line-chart'></i>
                        </div>
                        <div class="menu-title">Project Monitoring</div>
                    </a>
                </li>

                <!-- Master -->
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class='bx bx-data'></i>
                        </div>
                        <div class="menu-title">Master</div>
                    </a>

                    <ul>
                        <li>
                            <a href="<?= base_url('index.php/project/project_list'); ?>">
                                <i class='bx bx-buildings'></i>
                                Projects
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/team'); ?>">
                                <i class='bx bx-group'></i>
                                Team
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/customer'); ?>">
                                <i class='bx bx-user'></i>
                                Customer
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/folder'); ?>">
                                <i class='bx bx-folder'></i>
                                Folder List
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Attendance -->
                <li>
                    <a href="<?= base_url('index.php/admin/attendance_projects'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-calendar-check'></i>
                        </div>
                        <div class="menu-title">Attendance</div>
                    </a>
                </li>

                <!-- Manpower Reports -->
                <li>
                    <a href="<?= base_url('index.php/admin/manpower_report_list'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-bar-chart-square'></i>
                        </div>
                        <div class="menu-title">Manpower Reports</div>
                    </a>
                </li>

                <!-- Materials -->
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class='bx bx-package'></i>
                        </div>
                        <div class="menu-title">Materials</div>
                    </a>

                    <ul>
                        <li>
                            <a href="<?= base_url('index.php/materials/categories'); ?>">
                                <i class='bx bx-category'></i>
                                Category
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/materials/subcategories'); ?>">
                                <i class='bx bx-list-ul'></i>
                                Sub Category
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Layouts -->
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class='bx bx-layout'></i>
                        </div>
                        <div class="menu-title">Layouts</div>
                    </a>

                    <ul>
                        <li>
                            <a href="<?= base_url('index.php/layout_member'); ?>">
                                <i class='bx bx-user-plus'></i>
                                Members List
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/layout_member/layout_plan_list'); ?>">
                                <i class='bx bx-map-alt'></i>
                                Layout Plan
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url('index.php/layout_member/layout_process'); ?>">
                                <i class='bx bx-git-branch'></i>
                                Layout Process
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->

        <!--start header -->
        <header>
            <div class="topbar">

                <nav class="navbar navbar-expand gap-2 align-items-center">
                    <div class="mobile-toggle-menu d-flex"><i class='bx bx-menu'></i></div>

                    <div class="d-flex align-items-center ms-auto me-4 gap-3">

                        <!-- Dark Mode Toggle -->
                        <li class="nav-item dark-mode d-none d-sm-flex">
                            <a class="nav-link dark-mode-icon" href="javascript:;">
                                <i class='bx bx-moon'></i>
                            </a>
                        </li>

                        <div class="dropdown position-relative">
                            <?php
                            $admin = $this->session->userdata('admin');
                            $user_name = !empty($profile->contact_person)
                                ? $profile->contact_person
                                : 'Admin';

                            $business_name = !empty($profile->company_name)
                                ? $profile->company_name
                                : 'Manager';
                            $profile_image = !empty($profile->profile_image)
                                ? base_url('assets/uploads/profile/' . $profile->profile_image)
                                : base_url('assets/images/programmer.png');
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

                                    <a href="<?= base_url('index.php/profile') ?>" class="profile-item">
                                        <span class="profile-item-icon"><i class='bx bx-user'></i></span>
                                        <span>My Profile</span>
                                    </a>

                                    <a href="<?= base_url('index.php/plan') ?>" class="profile-item">
                                        <span class="profile-item-icon"><i class='bx bx-package'></i></span>
                                        <span>Plan</span>
                                    </a>

                                    <a href="<?= base_url('index.php/auth/change_password') ?>" class="profile-item">
                                        <span class="profile-item-icon"><i class='bx bx-lock-alt'></i></span>
                                        <span>Change Password</span>
                                    </a>

                                    <a href="<?= base_url('index.php/auth/logout') ?>" class="profile-item logout">
                                        <span class="profile-item-icon"><i class='bx bx-log-out'></i></span>
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
                    </div>
                </nav>
            </div>

            <style>
                .xc-darkmode-btn {
                    width: 38px;
                    height: 38px;
                    border-radius: 50%;
                    align-items: center;
                    justify-content: center;
                    background: rgba(255, 255, 255, 0.16);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    backdrop-filter: blur(6px);
                    -webkit-backdrop-filter: blur(6px);
                    transition: all 0.25s ease;
                    flex-shrink: 0;
                }

                .xc-darkmode-btn i {
                    font-family: 'boxicons' !important;
                    font-size: 19px !important;
                    color: #ffffff !important;
                    -webkit-text-fill-color: #ffffff !important;
                    line-height: 1;
                }

                .xc-darkmode-btn:hover {
                    background: rgba(255, 255, 255, 0.3);
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                }

                .xc-darkmode-btn.active {
                    background: #1a1a2e;
                    border-color: #1a1a2e;
                }

                .xc-darkmode-btn.active i {
                    color: #ffd166 !important;
                    -webkit-text-fill-color: #ffd166 !important;
                }
            </style>

            <!-- <script>
                $(document).ready(function () {

                    $(".mobile-toggle-menu").click(function () {

                        $(".wrapper").toggleClass("toggled");

                        if ($(".wrapper").hasClass("toggled")) {

                            $("#logoFull").hide();
                            $("#logoIcon").show();

                        } else {

                            $("#logoFull").show();
                            $("#logoIcon").hide();

                        }

                    });

                    // Tap the dimmed overlay (mobile/tablet only) to close the drawer
                    $("#xcAdminSidebarOverlay").on("click", function () {
                        if ($(window).width() <= 991 && $(".wrapper").hasClass("toggled")) {
                            $(".mobile-toggle-menu").trigger("click");
                        }
                    });

                    // Tapping a menu link on mobile/tablet should also close the drawer
                    // (skip parent links with the "has-arrow" submenu toggle, so submenus can still open)
                    $("#menu a").not(".has-arrow").on("click", function () {
                        if ($(window).width() <= 991 && $(".wrapper").hasClass("toggled")) {
                            $(".mobile-toggle-menu").trigger("click");
                        }
                    });

                    // Dark mode toggle button visual state
                    // (only toggles the "active" class here — wire up actual theme-switch logic separately if you have one)
                    $(".xc-darkmode-btn").on("click", function () {
                        $(this).toggleClass("active");
                        $(this).find("i").toggleClass("bx-moon bx-sun");
                    });

                });
            </script> -->
        </header>
        <!--end header -->
