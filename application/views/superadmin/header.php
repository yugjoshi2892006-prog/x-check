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

    <title>bhagwati Enterprise - Admin</title>

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
            transition: width 0.3s ease !important;
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
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">

            <div class="sidebar-header company-logo-box">
                <img id="logoFull" src="<?= base_url('assets/images/big_logo.jpeg') ?>" alt="Logo">
            </div>

            <!--navigation-->
            <ul class="metismenu" id="menu">

                <!-- Dashboard -->
                <li>
                    <a href="<?= base_url('superadmin/dashboard'); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <!-- Project Monitoring -->
                <li>
                    <a href="<?= base_url(''); ?>">
                        <div class="parent-icon">
                            <i class='bx bx-cctv'></i>
                        </div>
                        <div class="menu-title">Project Monitoring</div>
                    </a>
                </li>

                <!-- Master -->
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class='bx bx-grid-alt'></i>
                        </div>
                        <div class="menu-title">Master</div>
                    </a>

                    <ul>

                        <!-- Projects -->
                        <li>
                            <a href="<?= base_url(''); ?>">
                                <i class='bx bx-building-house'></i>
                                Projects
                            </a>
                        </li>

                        <!-- Team -->
                        <li>
                            <a href="<?= base_url(''); ?>">
                                <i class='bx bx-group'></i>
                                Team
                            </a>
                        </li>

                        <!-- Customer -->
                        <li>
                            <a href="<?= base_url(''); ?>">
                                <i class='bx bx-user'></i>
                                Customer
                            </a>
                        </li>

                        <!-- Folder -->
                        <li>
                            <a href="<?= base_url(''); ?>">
                                <i class='bx bx-folder-open'></i>
                                Folder List
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

                    <div class="dropdown ms-auto me-4 position-relative">
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

                                <a href="<?= base_url('') ?>" class="profile-item">
                                    <i class="bx bx-user"></i>
                                    <span>My Profile</span>
                                </a>

                                <!-- <a href="<?= base_url('indplanex.php/') ?>" class="profile-item">
                                    <i class="bx bx-package"></i>
                                    <span>Plan</span>
                                </a> -->

                                <a href="<?= base_url('auth/change_password') ?>" class="profile-item">
                                    <i class="bx bx-lock-alt"></i>
                                    <span>Change Password</span>
                                </a>

                                <a href="<?= base_url('login/logout') ?>" class="profile-item logout">
                                    <i class="bx bx-log-out"></i>
                                    <span>Log Out</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <script>
                $(document).ready(function () {

                    $(".mobile-toggle-menu").click(function () {

                        if ($(".wrapper").hasClass("toggled")) {

                            $("#logoFull").hide();
                            $("#logoIcon").show();

                        } else {

                            $("#logoFull").show();
                            $("#logoIcon").hide();

                        }

                    });

                });
            </script>

            <script>$(document).ready(function () {

                    $(".mobile-toggle-menu").click(function () {

                        if ($(".wrapper").hasClass("toggled")) {

                            $("#logoFull").hide();
                            $("#logoIcon").show();

                        } else {

                            $("#logoFull").show();
                            $("#logoIcon").hide();

                        }

                    });

                });</script>
        </header>
        <!--end header -->
