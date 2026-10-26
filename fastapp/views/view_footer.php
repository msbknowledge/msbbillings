<?php foreach ($site_settings as $rows) {if ($rows['category'] == 'site_settings') {
    $office_map=$rows['content']->office_link??'';
    $factory_map=$rows['content']->factory_link??'';
    $fb_link=$rows['content']->fb_link??'';
    $youtube_link=$rows['content']->youtube_link??'';
    $twitter_link=$rows['content']->twitter_link??'';
    $linkedin_link=$rows['content']->linkedin_link??'';
    $office_address=$rows['content']->o_address??'';
    $factory_address=$rows['content']->f_address??'';
    $mobile_no=$rows['content']->mobile_no??'';
    $email=$rows['content']->email??'';
    $fax_no=$rows['content']->fax_no??'';
}
        }        ?>
<footer>
    

		<div class="home-email home-email-quote section white-section scroll-container">
			<div class="container">
				<div class="block-title wow fadeInUp" data-wow-delay="1s" data-wow-duration=".5s">
					<div class="block-title__heading">TELL US ABOUT</div>
					<h2>Your project</h2>
					<p></p>
				</div>
				<div class="img rotate-decor wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
					<img data-lazyloaded="1"
						src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
						data-src="<?=base_url();?>assets/public/images/decorations/wheel.png"
						alt="wheel" /><noscript><img
							src="<?=base_url();?>assets/public/images/decorations/wheel.png"
							alt="wheel" /></noscript>
				</div>
			</div>
		</div>

		<div class="home-contact section white-section scroll-container" id="contact-us">
			<div class="container">
				<div class="content">
					<div class="block-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
						<h2>CONTACT</h2>
						<p></p>
					</div>
					<ul class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
						<li><strong> ADDRESS</strong> : <?=$office_address?></li>
						<li><b>PHONE</b>:<br />
							<a href="tel:<?=$mobile_no?>"><?=$mobile_no?></a>
						</li>
						<li><strong>EMAIL</strong> :<br />
							<a href="mailto:<?=$email?>"><?=$email?></a>
						</li>
					</ul>
					<div class="scroll-down">
						<img data-lazyloaded="1"
							src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							data-src="<?=base_url();?>assets/public/images/icons/next_black.svg"
							alt="arrow"><noscript><img
								src="<?=base_url();?>assets/public/images/icons/next_black.svg"
								alt="arrow"></noscript>
					</div>
				</div>
				<div class="form-contact wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">

					<div class="wpcf7 no-js" id="wpcf7-f7-o1" lang="en-US" dir="ltr">
						<div class="screen-reader-response">
							<p role="status" aria-live="polite" aria-atomic="true"></p>
							<ul></ul>
						</div>
						<form action="#wpcf7-f7-o1" method="post" class="wpcf7-form init" aria-label="Contact form"
							novalidate="novalidate" data-status="init">
							<div style="display: none;">
								<input type="hidden" name="_wpcf7" value="7" />
								<input type="hidden" name="_wpcf7_version" value="5.8.2" />
								<input type="hidden" name="_wpcf7_locale" value="en_US" />
								<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f7-o1" />
								<input type="hidden" name="_wpcf7_container_post" value="0" />
								<input type="hidden" name="_wpcf7_posted_data_hash" value="" />
								<input type="hidden" name="_wpcf7_recaptcha_response" value="" />
							</div>
							<p><span class="wpcf7-form-control-wrap" data-name="user-name"><input size="40"
										class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
										aria-required="true" aria-invalid="false" placeholder="NAME" value=""
										type="text" name="user-name" /></span><br />
								<span class="wpcf7-form-control-wrap" data-name="email"><input size="40"
										class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
										aria-required="true" aria-invalid="false" placeholder="E-MAIL" value=""
										type="email" name="email" /></span><br />
								<span class="wpcf7-form-control-wrap" data-name="subject"><input size="40"
										class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
										aria-required="true" aria-invalid="false" placeholder="SUBJECT" value=""
										type="text" name="subject" /></span><br />
								<span class="wpcf7-form-control-wrap" data-name="message"><textarea cols="40" rows="10"
										class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
										placeholder="MESSAGE" name="message"></textarea></span><br />
								<input class="wpcf7-form-control wpcf7-submit has-spinner submit" type="submit"
									value="Send" />
							</p>
							<div class="wpcf7-response-output" aria-hidden="true"></div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="home-email home-email-contact section white-section" id="careers">
			<div class="container">
				<div class="block-title wow fadeInUp" data-wow-delay="1s" data-wow-duration=".6s">
					<div class="block-title__heading">COME JOIN</div>
					<h2>THE ADVENTURE</h2>
					<p></p>
				</div>
				<a class="btn btn-black btn-big wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s"
					href="mailto:contact@somtamlabs.com" target="_self">JOIN US</a>
			</div>
		</div>


    <!--<div class="container">-->
        
    <!--            <div class="footer-block">-->
    <!--                <a href="https:/somtamlabs.com" class="logo wow fadeInUp" data-wow-delay="1s"-->
    <!--                    data-wow-duration="1s">squaretechsolution</a>-->
    <!--                <div class="social-links wow fadeIn" data-wow-delay="1s" data-wow-duration="1.5s">-->
    <!--                    <p>Follow Us!</p>-->
    <!--                    <a href="<?=$fb_link;?>" target="_blank" class="social-link">-->
    <!--                        <img data-lazyloaded="1"-->
    <!--                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"-->
    <!--                            data-src="<?=base_url();?>assets/public/images/icons/facebook.svg"-->
    <!--                            alt="Facebook" /><noscript><img-->
    <!--                                src="<?=base_url();?>assets/public/images/icons/facebook.svg"-->
    <!--                                alt="Facebook" /></noscript>-->
    <!--                    </a>-->
    <!--                    <a href="<?=$linkedin_link;?>" target="_blank" class="social-link">-->
    <!--                        <img data-lazyloaded="1"-->
    <!--                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"-->
    <!--                            data-src="<?=base_url();?>assets/public/images/icons/linkedin.svg"-->
    <!--                            alt="LinkedIn" /><noscript><img-->
    <!--                                src="<?=base_url();?>assets/public/images/icons/linkedin.svg"-->
    <!--                                alt="LinkedIn" /></noscript>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
            
    <!--            <div class="footer-block">-->
    <!--                <nav class="footer-nav wow fadeInLeft" data-wow-delay="1s" data-wow-duration="1.5s">-->
    <!--                    <ul>-->
    <!--                        <li id="menu-item-202" class=" menu-item menu-item-type-post_type menu-item-object-page"><a-->
    <!--                                href="tel:<?=$mobile_no;?>">-->
    <!--                                <?=$mobile_no;?>-->
    <!--                            </a></li>-->
    <!--                        <li id="menu-item-199" class=" menu-item menu-item-type-post_type menu-item-object-page"><a-->
    <!--                                href="mailto:<?=$email;?>">-->
    <!--                                <?=$email;?>-->
    <!--                            </a></li>-->
    <!--                    </ul>-->
    <!--                </nav>-->
    <!--            </div>-->
            
    <!--    <div class="copyright">-->
    <!--        <p>©squaretechsolution</p>-->
    <!--    </div>-->
    <!--</div>-->
    
    <?php foreach ($site_settings as $rows) {if ($rows['category'] == 'site_settings') {
    $office_map=$rows['content']->office_link??'';
    $factory_map=$rows['content']->factory_link??'';
    $fb_link=$rows['content']->fb_link??'';
    $youtube_link=$rows['content']->youtube_link??'';
    $twitter_link=$rows['content']->twitter_link??'';
    $linkedin_link=$rows['content']->linkedin_link??'';
    $office_address=$rows['content']->o_address??'';
    $factory_address=$rows['content']->f_address??'';
    $mobile_no=$rows['content']->mobile_no??'';
    $email=$rows['content']->email??'';
    $fax_no=$rows['content']->fax_no??'';
}
        }        ?>
