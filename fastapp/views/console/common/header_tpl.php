<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings Console' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?= isset($site_settings['site_setting_description']) ? $site_settings['site_setting_description'] : '' ?>">
    <meta name="author" content="MsbBillings">
    <meta name="theme-color" content="#35aa47">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('img/simplebillingsfav.png') ?>" type="image/x-icon">

    <!-- Google Fonts & Smart School Theme CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/backend/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/style-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/themes/default/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/themes/default/ss-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/custom_style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/jquery.mCustomScrollbar.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/plugins/datatables/dataTables.bootstrap.css') ?>">

    <style>
        /* Modern AdminLTE / Smart School adjustments */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f5f9;
        }
        .well {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        .noty_bar {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 99999;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.15);
            font-size: 14px;
            font-weight: 500;
        }
    </style>

    <!-- Core Scripts -->
    <script src="<?= base_url('assets/backend/custom/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/bootstrap/js/bootstrap.min.js') ?>"></script>

    <script>
        var console_url = '<?= console_url() ?>';
        var cdn_url = '<?= cdn_url() ?>';
        var page_url = '<?= base_url() . $this->uri->segment(1) ?>/<?= $this->uri->segment(2) ?>/';
        var section = '<?= isset($orderByModelData) ? $orderByModelData : '' ?>';

        // Pre-apply sidebar state to avoid layout shift
        (function() {
            try {
                if (localStorage.getItem('ss_sidebar_state') === 'collapsed' && window.innerWidth > 767) {
                    document.documentElement.classList.add('sidebar-collapse');
                    window.addEventListener('DOMContentLoaded', function() {
                        document.body.classList.add('sidebar-collapse');
                    });
                }
            } catch(e) {}
        })();
    </script>

    <? execute_hook('header'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="noty_bar noty_theme_default noty_layout_center" id="noty_xhr" style="background-color: #f8fafc; border: 1px solid #e2e8f0; cursor: pointer; display: none;">
        <div class="noty_message"><span class="noty_text"><i class="fa fa-spinner fa-spin"></i> Processing...</span></div>
    </div>

    <?php if ($current_user_session): ?>
    <div class="wrapper">
        <!-- Main Top Header Navbar -->
        <header class="main-header" id="alert">
            <!-- Logo -->
            <a href="<?= console_url() ?>" class="logo">
                <span class="logo-mini">
                    <img src="<?= base_url('assets/backend/images/s_logo.png') ?>" style="height: 28px; width: auto;" alt="Logo" onerror="this.onerror=null; this.src='<?= base_url('msb/msbbillingslogo.png') ?>';">
                </span>
                <span class="logo-lg">
                    <img src="<?= base_url('assets/backend/images/s_logo.png') ?>" style="height: 28px; width: auto; margin-right: 8px;" alt="Logo" onerror="this.onerror=null; this.src='<?= base_url('msb/msbbillingslogo.png') ?>';">
                    <span style="font-size: 16px; font-weight: 700; color: #fff; letter-spacing: -0.3px;">
                        <?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?>
                    </span>
                </span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar Toggle Button -->
                <a href="javascript:void(0)" onclick="collapseSidebar()" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="Toggle Sidebar" style="color: #fff; font-size: 16px; padding: 15px 18px; float: left; text-decoration: none;">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Navigation</span>
                </a>

                <!-- Session / Node title -->
                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-4 hidden-xs">
                    <span class="sidebar-session" style="color: #cbd5e1; font-size: 14px; font-weight: 600; line-height: 50px; display: inline-block;">
                        <i class="fa fa-building-o" style="color: #35aa47; margin-right: 6px;"></i>
                        <?= defined('NODE') ? ucfirst(NODE) : 'Console' ?> Management
                    </span>
                </div>

                <!-- Right Menu: User profile dropdown & quick links -->
                <div class="navbar-custom-menu pull-right">
                    <?php $this->load->view('console/elements/user_dropdown_tpl'); ?>
                </div>
            </nav>
        </header>

        <!-- Left Sidebar Navigation -->
        <?php $this->load->view('console/elements/left_navigation_tpl'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Breadcrumb Header -->
            <?php $this->load->view('console/elements/breadcrumb_tpl'); ?>

            <!-- Main content section -->
            <section class="content" id="content" style="padding: 15px 20px;">
    <?php endif; ?>