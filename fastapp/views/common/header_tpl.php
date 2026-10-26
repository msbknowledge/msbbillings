<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $site_settings['site_setting_title'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $site_settings['site_setting_description'] ?>">
        <meta name="author" content="Logic Mystery">

        <!-- The styles -->
        <link id="bs-css" href="<?= cdn_url(); ?>css/bootstrap-spacelab.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="<?= cdn_url(); ?>css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="<?= cdn_url(); ?>css/charisma-app.css" rel="stylesheet">
        <link href="<?= cdn_url(); ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href='<?= cdn_url(); ?>css/uniform.default.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/colorbox.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/jquery.cleditor.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/jquery.noty.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/noty_theme_default.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/elfinder.min.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/elfinder.theme.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/opa-icons.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/uploadify.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/chosen.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/bootstrap-tagsinput.css' rel='stylesheet'>
        <link href='<?= cdn_url(); ?>css/jquery.datetimepicker.css' rel='stylesheet'>
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- The fav icon -->
        	<!--<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>img/msb.png" />-->
        <!--<link rel="shortcut icon" href="<?= cdn_url() ?>uploads/fav.png">-->
         <link rel="shortcut icon" href="<?= cdn_url() ?>img/favicon.ico">
        <script>
            var console_url = '<?= console_url() ?>';
            var cdn_url = '<?= cdn_url() ?>';
            var page_url = '<?= console_url() . $this->uri->segment(2) ?>/';
            var section = '<?= isset($orderByModelData) ? $orderByModelData : '' ?>';
        </script>

        <!-- jQuery -->
        <script src="<?= cdn_url(); ?>js/jquery-1.7.2.min.js"></script>
        <script language="Javascript" type="text/javascript" src="<?= cdn_url() ?>js/edit_area/edit_area_full.js"></script>
    <? execute_hook('header');?>
    </head>

    <body>
        <div class="noty_bar noty_theme_default noty_layout_center" id="noty_xhr" style=" background-color: ghostwhite; cursor: pointer; display: none;top:0px;width: 100%;"><div class="noty_message"><span class="noty_text">Loading.. Just a moment</span></div></div>
        <!-- topbar starts -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?= console_url() ?>" style="padding:0px"> 
                        <img alt="logo" src="<?= cdn_url() ?>uploads/medicalbillings.png" style="height:50px" /> 
                    </a>
					<?/******top menu********/?>
					 <? if ($current_user_session): ?>
                    <? $this->load->view('console/elements/top_navigation_tpl.php'); ?>
                    <? endif;?>
					<?/******top menu********/?>
                    
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
                <? //$this->load->view('console/elements/left_navigation_tpl'); ?>
                <!-- left menu ends -->

                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <!-- content starts -->
                <div id="content" class="">
<script type="text/javascript">
//   ( function() {
//     if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
//     var unit = {"calltype":"async[2]","publisher":"logicmystery","width":728,"height":90,"sid":"Chitika Default"};
//     var placement_id = window.CHITIKA.units.length;
//     window.CHITIKA.units.push(unit);
//     document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
// }());
</script>
<!--<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>-->
                    <? $this->load->view('console/elements/breadcrumb_tpl')  ?>