<!--Footer-Area Start-->
<div class="footer-area pb_30">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="footer-item">
                            <h3>Our Office</h3>
                            <iframe src="<?=$office_map;?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-item">
                           
                            <div class="footer-address-item">
                                <div class="text">
                                    <span><?=$factory_address;?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="footer-item">
                            <h3>Our Factory</h3>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117925.21689608591!2d88.26494985854566!3d22.53556493799616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1709287596947!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-item">
                            <div class="footer-address-item">
                               
                                <div class="text">
                                    <span><?=$office_address;?> </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-item">
                    <div class="footer-item-header-txt">
                        <h3>Connect with us</h3>
                    </div>

                    <ul class="footer-social">
                        <li><a href="<?=$fb_link;?>"><img src="<?= base_url() ?>public/images/footer-social/facebook.png" alt="facebook Photo"></a></li>
                        <li><a href="<?=$twitter_link;?>"><img src="<?= base_url() ?>public/images/footer-social/twitter.png" alt="twitter Photo"></a></li>
                        <li><a href="<?=$linkedin_link;?>"><img src="<?= base_url() ?>public/images/footer-social/linkedin.png" alt="linkedin Photo"></a></li>
                        <li><a href="<?=$youtube_link;?>"><img src="<?= base_url() ?>public/images/footer-social/youtube.png" alt="youtube Photo"></a></li>
                    </ul>
                    <div class="footer-address-item">
                        <div class="footer_address">
                            <p>
                                <img src="<?= base_url("public/images/Vector.png") ?>" >
                                <a href="tel:<?=$mobile_no;?>"><?=$mobile_no;?></a>
                            </p>
                            <p>
                                <img src="<?= base_url("public/images/VectorFax.png") ?>" >
                                <a href="tel:<?=$fax_no;?>"><?=$fax_no;?></a>
                            </p>
                            <p>
                                <img src="<?= base_url("public/images/VectorEmail.png") ?>" alt="">
                                <a href="mailto:<?=$email;?>"><?=$email;?></a> 
                            </p>
                        </div>
                    </div>
                    <div class="mt_50" >
                        <div class="footer-item-header-txt">
                            <h3>Certification</h3>
                        </div>
                        <div class="row">
                            <div class="col-3 footer-certificate">   
                                <img src="<?= base_url() ?>public/uploads/certificate/certificate1.png" >
                            </div>
                            <div class="col-3 footer-certificate">
                                <img src="<?= base_url() ?>public/uploads/certificate/certificate4.png" >
                          
                            </div>
                            <div class="col-3 footer-certificate">
                                <img src="<?= base_url() ?>public/uploads/certificate/certificate3.png" >
                            </div>
                            <div class="col-3 footer-certificate">
                                <img src="<?= base_url() ?>public/uploads/certificate/certificate2.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="footer-menu text-left">
                    <ul>
                        <li><a href="<?= base_url() ?>site">Home</a></li>
                        <li><a href="<?= base_url() ?>page/about-us">About Us</a></li>
                        <li><a href="<?= base_url() ?>page/client">Clients</a></li>
                        <li><a href="<?= base_url() ?>page/products">Products</a></li>
                        <li><a href="<?= base_url() ?>page/b/latestnews">News</a></li>
                        <li><a href="<?= base_url() ?>page/contact-us">Contact Us</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-3">
                <div class="footer-menu text-right">
                    <ul>
                        <li><a href="<?= base_url() ?>page/terms">Terms</a></li>
                        <li><a href="<?= base_url() ?>page/privacy">Privacy</a></li>
                        <li><a href="<?= base_url() ?>page/cookies">Cookies</a></li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
