<!DOCTYPE html>
<html lang="en-GB">

<head>
    
    <?php 
   
    foreach ($site_settings as $rows) {
        if ($rows['category'] == 'site_settings') {
            $title = $rows['content']->name ?? 'Eastman Crusher Company Pvt. Ltd.';
            $favicon_file_id = isset($rows['content']->favicon_file_id) ? $rows['content']->favicon_file_id : '';
            $logo_file_id = isset($rows['content']->logo_file_id) ? $rows['content']->logo_file_id : '';
            $favicon_data = $this->file_model->get($favicon_file_id);
            $logo_data = $this->file_model->get($logo_file_id);
            $description = $rows['content']->description ?? '';
        }
    } ?>
    <meta charset="UTF-8">
    <link data-optimized="2" rel="stylesheet" href="assets/public/css/litespeed.css" />
    <title>
        <?= $title; ?>
    </title>
    <meta name="description" content="<?= $description; ?>">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= base_url('file/open/') ?><?= isset($logo_data) ? $favicon_data->slug : ''; ?>">

    <!--<link rel="icon" type="image/png" sizes="32x32"-->
    <!--	href="https:/somtamlabs.com/wp-content/themes/somtamlabs/assets/public/img/favicon/favicon-32x32.png" />-->

    <link rel='preload' as='style'
        href="https:/fonts.googleapis.com/css2?family=Cairo:wght@500;600;800;900&family=Monoton&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <link rel='stylesheet'
        href="https:/fonts.googleapis.com/css2?family=Cairo:wght@500;600;800;900&family=Monoton&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/animate.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>public/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/meanmenu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/spacing.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/menu/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="<?= base_url() ?>assets/public/menu/js/jquery-2.2.4.min.js"></script>
</head>

