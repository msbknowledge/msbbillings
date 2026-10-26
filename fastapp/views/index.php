<main>
    <!--Slider Start-->
    <div class="slider ">
        <div class="slide-carousel slider-one owl-carousel">

            <?php
            if (isset($banners)) {
                foreach ($banners as $banner) {
            ?>

            <div class="slider-item flex"
                style="background-image:url(<?= base_url('file/open/') ?><?= $banner->slug ?>);">
                <div class="bg-slider "></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12 col-12">
                            <div class="slider-text">
                                <div class="text-animated">
                                    <p style="color: #EE2C3A;">
                                        <?= $banner->name; ?>
                                    </p>
                                </div>
                                <div class="text-animated">
                                    <h1>
                                        <?= strip_tags($banner->description) ?>
                                    </h1>
                                </div>
                                <div class="btn button-common wow fadeInDown">
                                    <a href="<?= base_url() ?><?= $banner->banner_link; ?>">
                                        <span> Know More </span>
                                        <span class="button-right"> </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>

        </div>
    </div>

    <!--Slider End-->

    <!--About  Company -->
    <div class="hero-section scroll-container">
        <div class="container">
            <div class="content">
                <div class="decor_dots y-transition wow fadeInDown" data-wow-duration="1s" data-wow-delay="1.5s">
                    <img data-lazyloaded="1"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                        data-src="<?=base_url();?>assets/public/images/decorations/square.png"
                        alt="dots" /><noscript><img src="<?=base_url();?>assets/public/images/decorations/square.png"
                            alt="dots" /></noscript>
                </div>
                <h1>
                    <span class="wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">WEB DEVELOPMENT </span>
                    <br>
                    <strong class="text-glow wow fadeIn" data-wow-duration="1s" data-wow-delay="1.5s">AND
                        Maintanance</strong>
                </h1>
                <p class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2s">
                    We develop IT projects to create new experiences at competitive prices. </p>

            </div>
        </div>
        <div class="img wow fadeIn" data-wow-duration="2s" data-wow-delay="1.5s">
            <img data-lazyloaded="1" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                data-src="assets/public/images/papaya.png" alt="papaya" /><noscript><img
                    src="assets/public/images/papaya.png" alt="papaya" /></noscript>
        </div>
        <span class="scroll-down">
            <img data-lazyloaded="1" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow" /><noscript><img
                    src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow" /></noscript>
        </span>
    </div>
    <!--About  Company End-->
    <!--About  Company -->
    <div class="home-about scroll-container">
        <div class="container">
            <div class="content">
                <div class="content__inside">
                    <div class="title wow fadeInUp" data-wow-delay=".5s">
                        <h2>Apps</h2>
                        <p><strong></strong> <strong></strong></p>
                    </div>
                    <article class="wow fadeInUp" data-wow-delay="0.5s">
                        <p><strong>Apps</strong> helps businesses build on their strengths with
                            <strong>mobile</strong> and <strong>web</strong> technologies. Our <strong>passionate
                                team</strong> specializes in <strong>development</strong>, <strong>design</strong>
                            and <strong>user experience</strong>. We support your growth by providing solutions to
                            enhance your IT projects.
                        </p>
                        <p>Our location in Bangkok, the <strong>high-tech capital of Asia</strong>, gives us access
                            to the best technical skills while remaining accessible to companies in Europe. Being
                            based in Thailand, we are able to offer premium services at competitive prices on a
                            schedule that suits you. Trust us to develop your most beautiful and effective
                            <strong>digital projects</strong>.
                        </p>
                    </article>
                    <span class="scroll-down">
                        <img data-lazyloaded="1"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?=base_url();?>assets/public/images/icons/next_black.svg"
                            alt="arrow" /><noscript><img src="<?=base_url();?>assets/public/images/icons/next_black.svg"
                                alt="arrow" /></noscript>
                    </span>
                </div>
            </div>
            <div class="image wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">
                <img data-lazyloaded="1"
                    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2MDAiIGhlaWdodD0iODM1IiB2aWV3Qm94PSIwIDAgNjAwIDgzNSI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="
                    width="600" height="835" data-src="assets/public/images/home-about.png"
                    class="attachment-full size-full" alt="" decoding="async" fetchpriority="high"
                    data-srcset="assets/public/images/home-about.png 600w, assets/public/images/home-about-122x170.png 122w, assets/public/images/home-about-287x400.png 287w, assets/public/images/home-about-216x300.png 216w"
                    data-sizes="(max-width: 600px) 100vw, 600px" /><noscript><img width="600" height="835"
                        src="assets/public/images/home-about.png" class="attachment-full size-full" alt=""
                        decoding="async" fetchpriority="high"
                        srcset="assets/public/images/home-about.png 600w, assets/public/images/home-about-122x170.png 122w, assets/public/images/home-about-216x300.png 216w"
                        sizes="(max-width: 600px) 100vw, 600px" /></noscript>
            </div>
        </div>
    </div>
    <!--About  Company End-->

    <!--Product  category(services) -->
    <div class="home-cases scroll-container" id="services">
        <div class="container section">
            <div class="block-title wow fadeInUp" data-wow-delay="0.5s">
                <h2>OUR SERVICES1</h2>
                <p></p>
            </div>
        </div>
        <div class="home-cases__list">
            <?php
            foreach ($categories as $key => $rows){
            ?>
            <div class="section case-single scroll-container" id="<?= $rows['slug']; ?>">
                <div class="case-single__container">
                    <div class="image" data-wow-duration="1s" data-wow-delay="0.5s">
                        <div class="decor-img rotate-decor">
                            <img data-lazyloaded="1" src="<?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?>"
                                width="298" height="366"
                                data-src="<?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?>"
                                class="attachment-full size-full" alt="" decoding="async"
                                data-srcset="<?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?> 138w, <?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?> 244w"
                                data-sizes="(max-width: 298px) 100vw, 298px" /><noscript><img width="298" height="366"
                                    src="assets/public/images/case-before.png" class="attachment-full size-full" alt=""
                                    decoding="async"
                                    srcset="<?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?> 138w, <?= base_url('file/open/') ?><?= $rows['banner_img_slug']; ?> 244w"
                                    sizes="(max-width: 298px) 100vw, 298px" /></noscript>
                        </div>
                        <img data-lazyloaded="1" src="<?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?>"
                            width="527" height="542" data-src="assets/public/images/case1.png"
                            class="attachment-full size-full" alt="" decoding="async"
                            data-srcset="<?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 165w, <?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 389w, <?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 400w, <?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 292w"
                            data-sizes="(max-width: 527px) 100vw, 527px" /><noscript><img width="527" height="542"
                                src="<?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?>"
                                class="attachment-full size-full" alt="" decoding="async"
                                srcset="<?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 165w, <?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 389w, <?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 400w,<?= base_url('file/open/') ?><?= $rows['category_img_slug']; ?> 292w"
                                sizes="(max-width: 527px) 100vw, 527px" /></noscript>
                        <div class="number text-glow"></div>
                    </div>
                    <div class="content" data-wow-duration="1s" data-wow-delay=".5s">
                        <div class="content__title">
                            <h3>
                                <?= $rows['name']; ?>
                            </h3>
                            <p></p>
                        </div>
                        <article>
                            <?= $rows['meta_description']; ?>
                        </article>
                        <a href="#form_modal" class="btn" data-fancybox>Get Free Estimate</a>
                    </div>
                </div>
                <span class="scroll-down">
                    <img data-lazyloaded="1"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                        data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                            src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript>
                </span>
            </div>
            <?php
                }
            ?>
          
        </div>
    </div>
    <!--Product  category(services) End-->
    <!--Product(projects) -->
    <div class="home-references section scroll-container" id="our-work">
        <div class="container">
            <div class="block-title wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                <h2>Our projects</h2>
                <p></p>
            </div>
            <div class="swiper-container wow fadeIn references-swiper" data-wow-duration="1s" data-wow-delay=".5s">
                <nav>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </nav>
                <div class="swiper-wrapper">
                     <?php
            foreach ($products as $key => $product){
               
            ?>
                    <div class="swiper-slide">
                        <div class="swiper-slide__container app_modal_trigger swiper-lazy">
                            <div class="img">
                                <img data-lazyloaded="1"
                                    src="<?=$product['files'][0]['url']?>"
                                    width="400" height="522" data-src="<?=$product['files'][0]['url']?>"
                                    class="references_slide_img" alt="" decoding="async"
                                    data-srcset="<?=$product['files'][0]['url']?> 400w, <?=$product['files'][0]['url']?> 130w, <?=$product['files'][0]['url']?> 307w, <?=$product['files'][0]['url']?> 230w, <?=$product['files'][0]['url']?> 705w"
                                    data-sizes="(max-width: 400px) 100vw, 400px" /><noscript><img width="400"
                                        height="522" src="<?=$product['files'][0]['url']?>"
                                        class="references_slide_img" alt="" decoding="async"
                                        srcset="<?=$product['files'][0]['url']?> 400w, <?=$product['files'][0]['url']?> 130w, <?=$product['files'][0]['url']?> 307w, <?=$product['files'][0]['url']?> 230w, <?=$product['files'][0]['url']?> 705w"
                                        sizes="(max-width: 400px) 100vw, 400px" /></noscript>
                            </div>
                            <span class="title"><?= $product['category_name']; ?></span>
                            <p class="sub_title"><?= $product['name']; ?></p>
                            <div class="hidden app-info-modal">
                                <div class="images">
                                      <?php
            foreach ($product['files'] as $key => $file){
            ?>
                                    <div class="swiper-slide">
                                        <img data-lazyloaded="1"
                                            src="<?=$product['files'][0]['url']?>"
                                            width="400" height="369"
                                            data-src="<?=$product['files'][0]['url']?>"
                                            class="swiper-lazy" alt="" decoding="async"
                                            data-srcset="<?=$product['files'][0]['url']?> 400w, <?=$product['files'][0]['url']?> 184w, <?=$product['files'][0]['url']?> 433w, <?=$product['files'][0]['url']?> 300w, <?=$product['files'][0]['url']?> 768w, <?=$product['files'][0]['url']?> 997w"
                                            data-sizes="(max-width: 400px) 100vw, 400px" /><noscript><img width="400"
                                                height="369"
                                                src="<?=$product['files'][0]['url']?>"
                                                class="swiper-lazy" alt="" decoding="async"
                                                srcset="<?=$product['files'][0]['url']?> 400w, <?=$product['files'][0]['url']?> 184w, <?=$product['files'][0]['url']?> 433w, <?=$product['files'][0]['url']?> 300w, <?=$product['files'][0]['url']?> 768w, <?=$product['files'][0]['url']?> 997w"
                                                sizes="(max-width: 400px) 100vw, 400px" /></noscript>
                                        <!-- <div class="swiper-lazy-preloader"></div> -->
                                    </div>
                                      <?php
                }
            ?>
                                  
                                </div>
                                <div class="description">
                                    <p>
                                        <?= $product['description']; ?> </p>
                                </div>
                                <div class="app_links">

                                    <div class="links available_links">


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
            ?>
                   
                </div>
            </div>
        </div>
        <span class="scroll-down"><img data-lazyloaded="1"
                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                    src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript></span>
    </div>
    <!--Product(projects) End-->
    <!--process -->
    <div class="home-process section scroll-container" id="process">
        <div class="container">
            <div class="block-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <h2>Our process</h2>
                <p></p>
            </div>
            <div class="rows">
                <div class="process-row scroll-container">
                    <div class="process-row__title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                        Project preparation </div>
                    <div class="process-row__content">
                        <div class="list">
                             <?php
                             $c1=0;
                            foreach ($process as $ps=> $proces){
                               
                            ?>
                            <div class="item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="item__number"></div>
                                <div class="item__title"><?=$proces->name;?></div>
                                <div class="item__image">
                                    <div class="img">
                                        <img data-lazyloaded="1"
                                            src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                            width="296" height="287" data-src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                            class="attachment-full size-full" alt="" decoding="async"
                                            data-srcset="<?= base_url('file/open/') ?><?= $proces->file_slug ?> 175w"
                                            data-sizes="(max-width: 296px) 100vw, 296px" /><noscript><img width="296"
                                                height="287" src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                                class="attachment-full size-full" alt="" decoding="async"
                                                srcset="<?= base_url('file/open/') ?><?= $proces->file_slug ?> 175w"
                                                sizes="(max-width: 296px) 100vw, 296px" /></noscript>
                                    </div>
                                    <article><?=$proces->description;?></article>
                                </div>
                            </div>
                             <?php
                             $c1++;
                                            if ($c1 >= 4) {
                                                break;
                                            }
                                }
                                   
                                ?>
                           
                        </div>
                    </div>
                    <span class="scroll-down"><img data-lazyloaded="1"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                                src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript></span>
                </div>

                <div class="process-row">
                    <div class="process-row__title wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                        Development </div>
                    <div class="process-row__content">
                        <div class="list">
                            <?php
                            $c2=0;
                            foreach ($process as $ps=> $proces){
                               
                            ?>
                            <div class="item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="item__number"></div>
                                <div class="item__title"><?=$proces->name;?></div>
                                <div class="item__image">
                                    <div class="img">
                                        <img data-lazyloaded="1"
                                            src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                            width="296" height="287" data-src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                            class="attachment-full size-full" alt="" decoding="async"
                                            data-srcset="<?= base_url('file/open/') ?><?= $proces->file_slug ?> 175w"
                                            data-sizes="(max-width: 296px) 100vw, 296px" /><noscript><img width="296"
                                                height="287" src="<?= base_url('file/open/') ?><?= $proces->file_slug ?>"
                                                class="attachment-full size-full" alt="" decoding="async"
                                                srcset="<?= base_url('file/open/') ?><?= $proces->file_slug ?> 175w"
                                                sizes="(max-width: 296px) 100vw, 296px" /></noscript>
                                    </div>
                                    <article><?=$proces->description;?></article>
                                </div>
                            </div>
                             <?php
                             $c2++;
                                            if ($c2 >= 4) {
                                                break;
                                            }
                                }
                                   
                                ?>
                            <!--<div class="item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.6s">-->
                            <!--    <div class="item__number"></div>-->
                            <!--    <div class="item__title">Testing and validation</div>-->
                            <!--    <div class="item__image">-->
                            <!--        <div class="img">-->
                            <!--            <img data-lazyloaded="1"-->
                            <!--                src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNzYiIGhlaWdodD0iMjc4IiB2aWV3Qm94PSIwIDAgMjc2IDI3OCI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="-->
                            <!--                width="276" height="278" data-src="assets/public/images/6.png"-->
                            <!--                class="attachment-full size-full" alt="" decoding="async"-->
                            <!--                data-srcset="assets/public/images/6.png 276w, assets/public/images/6-169x170.png 169w, assets/public/images/6-150x150.png 150w"-->
                            <!--                data-sizes="(max-width: 276px) 100vw, 276px" /><noscript><img width="276"-->
                            <!--                    height="278" src="assets/public/images/6.png"-->
                            <!--                    class="attachment-full size-full" alt="" decoding="async"-->
                            <!--                    srcset="assets/public/images/6.png 276w, assets/public/images/6-169x170.png 169w, assets/public/images/6-150x150.png 150w"-->
                            <!--                    sizes="(max-width: 276px) 100vw, 276px" /></noscript>-->
                            <!--        </div>-->
                            <!--        <article>At the end of each sprint, a test version is sent to the client. It is-->
                            <!--            accompanied by specific documents which make it possible to verify all the-->
                            <!--            screens and functions developed. This allows us to get your feedback and-->
                            <!--            adjust our work as we go.</article>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.6s">-->
                            <!--    <div class="item__number"></div>-->
                            <!--    <div class="item__title">Final receipt and deployment</div>-->
                            <!--    <div class="item__image">-->
                            <!--        <div class="img">-->
                            <!--            <img data-lazyloaded="1"-->
                            <!--                src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMTYiIGhlaWdodD0iMzAyIiB2aWV3Qm94PSIwIDAgMzE2IDMwMiI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="-->
                            <!--                width="316" height="302" data-src="assets/public/images/7.png"-->
                            <!--                class="attachment-full size-full" alt="" decoding="async"-->
                            <!--                data-srcset="assets/public/images/7.png 316w, assets/public/images/7-178x170.png 178w, assets/public/images/7-300x287.png 300w"-->
                            <!--                data-sizes="(max-width: 316px) 100vw, 316px" /><noscript><img width="316"-->
                            <!--                    height="302" src="assets/public/images/7.png"-->
                            <!--                    class="attachment-full size-full" alt="" decoding="async"-->
                            <!--                    srcset="assets/public/images/7.png 316w, assets/public/images/7-178x170.png 178w, assets/public/images/7-300x287.png 300w"-->
                            <!--                    sizes="(max-width: 316px) 100vw, 316px" /></noscript>-->
                            <!--        </div>-->
                            <!--        <article>Once these steps are complete, you will be able to view your project in-->
                            <!--            "beta version". This is our opportunity to adjust some last little details-->
                            <!--            together before the long-awaited moment: the delivery of your site or your-->
                            <!--            mobile application!</article>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.6s">
                                <div class="item__number"></div>
                                <div class="item__title">Project manintenance</div>
                                <div class="item__image">
                                    <div class="img">
                                        <img data-lazyloaded="1"
                                            src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyODQiIGhlaWdodD0iMzE4IiB2aWV3Qm94PSIwIDAgMjg0IDMxOCI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="
                                            width="284" height="318" data-src="assets/public/images/8.png"
                                            class="attachment-full size-full" alt="" decoding="async"
                                            data-srcset="assets/public/images/8.png 284w, assets/public/images/8-152x170.png 152w, assets/public/images/8-268x300.png 268w"
                                            data-sizes="(max-width: 284px) 100vw, 284px" /><noscript><img width="284"
                                                height="318" src="assets/public/images/8.png"
                                                class="attachment-full size-full" alt="" decoding="async"
                                                srcset="assets/public/images/8.png 284w, assets/public/images/8-152x170.png 152w, assets/public/images/8-268x300.png 268w"
                                                sizes="(max-width: 284px) 100vw, 284px" /></noscript>
                                    </div>
                                    <article>Once the project is delivered, we don't abandon you! We will be there
                                        to accompany you during an agreed maintenance period. Our projects are
                                        designed to last, to deal with web and mobile updates, and to adapt to the
                                        evolution of your activity.</article>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scroll-down"><img data-lazyloaded="1"
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                            data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                                src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript></span>
                </div>
            </div>
        </div>
    </div>
    <!--process End-->
    <!--Teams -->
    <div class="home-team section scroll-container" id="teams">
        <div class="container">
            <div class="block-title wow fadeInUp" data-wow-delay="1s" data-wow-duration=".5s">
                <h2>Our Teams</h2>
                <p></p>
            </div>
            <div class="team-list">
                <div class="row">
                    <div class="row__list">
                        <?php 
                                if (isset($teams)) {
                                foreach ($teams as $team){?>
                        <div class="item person-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                            <div class="item__container">
                                <div class="name"><?=$team->name;?></div>
                                <div class="img">
                                    <img data-lazyloaded="1"
                                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MDAiIGhlaWdodD0iMjY1IiB2aWV3Qm94PSIwIDAgNDAwIDI2NSI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="
                                        width="400" height="265"
                                        data-src="<?=base_url('file/open/');?><?=$team->team_link;?>"
                                        class="attachment-slide size-slide" alt="" decoding="async"
                                        data-srcset="<?=base_url('file/open/');?><?=$team->team_link;?> 400w, <?=base_url('file/open/');?><?=$team->team_link;?> 256w, <?=base_url('file/open/');?><?=$team->slug;?> 300w, <?=base_url('file/open/');?><?=$team->slug;?> 600w"
                                        data-sizes="(max-width: 400px) 100vw, 400px" /><noscript><img width="400"
                                            height="265" src="<?=base_url('file/open/');?><?=$team->slug;?>"
                                            class="attachment-slide size-slide" alt="" decoding="async"
                                            srcset="<?=base_url('file/open/');?><?=$team->slug;?> 400w, <?=base_url('file/open/');?><?=$team->slug;?> 256w, <?=base_url('file/open/');?><?=$team->slug;?> 300w, <?=base_url('file/open/');?><?=$team->slug;?> 600w"
                                            sizes="(max-width: 400px) 100vw, 400px" /></noscript>
                                </div>
                                <div class="title person_modal_trigger">
                                    <span class="title__position"><?=$team->team_link;?></span>
                                    <span class="title__btn">
                                        <img data-lazyloaded="1"
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                            data-src="<?=base_url();?>assets/public/images/icons/plus.svg"
                                            alt="plus" /><noscript><img
                                                src="<?=base_url();?>assets/public/images/icons/plus.svg"
                                                alt="plus" /></noscript>
                                    </span>
                                </div>
                                <div class="hidden person_description">
                                    <p><?=$team->description;?></p>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                       

                    </div>
                </div>
               
            </div>
            <span class="scroll-down"><img data-lazyloaded="1"
                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                    data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                        src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript></span>
        </div>
    </div>
    <!--Teams End-->
    <!--values -->
    <div class="home-values section scroll-container" id="values">
        <div class="container">
            <div class="block-title wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                <h2>Our values</h2>
                <p></p>
            </div>
            <div class="content">
                <div class="list wow fadeInUp" data-wow-duration="1s" data-wow-delay=".7s">
                     <?php
                            foreach ($values as $ps=> $value){
                               
                            ?>
                    <div class="item">
                        <div class="item__title">
                            <span><?= $value->name; ?></span>
                        </div>
                        <span class="btn">+</span>
                        <p><?= $value->description; ?></p>
                    </div>
                     <?php
                            }
                               
                            ?>
                   
                </div>
                <div class="img wow fadeIn" data-wow-duration="1s" data-wow-delay=".6s">
                    <img data-lazyloaded="1"
                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MTgiIGhlaWdodD0iNTI1IiB2aWV3Qm94PSIwIDAgNDE4IDUyNSI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzc5N2M4MSIvPjwvc3ZnPg=="
                        width="418" height="525" data-src="assets/public/images/papaya.png"
                        class="attachment-full size-full" alt="" decoding="async"
                        data-srcset="assets/public/images/papaya.png 418w, assets/public/images/papaya-135x170.png 135w, assets/public/images/papaya-318x400.png 318w, assets/public/images/papaya-400x502.png 400w, assets/public/images/papaya-239x300.png 239w"
                        data-sizes="(max-width: 418px) 100vw, 418px" /><noscript><img width="418" height="525"
                            src="assets/public/images/papaya.png" class="attachment-full size-full" alt=""
                            decoding="async"
                            srcset="assets/public/images/papaya.png 418w, assets/public/images/papaya-135x170.png 135w, assets/public/images/papaya-318x400.png 318w, assets/public/images/papaya-400x502.png 400w, assets/public/images/papaya-239x300.png 239w"
                            sizes="(max-width: 418px) 100vw, 418px" /></noscript>
                </div>
            </div>
            <div class="scroll-down"><img data-lazyloaded="1"
                    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP//yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                    data-src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"><noscript><img
                        src="<?=base_url();?>assets/public/images/icons/next.svg" alt="arrow"></noscript></div>
        </div>
    </div>
    <!--values End-->
</main>