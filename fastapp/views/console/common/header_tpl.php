<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $site_settings['site_setting_title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $site_settings['site_setting_description'] ?>">
    <meta name="author" content="Logic Mystery">
<script type="text/javascript">
	atOptions = {
		'key' : 'fe2fba551331bbf1ef39fcbf15780b0d',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	
</script>
    <!-- The styles -->
    <!-- <link id="bs-css" href="<?= cdn_url(); ?>css/bootstrap-spacelab.css" rel="stylesheet"> -->
    <style type="text/css">
        body {
            padding-bottom: 40px;
            background-image: url('/img/pattern-9.svg')
        }

        .sidebar-nav {
            padding: 9px 0;
        }

        .box {
            background-color: white
        }

        .odd {
            border: 1px solid lightgray;
            border-collapse: collapse;
        }

        th {
            border: 1px solid lightgray;
        }

        #myTable {
            border: 1px solid lightgray;
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        td {
            border: 1px solid lightgray;
        }

        @media only screen and (max-width: 500px) and (orientation: portrait) {
            .dropdown-toggle {
                width: 316px;
            }

            .btn-group {
                width: 343px;
            }

            .dropdown-menu {
                width: 346px;
            }

            .search-table-form #inputIcon,
            .search-table-form .datepicker {
                width: 305px !important;
            }

            .chzn-container {
                width: 343px !important;
            }

            .xt {
                margin: 3px;
            }

            #myTable {
                border: 1px solid lightgray;
                display: inline-block;
                width: 99%;
                overflow-x: scroll;
            }
        }

        @media only screen and (max-width: 800px)and (min-device-width: 501px) and (orientation: landscape) {}

        @media only screen and (max-width: 360px) and (orientation: portrait) {
            .dropdown-toggle {
                width: 266px;
            }

            .btn-group {
                width: 292px;
            }

            .dropdown-menu {
                width: 294px;
            }

            .search-table-form #inputIcon,
            .search-table-form .datepicker {
                width: 255px !important;
            }

            .chzn-container {
                width: 291px !important;
            }

            #myTable_filter {
                margin-left: -53px;
            }
        }

        @media only screen and (max-width: 640px)and (min-device-width: 361px) and (orientation: landscape) {}

        .well .gallery-controls {
            display: none !important;
        }

        .navbar-inner {
            background-image: -webkit-linear-gradient(top, #ffffff, #ffffff);
        }
    </style>
    
    <link href="<?= cdn_url(); ?>css.mini.php" rel="stylesheet">
 <script src="<?= cdn_url(); ?>js/jquery-1.7.2.min.js"></script>
    <!--<link href="<?= cdn_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">-->
    <!--    <link href="<?= cdn_url(); ?>css/charisma-app.css" rel="stylesheet">-->
    <!--    <link href="<?= cdn_url(); ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">-->
    <!--    <link href='<?= cdn_url(); ?>css/uniform.default.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/colorbox.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/jquery.cleditor.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/jquery.noty.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/noty_theme_default.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/elfinder.min.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/elfinder.theme.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/jquery.iphone.toggle.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/opa-icons.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/uploadify.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/chosen.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/chosen.min.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/bootstrap-tagsinput.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/jquery.datetimepicker.css' rel='stylesheet'>-->
    <!--    <link href='<?= cdn_url(); ?>css/fastapp.css' rel='stylesheet'>-->
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- The fav icon -->
    <link rel="shortcut icon" href="<?= cdn_url() ?>img/simplebillingsfav.png">
    <script>
        var console_url = '<?= console_url() ?>';
        var cdn_url = '<?= cdn_url() ?>';
        var page_url = '<?= base_url() . $this->uri->segment(1) ?>/<?= $this->uri->segment(2) ?>/';
        var section = '<?= isset($orderByModelData) ? $orderByModelData : '' ?>';
    </script>

    <!-- jQuery -->
   
    <script language="Javascript" type="text/javascript" src="<?= cdn_url() ?>js/edit_area/edit_area_full.js"></script>
    <? execute_hook('header'); ?>
</head>

<body>
    <div class="noty_bar noty_theme_default noty_layout_center" id="noty_xhr" style=" background-color: ghostwhite; cursor: pointer; display: none;top:0px;width: 100%;">
        <div class="noty_message"><span class="noty_text">Loading.. Just a moment</span></div>
    </div>
    <!-- topbar starts -->
    <? if ($current_user_session) { ?>

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?= console_url() ?>" style="padding:0px">
                        <img alt="logo" src="<?= cdn_url() ?>msb/msbbillingslogo.png" style="height:50px" />
                    </a>

                    <? /*                         * ****top menu******* */ ?>
                    <? $this->load->view('console/elements/top_navigation_tpl.php'); ?>
                    <? /*                         * ****top menu******* */ ?>

                    <!-- user dropdown starts -->
                    <? $this->load->view('console/elements/user_dropdown_tpl'); ?>
                    <!-- user dropdown ends -->
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- topbar ends -->
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- left menu starts -->
                <? //$this->load->view('console/elements/left_navigation_tpl'); 
                ?>
                <!-- left menu ends -->

                <noscript>
                    <div class="alert alert-block span10">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                </noscript>

                <!-- content starts -->
                <div id="content" class="">
                    <? $this->load->view('console/elements/breadcrumb_tpl') ?>

                <? } ?>