</div>
<div class="footer-bottom col-12">
    <p class="copywrite-text">Copyrights @squaretechsolution 2024</p>
</div>
<!--Footer-Area End-->

<!--Scroll-Top-->
<div class="scroll-top">
    <i class="fa fa-angle-up"></i>
</div>
<!--Scroll-Top-->
</footer>

<a href="mailto:<?=$email;?>" class="fixed-mail-icon">
    <svg width="282" height="282" viewBox="0 0 282 282" fill="none" xmlns="http:/www.w3.org/2000/svg">
        <circle cx="141" cy="141" r="140" fill="black" stroke="white" stroke-width="2" />
        <path
            d="M189.769 95H92.3846C86.6657 95 82 99.6606 82 105.385V174.615C82 180.32 86.6449 185 92.3846 185H189.769C195.474 185 200.154 180.355 200.154 174.615V105.385C200.154 99.68 195.509 95 189.769 95ZM188.335 101.923L141.297 148.961L93.8521 101.923H188.335ZM88.9231 173.182V106.785L122.264 139.841L88.9231 173.182ZM93.8184 178.077L127.181 144.715L138.871 156.304C140.224 157.646 142.408 157.642 143.755 156.294L155.154 144.895L188.335 178.077H93.8184ZM193.231 173.182L160.049 140L193.231 106.818V173.182Z"
            fill="white" />
    </svg>