<body>
<?php  //pp($_SERVER['SCRIPT_URI']);
$current_url=$_SERVER['REQUEST_URI'];
$url_segments = parse_url($current_url);
$path_segments = explode('/', $url_segments['path']);
?>

    <!--<div id="preloader"></div>-->

    <!--<header class="wow fadeInDown" data-wow-duration="1s" data-wow-delay="0s">-->
    <!--	<div class="container">-->
    <!--		<a href="https:/squaretechsolution.com/" class="logo">squaretechsolution</a>-->
    <!--		<nav class="main-navigation">-->
    <!--			<ul>-->
    <!--				<li id="menu-item-46"-->
    <!--					class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item current-menu-ancestor current-menu-parent menu-item-has-children">-->
    <!--					<a href="#services">SERVICES</a>-->
    <!--					<ul class="sub-menu">-->
    <!--						<li id="menu-item-48"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#app-mobiles">MOBILE APPLICATIONS</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-47"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#web-design">WEB DESIGN AND GRAPHICS</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-50"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#digital-marketing">DIGITAL MARKETING</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-1794"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#erp-crm">ERP & CRM</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-1716"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#testing-maintenance">TESTING & MAINTENANCE</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-1795"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#social-media">SOCIAL MEDIA</a>-->
    <!--						</li>-->
    <!--					</ul>-->
    <!--				</li>-->
    <!--				<li id="menu-item-51"-->
    <!--					class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--					<a href="#references">Our work</a>-->
    <!--				</li>-->
    <!--				<li id="menu-item-52"-->
    <!--					class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--					<a href="#process">PROCESS</a>-->
    <!--				</li>-->
    <!--				<li id="menu-item-53"-->
    <!--					class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--					<a href="#equipe">team</a>-->
    <!--				</li>-->
    <!--				<li id="menu-item-54"-->
    <!--					class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--					<a href="#valeurs">VALUES</a>-->
    <!--				</li>-->
    <!--				<li id="menu-item-560"-->
    <!--					class="hide_mobile menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children">-->
    <!--					<a href="#">Contact</a>-->
    <!--					<ul class="sub-menu">-->
    <!--						<li id="menu-item-56"-->
    <!--							class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
    <!--							<a href="#contact">Contact Us</a>-->
    <!--						</li>-->
    <!--						<li id="menu-item-561" class=" menu-item menu-item-type-custom menu-item-object-custom"><a-->
    <!--								href="careers/">CAREERS</a></li>-->
    <!--					</ul>-->
    <!--				</li>-->
    <!--			</ul>-->
    <!--			<div class="site_lang">-->
    <!--				<div class="language_select">-->
    <!--					<span class="lang_toggle"></span>-->
    <!--					<ul class="languages_list">-->
    <!--						<li class="lang-item lang-item-5 lang-item-en current-lang lang-item-first"><a lang="en-GB"-->
    <!--								hreflang="en-GB" href="https:/somtamlabs.com"><img-->
    <!--									src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+/+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3///aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn/WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg=="-->
    <!--									alt="English" width="16" height="11" style="width: 16px; height: 11px;" /><span-->
    <!--									style="margin-left:0.3em;">en</span></a></li>-->
    <!--						<li class="lang-item lang-item-8 lang-item-fr"><a lang="fr-FR" hreflang="fr-FR"-->
    <!--								href="https:/somtamlabs.com/"><img-->
    <!--									src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAbFBMVEVzldTg4ODS0tLxDwDtAwDjAADD0uz39/fy8vL3k4nzgna4yOixwuXu7u7s6+zn5+fyd2rvcGPtZljYAABrjNCpvOHrWkxegsqfs93NAADpUUFRd8THAABBa7wnVbERRKa8vLyxsLCoqKigoKClCvcsAAAAXklEQVR4AS3JxUEAQQAEwZo13Mk/R9w5/7UERJCIGIgj5qfRJZEpPyNfCgJTjMR1eRRnJiExFJz5Mf1PokWr/UztIjRGQ3V486u0HO55m634U6dMcf0RNPfkVCTvKjO16xHA8miowAAAAABJRU5ErkJggg=="-->
    <!--									alt="Français" width="16" height="11" style="width: 16px; height: 11px;" /><span-->
    <!--									style="margin-left:0.3em;">fr</span></a></li>-->
    <!--					</ul>-->
    <!--				</div>-->
    <!--			</div>-->

    <!--		</nav>-->

    <!--	</div>-->
    <!--</header>-->
    <div class="top_contact_menu">
        <div class="container">
            <div class="top_contact_menu_inner">
                <div class="top_left_menu">
                    <p><i class="fa fa-envelope"></i><span><a
                                href="mailto:admin@squaretechsolution.com">admin@squaretechsolution.com</a></span></p>
                    <p><i class="fa fa-phone"></i><span><a href="tel:033-22480351"> 033-22480351</a></span></p>

                </div>
                <div class="top_right_menu">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--Menu Start-->
    <div id="strickymenu" class="menu-area">
        <div class="container">
            <div class="row nav-menu-inner">
                <div class="col-lg-2 col-12">
                    <div class="logo">
                        <a href="<?= base_url() ?>">
                            <img src="<?= base_url('file/open/') ?><?= isset($logo_data) ? $logo_data->slug : ''; ?>">
                        </a>
                    </div>

                </div>
                <div class="mobile-menu">
                </div>
                <div class="col-lg-10 col-12 main-menu">
                    <div class="main-menu-item">
                        <ul class="nav-menu" id="active_btnnav">

                            <li class="active_btn"><a href="<?= base_url() ?>">Home</a></li>
                            <!-- <li class="menu-item-has-children active_btn <?= isPageActive($path_segments[1]) ? 'active' : ''; ?>"><a href="javascript:void;" class="chl">Products </a>
                                <ul>
                                    <?php
                                    if ($categories) :
                                        foreach ($categories as $cat) {

                                    ?>
                                            <li class="active_btn for_children_menu"><a href="<?= base_url() ?>product/category/<?= $cat['slug']; ?>" data-slug="<?= $cat['slug']; ?>" class="prod_slug"><?= $cat['name']; ?></a>
                                            </li>
                                           
                                    <?php
                                        }
                                    endif
                                    ?>
                                </ul>
                            </li>

                            <?php if ($pages['data']) :
                                foreach ($pages['data'] as $rows) {
                                    if (empty($rows['subcategory'])) {
                                        if (($rows['slug'] == "latestnews")) {
                            ?>
                                            <li class="active_btn for_children_menu">
                                                <a href="<?= base_url() . 'page/b/' . $rows['slug']; ?>"><?= $rows['name']; ?></a>
                                            </li>

                                        <?php
                                        } else {

                                        ?>
                                            <li class="active_btn for_children_menu"><a href="<?= base_url() . 'page/' . $rows['slug']; ?>"><?= $rows['name']; ?></a></li>
                                        <?php
                                        }
                                    } else {

                                        ?>
                                        <li class="menu-item-has-children active_btn"><a href="javascript:void;" class="chl"><?= $rows['name']; ?></a>
                                            <ul>
                                                <?php
                                                foreach ($rows['subcategory'] as $rows) {
                                                ?>
                                                    <li class="active_btn for_children_menu"><a href="<?= base_url() . 'page/' . $rows['slug']; ?>"><?= $rows['sub_category']; ?></a>
                                                    </li>


                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>

                            <?php
                                    }
                                }
                            endif;
                            ?>-->

                            <li id="menu-item-46"
                                class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item current-menu-ancestor current-menu-parent menu-item-has-children">
                                <a href="#services">SERVICES</a>
                                <ul class="sub-menu">
                                    <?php
                                    if ($categories) :
                                        foreach ($categories as $key=> $cat) {

                                    ?>
                                    <li id="menu-item-<?=$key;?>"
                                        class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                                        <a href="#<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
                                    </li>
                                     <?php
                                        }
                                    endif
                                    ?>
                                    <!--<li id="menu-item-47"-->
                                    <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                                    <!--    <a href="#web-design">WEB DESIGN AND GRAPHICS</a>-->
                                    <!--</li>-->
                                    <!--<li id="menu-item-50"-->
                                    <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                                    <!--    <a href="#digital-marketing">DIGITAL MARKETING</a>-->
                                    <!--</li>-->
                                    <!--<li id="menu-item-1794"-->
                                    <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                                    <!--    <a href="#erp-crm">ERP & CRM</a>-->
                                    <!--</li>-->
                                    <!--<li id="menu-item-1716"-->
                                    <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                                    <!--    <a href="#testing-maintenance">TESTING & MAINTENANCE</a>-->
                                    <!--</li>-->
                                    <!--<li id="menu-item-1795"-->
                                    <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                                    <!--    <a href="#social-media">SOCIAL MEDIA</a>-->
                                    <!--</li>-->
                                </ul>
                            </li>
                            <?php if ($pages['data']) :
                                foreach ($pages['data'] as $pg=> $page) {
                            ?>
                            <li id="menu-item-1<?= $pg; ?>"
                                class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                                <a href="#<?= $page['slug']; ?>"><?= $page['name']; ?></a>
                            </li>
                            <?php
                                        }
                                    endif
                                    ?>
                            <!--<li id="menu-item-52"-->
                            <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                            <!--    <a href="#process">Proccess</a>-->
                            <!--</li>-->
                            <!--<li id="menu-item-53"-->
                            <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                            <!--    <a href="#equipe">Teams</a>-->
                            <!--</li>-->
                            <!--<li id="menu-item-54"-->
                            <!--    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                            <!--    <a href="#valeurs">Values</a>-->
                            <!--</li>-->
                            <!--<li id="menu-item-560"-->
                            <!--    class="hide_mobile menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children">-->
                            <!--    <a href="#">Contact</a>-->
                            <!--    <ul class="sub-menu">-->
                            <!--        <li id="menu-item-56"-->
                            <!--            class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                            <!--            <a href="#contact">Contact Us</a>-->
                            <!--        </li>-->
                            <!--        <li id="menu-item-561"-->
                            <!--            class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">-->
                            <!--            <a href="#careers">Careers</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                        </ul>
                    </div>

                    <div class="searchbar">
                        <div class="search-button"><i class="fa fa-search search-icon"></i></div>
                        <form action="<?= base_url() ?>product/search" method="get" accept-charset="utf-8">
                            <div class="input-group input-search">
                                <input type="text" class="form-control" placeholder="Search for ..."
                                    name="search_string">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="form1"><i
                                            class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Menu End-->