</a>

<div class="fixed-nav">
    <div class="icon">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="fixed-nav__container">
        <a href="#" class="logo">STL</a>
        <nav>
            <ul>
                <li id="menu-item-57"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#services">SERVICES</a>
                </li>
                <li id="menu-item-58"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#our-work">Our Work</a>
                </li>
                <li id="menu-item-59"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#process">PROCESS</a>
                </li>
                <li id="menu-item-60"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#teams">Teams</a>
                </li>
                <li id="menu-item-61"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#values">Values</a>
                </li>
                <li id="menu-item-63"
                    class=" menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item">
                    <a href="#contact-us">Contact Us</a>
                </li>
                <li id="menu-item-566" class=" menu-item menu-item-type-custom menu-item-object-custom"><a
                        href="careers/">Careers</a></li>
            </ul>
        </nav>
        <div class="site_lang">
            <div class="language_select">
                <span class="lang_toggle"></span>
                <ul class="languages_list">
                    <li class="lang-item lang-item-5 lang-item-en current-lang lang-item-first"><a lang="en-GB"
                            hreflang="en-GB" href="https:/somtamlabs.com"><img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+/+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3///aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn/WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg=="
                                alt="English" width="16" height="11" style="width: 16px; height: 11px;" /><span
                                style="margin-left:0.3em;">en</span></a></li>
                    <li class="lang-item lang-item-8 lang-item-fr"><a lang="fr-FR" hreflang="fr-FR"
                            href="https:/somtamlabs.com/"><img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAbFBMVEVzldTg4ODS0tLxDwDtAwDjAADD0uz39/fy8vL3k4nzgna4yOixwuXu7u7s6+zn5+fyd2rvcGPtZljYAABrjNCpvOHrWkxegsqfs93NAADpUUFRd8THAABBa7wnVbERRKa8vLyxsLCoqKigoKClCvcsAAAAXklEQVR4AS3JxUEAQQAEwZo13Mk/R9w5/7UERJCIGIgj5qfRJZEpPyNfCgJTjMR1eRRnJiExFJz5Mf1PokWr/UztIjRGQ3V486u0HO55m634U6dMcf0RNPfkVCTvKjO16xHA8miowAAAAABJRU5ErkJggg=="
                                alt="Français" width="16" height="11" style="width: 16px; height: 11px;" /><span
                                style="margin-left:0.3em;">fr</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <span class="page-shadow"></span>
</div>

<div class="hidden">
    <input type="hidden" id="thank_you_page_url" value="https:/somtamlabs.comthank-you-page-en/">
    <div class="custom_modal app_modal" id="app_modal">
        <div class="inner">
            <div class="images_slider">
                <div class="swiper-container apps_modal_swiper">
                    <div class="swiper-wrapper"></div>
                    <div class="app_modal_nav">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="app-swiper-pagination"></div>
                </div>
            </div>
            <div class="app_info">
                <h4 class="app_title"></h4>
                <p class="sub_title"></p>
                <div class="app_description"></div>
                <div class="app_links"></div>
            </div>
        </div>
    </div>
    <div class="custom_modal person_modal" id="person_modal">
        <div class="inner">
            <div class="person_image"></div>
            <div class="person_info">
                <h4 class="person_title"></h4>
                <p class="person_sub_title"></p>
                <div class="person_description"></div>
            </div>
        </div>
    </div>
    <div class="custom_modal form-modal home-contact" id="form_modal">
        <div class="inner">
            <div class="contact-form form-title">Get Your Free Project Estimate! Fill out the form below and one of
                our experts will get back to you with an accurate project quote. No obligation, just valuable
                information for your next project. Let's make it happen!</div>
            <div class="contact-form form-contact">
                <div class="wpcf7 no-js" id="wpcf7-f1726-o2" lang="en-GB" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="#wpcf7-f1726-o2" method="post" class="wpcf7-form init" id="1726"
                        aria-label="Contact form" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="1726" />
                            <input type="hidden" name="_wpcf7_version" value="5.8.2" />
                            <input type="hidden" name="_wpcf7_locale" value="en_GB" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1726-o2" />
                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                            <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                        </div>
                        <p><span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40"
                                    class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Name"
                                    value="" type="text" name="your-name" /></span><br />
                            <span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40"
                                    class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                    aria-required="true" aria-invalid="false" placeholder="Email" value="" type="email"
                                    name="your-email" /></span><br />
                            <span class="wpcf7-form-control-wrap" data-name="your-message"><textarea cols="40" rows="10"
                                    class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                    aria-required="true" aria-invalid="false" placeholder="Message"
                                    name="your-message"></textarea></span><br />
                            <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Send" />
                        </p>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Сonnect the popup only on pages that are not in the array $no_modal_pages -->
    <div class="custom_modal form-modal home-contact" id="form_quick_fr">
        <div class="inner">
            <div class="contact-form form-title">Obtenez une évaluation de projet gratuite de 15 minutes ! Laissez
                simplement votre adresse e-mail et nous vous contacterons !
            </div>
            <div class="contact-form form-contact">
                <div class="wpcf7 no-js" id="wpcf7-f1724-o3" lang="en-GB" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="#wpcf7-f1724-o3" method="post" class="wpcf7-form init" id="1724"
                        aria-label="Contact form" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="1724" />
                            <input type="hidden" name="_wpcf7_version" value="5.8.2" />
                            <input type="hidden" name="_wpcf7_locale" value="en_GB" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1724-o3" />
                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                            <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                        </div>
                        <p><span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40"
                                    class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                    aria-required="true" aria-invalid="false" placeholder="Email" value="" type="email"
                                    name="your-email" /></span><br />
                            <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Send" />
                        </p>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Сonnect the popup only on pages that are not in the array $no_modal_pages -->
    <div class="custom_modal form-modal home-contact" id="form_quick_en">
        <div class="inner">
            <div class="contact-form form-title">Get a Free 15-Minute Project Evaluation! Just drop your e-mail
                address and
                we will be in touch!
            </div>
            <div class="contact-form form-contact">
                <div class="wpcf7 no-js" id="wpcf7-f1724-o4" lang="en-GB" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="#wpcf7-f1724-o4" method="post" class="wpcf7-form init" id="1724"
                        aria-label="Contact form" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="1724" />
                            <input type="hidden" name="_wpcf7_version" value="5.8.2" />
                            <input type="hidden" name="_wpcf7_locale" value="en_GB" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1724-o4" />
                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                            <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                        </div>
                        <p><span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40"
                                    class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email"
                                    aria-required="true" aria-invalid="false" placeholder="Email" value="" type="email"
                                    name="your-email" /></span><br />
                            <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Send" />
                        </p>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script data-optimized="1" type='text/javascript' src='assets/public/js/swv.js' id='swv-js'></script>
<script type='text/javascript' id='contact-form-7-js-extra'>
    /* <![CDATA[ */
    var wpcf7 = { "api": { "root": "https:\/\/somtamlabs.com\/wp-json\/", "namespace": "contact-form-7\/v1" }, "cached": "1" };
    /* ]]> */
</script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/contact-form-7.js'
    id='contact-form-7-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/jquery.js' id='jquery-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/litespeed-jquery.js' id='jquery-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/home.js' id='home-js-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/common.js' id='common-js-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/somtamlabs-loadmore.js'
    id='somtamlabs-loadmore-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/wow-script.js' id='wow-script-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/swiper-script.js'
    id='swiper-script-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/fancybox-script.js'
    id='fancybox-script-js'></script>
<script type='text/javascript'
    src='https:/www.google.com/recaptcha/api.js?render=6LdhzRsoAAAAALWCznYHgE616qmV7ywmr7XRYHAZ&#038;ver=3.0'
    id='google-recaptcha-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/wp-polyfill-inert.js'
    id='wp-polyfill-inert-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/regenerator-runtime.js'
    id='regenerator-runtime-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/wp-polyfill.js' id='wp-polyfill-js'></script>
<script type='text/javascript' id='wpcf7-recaptcha-js-extra'>
    /* <![CDATA[ */
    var wpcf7_recaptcha = { "sitekey": "6LdhzRsoAAAAALWCznYHgE616qmV7ywmr7XRYHAZ", "actions": { "homepage": "homepage", "contactform": "contactform" } };
    /* ]]> */
</script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/wpcf7-recaptcha.js'
    id='wpcf7-recaptcha-js'></script>
<script data-optimized="1" type='text/javascript' src='assets/public/js/swv.js' id='swv-js'></script>

<script data-optimized="1" type='text/javascript' src='assets/public/js/home-modal.js' id='home-js-js'></script>


 <!--Js-->
    <script src="<?= base_url() ?>assets/public/menu/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/jquery.meanmenu.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/jquery.filterizr.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/viewportchecker.js"></script>
    <script src="<?= base_url() ?>assets/public/menu/js/toastr.min.js"></script>
    
  <script src="<?= base_url() ?>assets/public/menu/js/script.js"></script>
<script src="<?= base_url() ?>assets/public/menu/js/custom.js"></script>
<script src="<?= base_url() ?>assets/public/menu/js/ltr.js"></script>
 <!--Js-->

<script data-no-optimize="1">!function (t, e) { "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : (t = "undefined" != typeof globalThis ? globalThis : t || self).LazyLoad = e() }(this, function () { "use strict"; function e() { return (e = Object.assign || function (t) { for (var e = 1; e < arguments.length; e++) { var n, a = arguments[e]; for (n in a) Object.prototype.hasOwnProperty.call(a, n) && (t[n] = a[n]) } return t }).apply(this, arguments) } function i(t) { return e({}, it, t) } function o(t, e) { var n, a = "LazyLoad::Initialized", i = new t(e); try { n = new CustomEvent(a, { detail: { instance: i } }) } catch (t) { (n = document.createEvent("CustomEvent")).initCustomEvent(a, !1, !1, { instance: i }) } window.dispatchEvent(n) } function l(t, e) { return t.getAttribute(gt + e) } function c(t) { return l(t, bt) } function s(t, e) { return function (t, e, n) { e = gt + e; null !== n ? t.setAttribute(e, n) : t.removeAttribute(e) }(t, bt, e) } function r(t) { return s(t, null), 0 } function u(t) { return null === c(t) } function d(t) { return c(t) === vt } function f(t, e, n, a) { t && (void 0 === a ? void 0 === n ? t(e) : t(e, n) : t(e, n, a)) } function _(t, e) { nt ? t.classList.add(e) : t.className += (t.className ? " " : "") + e } function v(t, e) { nt ? t.classList.remove(e) : t.className = t.className.replace(new RegExp("(^|\\s+)" + e + "(\\s+|$)"), " ").replace(/^\s+/, "").replace(/\s+$/, "") } function g(t) { return t.llTempImage } function b(t, e) { !e || (e = e._observer) && e.unobserve(t) } function p(t, e) { t && (t.loadingCount += e) } function h(t, e) { t && (t.toLoadCount = e) } function n(t) { for (var e, n = [], a = 0; e = t.children[a]; a += 1)"SOURCE" === e.tagName && n.push(e); return n } function m(t, e) { (t = t.parentNode) && "PICTURE" === t.tagName && n(t).forEach(e) } function a(t, e) { n(t).forEach(e) } function E(t) { return !!t[st] } function I(t) { return t[st] } function y(t) { return delete t[st] } function A(e, t) { var n; E(e) || (n = {}, t.forEach(function (t) { n[t] = e.getAttribute(t) }), e[st] = n) } function k(a, t) { var i; E(a) && (i = I(a), t.forEach(function (t) { var e, n; e = a, (t = i[n = t]) ? e.setAttribute(n, t) : e.removeAttribute(n) })) } function L(t, e, n) { _(t, e.class_loading), s(t, ut), n && (p(n, 1), f(e.callback_loading, t, n)) } function w(t, e, n) { n && t.setAttribute(e, n) } function x(t, e) { w(t, ct, l(t, e.data_sizes)), w(t, rt, l(t, e.data_srcset)), w(t, ot, l(t, e.data_src)) } function O(t, e, n) { var a = l(t, e.data_bg_multi), i = l(t, e.data_bg_multi_hidpi); (a = at && i ? i : a) && (t.style.backgroundImage = a, n = n, _(t = t, (e = e).class_applied), s(t, ft), n && (e.unobserve_completed && b(t, e), f(e.callback_applied, t, n))) } function N(t, e) { !e || 0 < e.loadingCount || 0 < e.toLoadCount || f(t.callback_finish, e) } function C(t, e, n) { t.addEventListener(e, n), t.llEvLisnrs[e] = n } function M(t) { return !!t.llEvLisnrs } function z(t) { if (M(t)) { var e, n, a = t.llEvLisnrs; for (e in a) { var i = a[e]; n = e, i = i, t.removeEventListener(n, i) } delete t.llEvLisnrs } } function R(t, e, n) { var a; delete t.llTempImage, p(n, -1), (a = n) && --a.toLoadCount, v(t, e.class_loading), e.unobserve_completed && b(t, n) } function T(o, r, c) { var l = g(o) || o; M(l) || function (t, e, n) { M(t) || (t.llEvLisnrs = {}); var a = "VIDEO" === t.tagName ? "loadeddata" : "load"; C(t, a, e), C(t, "error", n) }(l, function (t) { var e, n, a, i; n = r, a = c, i = d(e = o), R(e, n, a), _(e, n.class_loaded), s(e, dt), f(n.callback_loaded, e, a), i || N(n, a), z(l) }, function (t) { var e, n, a, i; n = r, a = c, i = d(e = o), R(e, n, a), _(e, n.class_error), s(e, _t), f(n.callback_error, e, a), i || N(n, a), z(l) }) } function G(t, e, n) { var a, i, o, r, c; t.llTempImage = document.createElement("IMG"), T(t, e, n), E(c = t) || (c[st] = { backgroundImage: c.style.backgroundImage }), o = n, r = l(a = t, (i = e).data_bg), c = l(a, i.data_bg_hidpi), (r = at && c ? c : r) && (a.style.backgroundImage = 'url("'.concat(r, '")'), g(a).setAttribute(ot, r), L(a, i, o)), O(t, e, n) } function D(t, e, n) { var a; T(t, e, n), a = e, e = n, (t = It[(n = t).tagName]) && (t(n, a), L(n, a, e)) } function V(t, e, n) { var a; a = t, (-1 < yt.indexOf(a.tagName) ? D : G)(t, e, n) } function F(t, e, n) { var a; t.setAttribute("loading", "lazy"), T(t, e, n), a = e, (e = It[(n = t).tagName]) && e(n, a), s(t, vt) } function j(t) { t.removeAttribute(ot), t.removeAttribute(rt), t.removeAttribute(ct) } function P(t) { m(t, function (t) { k(t, Et) }), k(t, Et) } function S(t) { var e; (e = At[t.tagName]) ? e(t) : E(e = t) && (t = I(e), e.style.backgroundImage = t.backgroundImage) } function U(t, e) { var n; S(t), n = e, u(e = t) || d(e) || (v(e, n.class_entered), v(e, n.class_exited), v(e, n.class_applied), v(e, n.class_loading), v(e, n.class_loaded), v(e, n.class_error)), r(t), y(t) } function $(t, e, n, a) { var i; n.cancel_on_exit && (c(t) !== ut || "IMG" === t.tagName && (z(t), m(i = t, function (t) { j(t) }), j(i), P(t), v(t, n.class_loading), p(a, -1), r(t), f(n.callback_cancel, t, e, a))) } function q(t, e, n, a) { var i, o, r = (o = t, 0 <= pt.indexOf(c(o))); s(t, "entered"), _(t, n.class_entered), v(t, n.class_exited), i = t, o = a, n.unobserve_entered && b(i, o), f(n.callback_enter, t, e, a), r || V(t, n, a) } function H(t) { return t.use_native && "loading" in HTMLImageElement.prototype } function B(t, i, o) { t.forEach(function (t) { return (a = t).isIntersecting || 0 < a.intersectionRatio ? q(t.target, t, i, o) : (e = t.target, n = t, a = i, t = o, void (u(e) || (_(e, a.class_exited), $(e, n, a, t), f(a.callback_exit, e, n, t)))); var e, n, a }) } function J(e, n) { var t; et && !H(e) && (n._observer = new IntersectionObserver(function (t) { B(t, e, n) }, { root: (t = e).container === document ? null : t.container, rootMargin: t.thresholds || t.threshold + "px" })) } function K(t) { return Array.prototype.slice.call(t) } function Q(t) { return t.container.querySelectorAll(t.elements_selector) } function W(t) { return c(t) === _t } function X(t, e) { return e = t || Q(e), K(e).filter(u) } function Y(e, t) { var n; (n = Q(e), K(n).filter(W)).forEach(function (t) { v(t, e.class_error), r(t) }), t.update() } function t(t, e) { var n, a, t = i(t); this._settings = t, this.loadingCount = 0, J(t, this), n = t, a = this, Z && window.addEventListener("online", function () { Y(n, a) }), this.update(e) } var Z = "undefined" != typeof window, tt = Z && !("onscroll" in window) || "undefined" != typeof navigator && /(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent), et = Z && "IntersectionObserver" in window, nt = Z && "classList" in document.createElement("p"), at = Z && 1 < window.devicePixelRatio, it = { elements_selector: ".lazy", container: tt || Z ? document : null, threshold: 300, thresholds: null, data_src: "src", data_srcset: "srcset", data_sizes: "sizes", data_bg: "bg", data_bg_hidpi: "bg-hidpi", data_bg_multi: "bg-multi", data_bg_multi_hidpi: "bg-multi-hidpi", data_poster: "poster", class_applied: "applied", class_loading: "litespeed-loading", class_loaded: "litespeed-loaded", class_error: "error", class_entered: "entered", class_exited: "exited", unobserve_completed: !0, unobserve_entered: !1, cancel_on_exit: !0, callback_enter: null, callback_exit: null, callback_applied: null, callback_loading: null, callback_loaded: null, callback_error: null, callback_finish: null, callback_cancel: null, use_native: !1 }, ot = "src", rt = "srcset", ct = "sizes", lt = "poster", st = "llOriginalAttrs", ut = "loading", dt = "loaded", ft = "applied", _t = "error", vt = "native", gt = "data-", bt = "ll-status", pt = [ut, dt, ft, _t], ht = [ot], mt = [ot, lt], Et = [ot, rt, ct], It = { IMG: function (t, e) { m(t, function (t) { A(t, Et), x(t, e) }), A(t, Et), x(t, e) }, IFRAME: function (t, e) { A(t, ht), w(t, ot, l(t, e.data_src)) }, VIDEO: function (t, e) { a(t, function (t) { A(t, ht), w(t, ot, l(t, e.data_src)) }), A(t, mt), w(t, lt, l(t, e.data_poster)), w(t, ot, l(t, e.data_src)), t.load() } }, yt = ["IMG", "IFRAME", "VIDEO"], At = { IMG: P, IFRAME: function (t) { k(t, ht) }, VIDEO: function (t) { a(t, function (t) { k(t, ht) }), k(t, mt), t.load() } }, kt = ["IMG", "IFRAME", "VIDEO"]; return t.prototype = { update: function (t) { var e, n, a, i = this._settings, o = X(t, i); { if (h(this, o.length), !tt && et) return H(i) ? (e = i, n = this, o.forEach(function (t) { -1 !== kt.indexOf(t.tagName) && F(t, e, n) }), void h(n, 0)) : (t = this._observer, i = o, t.disconnect(), a = t, void i.forEach(function (t) { a.observe(t) })); this.loadAll(o) } }, destroy: function () { this._observer && this._observer.disconnect(), Q(this._settings).forEach(function (t) { y(t) }), delete this._observer, delete this._settings, delete this.loadingCount, delete this.toLoadCount }, loadAll: function (t) { var e = this, n = this._settings; X(t, n).forEach(function (t) { b(t, e), V(t, n, e) }) }, restoreAll: function () { var e = this._settings; Q(e).forEach(function (t) { U(t, e) }) } }, t.load = function (t, e) { e = i(e); V(t, e) }, t.resetStatus = function (t) { r(t) }, Z && function (t, e) { if (e) if (e.length) for (var n, a = 0; n = e[a]; a += 1)o(t, n); else o(t, e) }(t, window.lazyLoadOptions), t }); !function (e, t) { "use strict"; function a() { t.body.classList.add("litespeed_lazyloaded") } function n() { console.log("[LiteSpeed] Start Lazy Load Images"), d = new LazyLoad({ elements_selector: "[data-lazyloaded]", callback_finish: a }), o = function () { d.update() }, e.MutationObserver && new MutationObserver(o).observe(t.documentElement, { childList: !0, subtree: !0, attributes: !0 }) } var d, o; e.addEventListener ? e.addEventListener("load", n, !1) : e.attachEvent("onload", n) }(window, document);</script>

</body>
</html>
<!-- Page cached by LiteSpeed Cache 5.7.0.1 on 2024-02-28 11:25:28 -->