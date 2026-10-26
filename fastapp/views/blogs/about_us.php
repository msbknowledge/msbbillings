<style>
    .soc1 a {
        background-color: #f12a43;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 30px !important;
        text-align: center;
    }

    .soc2 a {
        background-color: #f12a43;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 30px !important;
        text-align: center;
    }

    .soc3 a {
        background-color: #f12a43;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 30px !important;
        text-align: center;
    }

    .soc4 a {
        background-color: #f12a43;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 30px !important;
        text-align: center;
    }

    .soc5 a {
        background-color: #f12a43;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        line-height: 30px !important;
        text-align: center;
    }

    .soc1 a:hover {
        background-color: #3B5998 !important;
        color: #fff !important;
    }

    .soc2 a:hover {
        background-color: #33ccff !important;
        color: #fff !important;
    }

    .soc3 a:hover {
        background-color: #BD3518 !important;
        color: #fff !important;
    }

    .soc4 a:hover {
        background-color: #007bb7 !important;
        color: #fff !important;
    }

    .soc5 a:hover {
        background: radial-gradient(circle farthest-corner at 35% 90%, #fec564, transparent 50%), radial-gradient(circle farthest-corner at 0 140%, #fec564, transparent 50%), radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, transparent), linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);
        color: #fff !important;
    }

    .new-blink {
        position: absolute;
        z-index: auto;
        top: -24px;
        right: -5px;
        background: yellow;
        border-radius: 30px;
        color: red;
        font-weight: 600;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 35px;
        font-size: 12px;
        animation: blink 2s linear infinite;
    }

    @keyframes new-blink {
        0% {
            opacity: .5;
        }

        50% {
            opacity: .7;
        }

        100% {
            opacity: 1;
        }
    }

    .new-blink-mobile {
        position: absolute;
        z-index: auto;
        background: yellow;
        border-radius: 30px;
        color: red;
        font-weight: 600;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 35px;
        font-size: 12px;
        animation: blink 2s linear infinite;
    }

    @keyframes new-blink-mobile {
        0% {
            opacity: .5;
        }

        50% {
            opacity: .7;
        }

        100% {
            opacity: 1;
        }
    }


    .modal-dialog .new {
        transform: none !important;
    }

    .askBUT {
        text-align: center;
        width: 1500px;
        margin: 0;
        display: inline-block;
    }

    /*.responsive-mob{overflow: auto;width: 100%;background: #fff;padding: 10px 10px 0;margin: 10px 0 0;box-shadow: 0 0 10px 0 rgb(0 0 0 / 10%);}*/

    .responsive-mob {
        width: 100%;
        overflow: auto;
        display: flex;
        overflow-y: hidden;
        background: #fff;
        padding: 10px 10px 0;
        margin: 10px 0 0;
        box-shadow: 0 0 10px 0 rgb(0 0 0 / 10%);
        border-radius: 10px;
    }

    .ask-button {
        display: block;
        margin-right: 10px;
        margin-bottom: 10px;
    }


    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar {
        width: 5px;
        height: 6px;
        background: #ccc;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #eee;
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 50%);
    }

    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: rgba(255, 0, 0, .8);
        -webkit-box-shadow: inset 0 0 6px rgb(0 0 0 / 50%);
    }




    .askbutton {
        background: #d8263c;
        padding: 5px 20px;
        color: #fff;
        border-radius: 50px;
        box-shadow: 0px 5px 15px rgb(0 0 0 / 47%);
        font-size: 12px;
    }

    .askbutton:hover {
        background: #17b41b;
        color: #fff;
    }

    .askbutton {
        animation: myanimation 3s infinite;
    }

    @keyframes myanimation {
        0% {
            background-color: red;
        }

        25% {
            background-color: red;
        }

        50% {
            background-color: green;
        }

        75% {
            background-color: green;
        }

        100% {
            background-color: red;
        }
    }

    .askbutton {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .askbutton {
        width: max-content;
        text-transform: uppercase;
        font-weight: 500;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease 0s;
        cursor: pointer;
        outline: none;
        margin: 0 auto;
    }

    .askbutton:hover {
        box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
        transform: translateY(-10px);
    }


    /*.ask-button{display: inline-block;vertical-align: middle;align-items: center; margin: 0px 2px;float: left;}*/
    .n-t-part {
        text-align: center;
        padding: 6px;
        height: 100px;
        width: 110px;
        overflow: hidden;
        border-radius: 10%;
        margin: 0px 1px;
        box-shadow: 0px 2px 15px rgb(0 0 0/22%);
        background: #f12a43;
        background-position: 75px 80px;
        background-size: 49px;
        line-height: 15px;
        display: grid;
        vertical-align: middle;
        align-items: center;
        font-weight: 500;
        border: 1px solid #f12a43;
        color: #fff;
    }

    .n-t-part:hover {
        background: #fff;
        color: #d8263c !important;
    }

    /*.off-part{position: absolute;background: #FFFF00;color: #000;font-weight: 600;margin: -7px 0 0 -18px;font-size: 11px;padding: 0 6px;transform: rotate(340deg);height: 18px;line-height: 21px;}*/

    .off-part {
        position: relative;
        background: #FFFF00;
        color: #000;
        font-weight: 600;
        margin: -17px 0px 0px -21px;
        font-size: 10px;
        padding: 0 6px;
        transform: rotate(340deg);
        height: 18px;
        line-height: 21px;
        display: block !important;
        width: max-content;
        top: 13px;
    }

    .activee {
        color: #007bff;
    }

    .breadc {
        color: #666666;
    }

    .breadc a {
        font-weight: 300;
    }

    .breadc a:hover {
        text-decoration: underline;
    }

    .breadc i {
        margin: 5px;
    }

    .otperr {
        border: 1px solid red !important;
    }

    .digit_f.onlynumber {
        width: 13% !important;
        border-radius: 5px !important;
        font-size: 20px;
        font-weight: 600;
        background: #fff !important;
    }

    .new-LOGP {
        min-height: auto !important;
        max-width: fit-content !important;
        width: 400px !important;
        position: relative;
        z-index: 2;
        overflow: hidden;
        max-height: initial;
        overflow-y: auto;
    }

    .new-LOGP .login-content {
        max-width: 85%;
        margin: 0 auto;
    }

    .new-LOGP .login-area .login-body {
        width: 100%;
        padding: 10px 40px 0px 40px;
        position: relative;
    }

    .new-LOGP .modal-header {
        background: #d8263c;
    }

    .new-LOGP .modal-header .signHeading {
        color: #fff !important;
        font-weight: 300;
        font-size: 24px;
    }

    .new-LOGP .close-icon {
        color: #ffffff !important;
        background: none !important;
        font-size: 18px !important;
    }

    .new-LOGP .submit {
        font-size: 20px;
        background-color: #d8263c !important;
        border-color: #D8263A !important;
    }

    .check-style {
        margin: 10px 10px !important;
    }

    #pageloader3 {
        background: rgb(255 255 255 / 76%);
        display: none;
        height: 87%;
        position: fixed;
        width: 100%;
        z-index: 9999;
    }

    #pageloader3 img {
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
        position: absolute;
        top: 40%;
    }

    .proc2 {
        position: fixed;
        top: 60%;
        left: 40%;
        font-size: 20px;
        animation: blinker 1.5s step-end infinite;
    }

    #pageloader_t {
        background: rgb(255 255 255 / 76%);
        display: none;
        height: 87%;
        position: fixed;
        width: 100%;
        z-index: 9999;
    }

    #pageloader_t img {
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
        position: absolute;
        top: 40%;
    }

    .proc_t {
        position: fixed;
        top: 50%;
        left: 30%;
        font-size: 20px;
        animation: blinker 1.5s step-end infinite;
    }


    /*add popup*/
    .close1 {
        margin: 2px 7px;
        position: absolute;
        right: 0;
        color: #ff4a4a;
        opacity: 1;
        cursor: pointer;
    }

    .poupimg {
        width: 1000px;
        background: none;
        margin: 7% auto 0;
        border: none;
    }

    .poupimg img {
        border: 2px solid #FFF;
        border-radius: 5px;
    }

    @media screen and (max-width: 868px) {
        .poupimg {
            width: auto;
            height: 100vh;
            vertical-align: middle;
            display: table-cell;
            padding: 10px;
        }
    }

    @media screen and (max-width: 500px) {
        .poupimg {
            width: auto;
            height: 90vh;
            vertical-align: middle;
            display: table-cell;
            padding: 10px;
        }
    }

    /*add popup End*/

    @keyframes blinker {
        0% {
            opacity: 1.0;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1.0;
        }
    }




    .jquery-accordion-menu {
        float: left;
        position: relative;
    }

    .jquery-accordion-menu .jquery-accordion-menu-footer,
    .jquery-accordion-menu .jquery-accordion-menu-header {
        width: 100%;
        height: 50px;
        padding-left: 22px;
        float: left;
        line-height: 50px;
        font-weight: 600;
        color: #000;
        background: #fff
    }

    .jquery-accordion-menu ul {
        margin: 0;
        padding: 0;
        list-style: none
    }

    .jquery-accordion-menu ul li {
        width: 100%;
        display: block;
        float: left;
        position: relative
    }

    .jquery-accordion-menu ul li a {
        width: 100%;
        padding: 2px 10px;
        float: left;
        text-decoration: none;
        color: #000;
        font-size: 13px;
        background: #fff;
        white-space: nowrap;
        position: relative;
        overflow: hidden;
        -o-transition: color .2s linear, background .2s linear;
        -moz-transition: color .2s linear, background .2s linear;
        -webkit-transition: color .2s linear, background .2s linear;
        transition: color .2s linear, background .2s linear
    }

    .jquery-accordion-menu>ul>li.active>a,
    .jquery-accordion-menu>ul>li:hover>a {
        color: #000;
        background: #fff
    }

    .jquery-accordion-menu>ul>li>a {
        border-bottom: solid 1px #eee
    }

    .jquery-accordion-menu ul li a i {
        width: 34px;
        float: left;
        line-height: 18px;
        font-size: 16px;
        text-align: left
    }

    .jquery-accordion-menu .submenu-indicator {
        float: right;
        right: 10px;
        position: absolute;
        line-height: 19px;
        font-size: 20px;
        -o-transition: transform .3s linear;
        -moz-transition: transform .3s linear;
        -webkit-transition: transform .3s linear;
        -ms-transition: transform .3s linear
    }

    .jquery-accordion-menu ul ul.submenu .submenu-indicator {
        line-height: 16px
    }

    .jquery-accordion-menu .submenu-indicator-minus>.submenu-indicator {
        -ms-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(45deg)
    }

    .jquery-accordion-menu ul ul.submenu,
    .jquery-accordion-menu ul ul.submenu li ul.submenu {
        width: 100%;
        display: none;
        position: static
    }

    .jquery-accordion-menu ul ul.submenu li {
        clear: both;
        width: 100%
    }

    .jquery-accordion-menu ul ul.submenu li a {
        width: 100%;
        float: left;
        font-size: 11px;
        background: #fff;
        color: #000;
        border-top: none;
        position: relative;
        border-left: solid 6px transparent;
        -o-transition: border .2s linear;
        -moz-transition: border .2s linear;
        -webkit-transition: border .2s linear;
        transition: border .2s linear
    }

    .jquery-accordion-menu ul ul.submenu li:hover>a {
        border-left-color: #d8263c
    }

    .jquery-accordion-menu ul ul.submenu>li>a {
        padding-left: 20px
    }

    .jquery-accordion-menu ul ul.submenu>li>ul.submenu>li>a {
        padding-left: 20px
    }

    .jquery-accordion-menu ul ul.submenu>li>ul.submenu>li>ul.submenu>li>a {
        padding-left: 40px
    }

    .jquery-accordion-menu ul li .jquery-accordion-menu-label,
    .jquery-accordion-menu ul ul.submenu li .jquery-accordion-menu-label {
        min-width: 20px;
        padding: 1px 2px 1px 1px;
        position: absolute;
        right: 18px;
        top: 14px;
        font-size: 11px;
        font-weight: 800;
        color: #555;
        text-align: center;
        line-height: 18px;
        background: #f0f0f0;
        border-radius: 100%
    }

    .jquery-accordion-menu ul ul.submenu li .jquery-accordion-menu-label {
        top: 12px
    }

    .ink {
        display: block;
        position: absolute;
        background: rgba(255, 255, 255, .3);
        border-radius: 100%;
        -webkit-transform: scale(0);
        -moz-transform: scale(0);
        -ms-transform: scale(0);
        -o-transform: scale(0);
        transform: scale(0)
    }

    .animate-ink {
        -webkit-animation: ripple .5s linear;
        -moz-animation: ripple .5s linear;
        -ms-animation: ripple .5s linear;
        -o-animation: ripple .5s linear;
        animation: ripple .5s linear
    }

    @-webkit-keyframes ripple {
        100% {
            opacity: 0;
            -webkit-transform: scale(2.5)
        }
    }

    @-moz-keyframes ripple {
        100% {
            opacity: 0;
            -moz-transform: scale(2.5)
        }
    }

    @-o-keyframes ripple {
        100% {
            opacity: 0;
            -o-transform: scale(2.5)
        }
    }

    @keyframes ripple {
        100% {
            opacity: 0;
            transform: scale(2.5)
        }
    }

    .worldmap .call-map {
        width: 100%;
        text-align: center;
        float: left;
        padding: 2% 0 0;
    }

    .worldmap .form-section {
        background-attachment: fixed;
        background-size: cover;
        background-position: 100% 100%;
        background-repeat: no-repeat;
        padding: 0;
        position: relative;
        height: auto;
    }

    .worldmap .custom-button {
        width: 100%;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: 0.8s ease;
        background: #4da0b0;
        background: -webkit-linear-gradient(to right, #d39d38, #4da0b0);
        background: linear-gradient(to right, #ff5722, #3f51b5);
    }

    .custom-button:focus,
    .worldmap .custom-button:hover {
        transition: 0.8s ease;
        letter-spacing: 3px;
        background: -webkit-linear-gradient(to right, #d39d38, #4da0b0);
        background: linear-gradient(to right, #ff5722, #3f51b5);
    }

    .worldmap .form-box-inner .form-control {
        background: #ffffff8a;
        border: 1px solid #000;
        box-shadow: none;
    }

    .worldmap .form-box-inner .form-control:focus {
        outline: 0;
        box-shadow: none;
    }

    .map-box iframe {
        width: 100%;
        height: 357px;
    }

    .worldmap .map-box {
        padding: 5px;
        border-radius: 5px;

    }

    .worldmap .heading-title {
        text-align: center;
        margin: 0 auto;
        padding: 60px;
        font-size: 42px;
        font-weight: 600;
    }

    .worldmap .contact {
        text-align: center;
        font-size: 16px;
        line-height: 20px;
        width: 100%;
        float: left;
    }

    .worldmap .contact-box {
        background: #fff;
        height: 365px;
        padding: 15px;
        margin-top: -50px;
        box-shadow: 0 5px 5px #d90000;
    }

    .worldmap .contact-box ul li {
        margin-bottom: 0;
        padding: 8px;
        width: 100%;
    }

    .worldmap .contact i {
        font-size: 25px;
        color: #f65728;
    }

    .worldmap .form-box-inner {
        background: #ffffff8a;
        padding: 15px;
    }

    .leftpart .image {
        float: left;
    }

    .leftpart .product-layouts {
        padding: 0;
    }

    .callicon {
        padding-top: 17%;
    }

    .contact-usacc .card-header {
        padding: 10px;
    }

    .card-link,
    .card-link:hover,
    .contact-usacc .card-header {
        background-color: #f12a43;
        color: #fff;
        text-align: left;
        font-weight: 500;
        letter-spacing: 1px;
        font-size: 15px;
        text-transform: uppercase;
    }

    .contact-usacc .card-body {
        padding: 10px 10px;
    }

    .contact-usacc .card {
        width: 100%;
        text-align: left;
        background: #e4e4e4;
        padding: 0;
    }

    .contact-usacc p {
        position: absolute;
        top: 5px;
        right: 20px;
        font-size: 20px;
    }
</style>

<div class="page-layout">
    <div class="main-content-area">

        <div class="scrollP">
            <div class="responsive-mob">
                <div class="ask-button">

                    <a href="https://www.vinaybajrangi.com/ask-question/get-an-instant-answer.php" type="button" class="askbutton- n-t-part"> Unlock the secrets of tomorrow and get your instant answer in Yes or No.</a>
                </div>
                <div class="ask-button">
                    <a href="https://www.vinaybajrangi.com/services/online-report/how-will-be-this-year-for-you.php" type="button" class="n-t-part">Get Personalized Horoscope For 2024 by Dr Bajrangi </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/chances-of-child-in-birth-chart.php" type="button" class="n-t-part">Know About Child Birth From Birth Chart </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/job-or-business.php" type="button" class="n-t-part">Do you have the Yoga to do Business ? </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/know-your-marriage-timing.php" type="button" class="n-t-part">Know the Timing of your Marriage </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/know-best-ivf-date.php" type="button" class="n-t-part">Get The Best Dates for IVF! </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/know-future-life-partner-profession.php" type="button" class="n-t-part">What your Future Life Partner will do? Job or Business? </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/baby-naming.php" type="button" class="n-t-part">Best Name for Your Baby </a>
                </div>
                <div class="ask-button">
                    <a href="https://www.vinaybajrangi.com/services/online-report/life-significations-activated-this-year.php" type="button" class="n-t-part">Find Life Signification activated this year </a>
                </div>
                <div class="ask-button">
                    <a href="https://www.vinaybajrangi.com/services/online-report/know-about-saturn-secrets.php" type="button" class="n-t-part">Find Saturn secrets, how it affects you </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/business-partnership-compatibility.php" type="button" class="n-t-part">Is partnership suitable for you in Business ? </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/know-about-in-laws-by-astrology.php" type="button" class="n-t-part">Unveil the Status of Your Would-Be In-Laws </a>
                </div>
                <div class="ask-button">
                    <a href="https://www.vinaybajrangi.com/services/online-report/mangal-dosha-calculator.php" type="button" class="n-t-part">Get Most accurate result on Manglik Dosh </a>
                </div>
                <div class="ask-button">
                    <span class="off-part">10% off</span> <a href="https://www.vinaybajrangi.com/services/online-report/future-life-partner.php" type="button" class="n-t-part">Assess status, and personality of your Future Life Partner </a>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .activee {
        color: #007bff;
    }

    .breadc {
        color: #666666;
    }

    .breadc a {
        font-weight: 300;
    }

    .breadc a:hover {
        text-decoration: underline;
    }

    .breadc i {
        margin: 5px;
    }
</style>
<div class="col-lg-12 col-12" style="margin-top: 8px;">
    <div class="container breadc">
        <span class="sub-title fs15"> <a href="https://www.vinaybajrangi.com/"> Home</a> <i class="fa fa-angle-right"></i>
            <span class="activee">Privacy Policy</span></span>
    </div>
</div>

<section class="page-content mid-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 sidebar1 m-D-none">
                <div class="catagory-sidebar-area-inner">
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">MASTER OF</h4>
                        <ul class="catagory-submenu">
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/delay-in-marriage-reasons-solutions.php">DELAY IN MARRIAGE</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/pre-marriage-counseling.php">PRE MARRIAGE COUNSELING</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/kundli-matching-horoscopes-matching-for-marriage.php">HOROSCOPE MATCHING</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/love-marriage.php">LOVE MARRIAGE</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/life-partners-predictions.php">LIFE PARTNER PREDICTION</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/post-marriage-counseling.php">POST MARRIAGE COUNSELING</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/career-astrology/right-career-selection.php">RIGHT CAREER SELECTION</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/career-astrology/job-or-business.php">JOB OR BUSINESS</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/career-astrology/government-job.php">GOVT. JOB PREDICTIONS</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/business-astrology/new-business-ideas.php">NEW BUSINESS IDEAS</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/business-astrology/business-failure.php">BUSINESS FAILURE REASONS</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/life-predictions/karma-correction.php">KARMA CORRECTION</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/time-rectification/birth-time-rectification-with-ascendant.php">BIRTH TIME RECTIFICATION</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/children-astrology/parent-child-relationship.php">PARENT CHILD RELATIONSHIP</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/life-predictions/life-event-prediction.php">PAST LIFE READINGS</a> </li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">Free Calculators </h4>
                        <ul class="catagory-submenu calculators">
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/ascendant-calculator1.png" width="42" height="42" class="img-fluid image_delay" alt="Ascendant Calculator"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/ascendant-calculator.php">Ascendant Calculator</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/gemstone-suggestion.png" width="42" height="42" class="img-fluid image_delay" alt="Gemstone Suggestion"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/gemstone-calculator.php">Gemstone Suggestion</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/rudraksha-suggestion1.png" width="42" height="42" class="img-fluid image_delay" alt="Rudraksha Suggestion"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/rudraksha-calculator.php">Rudraksha Suggestion</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/check-numerology1.png" class="img-fluid image_delay" width="42" height="42" alt="Numerology For You"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/numerology-calculator.php">Numerology For You</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/kalsarpdosh.png" class="img-fluid image_delay" width="42" height="42" alt="Kaalsarp Dosha"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/kaalsarp-dosh-calculator.php">Kaalsarp Dosha</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/sadhesati-calculator1.png" class="img-fluid image_delay" width="42" height="42" alt="Sadesati Calculator"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/sadesati-calculator.php">Sadesati Calculator</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/pitra-dosha-calculator1.png" class="img-fluid image_delay" width="42" height="42" alt="Pitra Dosha Calculator"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/pitra-dosha-calculator.php">Pitra Dosha Calculator</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/maglik-dosha-calculator1.png" class="img-fluid image_delay" width="42" height="42" alt="Manglik Dosha Calculator"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/manglik-dosha-calculator.php">Manglik Dosha Calculator</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/calculator-img/moon.jpg" class="img-fluid image_delay" width="42" height="42" alt="Moon Sign Calculator"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/calculator/moon-sign-calculator.php">Moon Sign Calculator</a> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">CALCULATORS</h4>
                        <ul class="catagory-submenu calculatorsline">
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/marriage-life-problems-reasons.php">CALCULATORS FOR MARRIAGE ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/delay-in-marriage-reasons-solutions.php">CALCULATOR FOR DELAY IN MARRIAGE</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/marriage-astrology/love-marriage.php">CALCULATOR FOR LOVE MARRIAGE ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/business-astrology.php">CALCULATORS FOR BUSINESS ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/career-astrology/job-or-business.php">CALCULATORS FOR CAREER ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/court-cases.php">CALCULATORS FOR COURT CASE ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/property/property-yoga.php">CALCULATORS FOR PROPERTY ISSUES</a> </li>
                            <li> <a href="https://www.vinaybajrangi.com/loan-and-debts.php">CALCULATORS FOR LOAN & DEBT ISSUES</a> </li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">

                    </div>
                    <style>
                        .le-M {
                            margin-bottom: 30px !important;
                        }

                        .le-M a {
                            width: 100%;
                            margin-bottom: -10px;
                            padding: 3px;
                        }
                    </style>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="product-list">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="sub-title-small">
                                <h1> Privacy Policy</h1>
                            </div>
                        </div>
                    </div>
                    <div class="wh-BG-shadow">
                        <div class="col-lg-12 mb--20">
                            <div class="row">
                                <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">We , Bajrangi Astro&nbsp; take the privacy of the information you provide to us very seriously. This Privacy Policy is created &amp; maintained at the highest levels in our Organisation to demonstrate our commitment to privacy of the natives. Please read this Privacy Policy carefully to be satisfied how carefully we use and protect&nbsp; any information you provide to us at Bajrangi Astro or on </span></span><span style="background-color:transparent; font-size:10.5pt"><a href="https://www.vinaybajrangi.com/" target="_blank"><span style="color:#0000FF">our website.</span></a></span></p>
                                <ul>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt">Bajrangi Astro guarantees full confidentiality of our native&rsquo;s identity, birth details and any information received and predictions and analysis given both before and after our services are provided.&nbsp;</span></span></p>
                                    </li>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt">Bajrangi Astro further undertakes that no direct or indirect use will be made by </span></span><span style="background-color:transparent; font-size:11.5pt"><strong><a href="https://www.vinaybajrangi.com/" target="_blank"><span style="color:#0000FF">Bajrangi Astro</span></a></strong></span><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt"> or any of its staff members about any information that is received or revealed to us before or after our services except for the explicit purpose of communicating the </span></span><span style="background-color:transparent; font-size:11.5pt"><a href="https://www.vinaybajrangi.com/kundli.php" target="_blank"><span style="color:#0000FF"><strong>horoscope charts</strong></span></a></span><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt"> and predictions back to the specific native/member only.</span></span></p>
                                    </li>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt">We allow natives to access their users profiles, change passwords and use or change information at their end as they deem necessary.</span></span></p>
                                    </li>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt">We never share or sell your personal information to any third person/agency for any promotion or other usage of any type.&nbsp;&nbsp;</span></span></p>
                                    </li>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:11.5pt">For the improvements &amp; betterment, </span><span style="background-color:transparent; font-size:10.5pt">we keep adding new services &amp; items and also new explanations on various aspects so&nbsp; we suggest that you check back from time to time in order to remain updated. However, this at no cost or no time will alter our commitment to keep your confidentiality as stated above. Your continued use of the site will constitute your acknowledgment of our Privacy Policy.&nbsp;</span></span></p>
                                    </li>
                                    <li>
                                        <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">Notwithstanding anything contained above, you can always register any of your concern or point of dis-satisfaction on our mail id &ndash; </span></span><span style="color:#0000FF"><span style="background-color:transparent; font-size:10.5pt"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0f6e6b6266614f7966616e766d6e657d6e616866216c6062">[email&#160;protected]</a>.</span></span></p>
                                    </li>
                                </ul>
                                <p style="text-align:justify"><span style="color:#000000"><strong>1. Nature of&nbsp; personal information we collect?</strong></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>a. Registration Data</strong></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">For any membership registration, Bajrangi Astro&nbsp; collects personal information including your name, gender, birth information, email address, and your place of birth and residence. The birth details mainly are used to draw your accurate horoscope. Your e-mail ID is used for sending specific &amp; vital information to you and address is used for delivering any printed material etc ( if required). Your all such details are to secure your profile and to make our personalized e-mail services available to you. You do not have to provide any personal information to anyone except on the authorised phone and email Ids of Bajrangi Astro. Such facilities are available only to our registered members &amp; other others may not be able to avail of such facilities and services including&nbsp; personalized free horoscopes &amp; other free services, that we offer from time to time.&nbsp;</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>b. Log Files, IP Address and Cookies</strong></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">When you visit </span></span><span style="background-color:transparent; font-size:10.5pt"><a href="https://www.vinaybajrangi.com/" target="_blank"><span style="color:#0000FF">our website</span></a></span><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt"> and interact with the services and tools available there, Bajrangi Astro&nbsp; and third parties with whom Bajrangi Astro&nbsp; has contracted to provide services to Bajrangi Astro&nbsp; may collect information on your actions. The purpose of this information collection is only to collect&nbsp; broad demographic information and it has nothing to do with your personal information.&nbsp; We may&nbsp; use your IP address to help diagnose problems with our software or our server and to administer our website. We track the visitor IP address to get more information on visitor&#39;s demography like from which parts of the world people visit our website, what type of time they spend to analyse trends &amp; progress of our website. We collect browser types used and screen resolutions also for the same purpose. This all is done with the best trade practices and totally in good faith to enhance values of our website and nothing else.&nbsp;</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>c. Your fact file/Order Forms</strong></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">We collect information that is required to accomplish our paid services though a small fact file on mails&nbsp; or on our registered WhatsApp nos. We discourage collecting such information verbally or through a third person to avoid any error or mis-use. These personal information are maintained in strict confidence. As stated earlier, we guarantee confidentiality of our members&#39; identity, birth details and the prediction made possible under legal regulatory and security environment.&nbsp;</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>Other information</strong></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt">Any other information we receive due to email or other method of contact in regard to specific services or products, as a general rule, are not made part of your member profile, and are used only to address your specific need or concern that you may have communicated to us on.</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>2. Security</strong><br />
                                        <span style="background-color:transparent; font-size:10.5pt">We collect payments only through above modes of payments &amp; DO NOT encourage or allow any payment directly or indirectly to us or any of our team member at any cost. Payments collected through third party payment gateways that also only as mentioned above are processed in a secured manner. We are committed and follow reasonable industry standards, technical measures and procedural measures to protect against unauthorized access and use of your supplied information. However, there can be exceptional lapses &amp; risks as no website can fully eliminate all the risks.</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>3. Other web sites links</strong><br />
                                        <span style="background-color:transparent; font-size:10.5pt">Our web site may contain links to other web sites for referral readings only. Bajrangi Astro neither prompts nor is responsible for the privacy practices followed by other such web sites.</span></span></p>
                                <p style="text-align:justify"><span style="color:#000000"><strong>4. Contacting us</strong><br />
                                        <span style="background-color:transparent; font-size:10.5pt">For any clarification on all stated above or anything else, please feel free to contact us on our mail id </span></span><a href="/cdn-cgi/l/email-protection#8fe2eee6e3cff9e6e1eef6edeee5fdeee1e8e6a1ece0e2" style="text-decoration-line: none;"><span style="color:#0000FF"><span style="background-color:transparent; font-size:10.5pt"><span class="__cf_email__" data-cfemail="7914181015390f101718001b18130b18171e10571a1614">[email&#160;protected]</span></span></span></a><span style="color:#000000"><span style="background-color:transparent; font-size:10.5pt"> <strong>If you have any questions about this privacy statement or complaints of any nature, please write to us on our mail ID</strong> </span></span><a href="/cdn-cgi/l/email-protection#5d3c393034331d2b34333c243f3c372f3c333a34733e3230" style="text-decoration-line: none;"><span style="color:#0000FF"><span style="background-color:transparent; font-size:10.5pt"><span class="__cf_email__" data-cfemail="a6c7c2cbcfc8e6d0cfc8c7dfc4c7ccd4c7c8c1cf88c5c9cb">[email&#160;protected]</span></span></span></a><span style="color:#0000FF"><span style="background-color:transparent; font-size:10.5pt">.</span></span></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div style="clear:both"></div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 m-D-none">
                <div class="catagory-sidebar-area-inner">
                    <style>
                        .aactive {
                            color: #2007ea !important;
                        }
                    </style>
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">Life Problems</h4>
                        <ul class="catagory-submenu">
                            <li><a href="https://www.vinaybajrangi.com/marriage-astrology.php" class>Marriage Astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/business-astrology.php" class>Business Astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/career-astrology.php" class>Career Astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/court-cases.php" class>Court / Legal issues</a></li>
                            <li><a href="https://www.vinaybajrangi.com/property.php" class>Property astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/health-astrology.php" class>Health Astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/loan-and-debts.php" class>Loan and Debt </a></li>
                            <li><a href="https://www.vinaybajrangi.com/astrology-for-betting.php" class>Betting and Gambling</a></li>
                            <li><a href="https://www.vinaybajrangi.com/foreign-travel.php" class>Foreign Settlement</a></li>
                            <li><a href="https://www.vinaybajrangi.com/life-predictions.php" class>Past Life Readings</a></li>
                            <li><a href="https://www.vinaybajrangi.com/time-rectification.php" class>Birth Time Correction</a></li>
                            <li><a href="https://www.vinaybajrangi.com/children-astrology.php" class>Children Astrology</a></li>
                            <li><a href="https://www.vinaybajrangi.com/vastu.php" class>What is Vastu - All about Vastu</a></li>
                            <li><a href="https://www.vinaybajrangi.com/vastu-for-commercial.php" class>Vastu For Commercial</a></li>
                            <li><a href="https://www.vinaybajrangi.com/share-market-astrology.php" class>Share Market Astrology</a></li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">Appointment</h4>
                        <ul class="catagory-submenu calculators">
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/category_img/12_Consultation MAIN.webp" class="img-fluid image_delay" width="42" height="42" alt="CONSULTATION"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/services/consultation.php">CONSULTATION</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/category_img/1_OLR main.webp" class="img-fluid image_delay" width="42" height="42" alt="ONLINE REPORT"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/services/online-reports.php">ONLINE REPORT</a> </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/category_img/14_VR MAIN.webp" class="img-fluid image_delay" width="42" height="42" alt="VOICE REPORT"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/services/voice-report.php">VOICE REPORT</a> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">
                        <ul class="catagory-submenu calculators">
                            <li>
                                <div class="row">
                                    <div class="col-lg-4 col-4"> <img src="https://www.vinaybajrangi.com//assets/frontend/img-back-loader.gif" data-src="https://www.vinaybajrangi.com/upload/menu-icon/11_icon-mike.png" class="img-fluid image_delay" width="42" height="42" alt="Vinay Bajrangi"> </div>
                                    <div class="col-lg-8 col-8"> <a href="https://www.vinaybajrangi.com/astrology-news.php">ASTROLOGY NEWS & ARTICLES</a> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">
                        <h4 class="hedingbg">Astrology Secrets</h4>
                        <ul class="catagory-submenu calculatorsline">
                            <li><a href="https://www.vinaybajrangi.com/today-panchang.php">Today's Panchang</a></li>
                            <li><a href="https://www.vinaybajrangi.com/share-market-today.php">Stock Market Prediction</a></li>
                            <li><a href="https://www.vinaybajrangi.com/horoscope/horoscope.php">Free Daily Horoscope</a></li>
                            <li><a href="https://www.vinaybajrangi.com/planetary-transit.php">Planetary Transit</a></li>
                            <li><a href="https://www.vinaybajrangi.com/festivals.php">Festivals</a></li>
                            <li><a href="https://www.vinaybajrangi.com/zodiac-signs-compatibility.php">Love Compatibility</a></li>
                            <li><a href="https://www.vinaybajrangi.com/kundli-doshas.php">Kundli Doshas</a></li>
                            <li><a href="https://www.vinaybajrangi.com/nakshatras.php">Nakshatra</a></li>
                            <li><a href="https://www.vinaybajrangi.com/astrology-articles.php">Astrology Articles</a></li>
                            <li><a href="https://www.vinaybajrangi.com/astrology-news.php">Astrology News</a></li>
                            <li><a href="https://www.vinaybajrangi.com/planets.php">Planets in Different Houses & Signs</a></li>
                            <li><a href="https://www.vinaybajrangi.com/astrology-houses.php">Astrology Houses</a></li>
                            <li><a href="https://www.vinaybajrangi.com/astrology-remedies.php">Astrology Remedies</a></li>
                            <li><a href="https://www.vinaybajrangi.com/dasha.php">Astrology Dasha</a></li>
                            <li><a href="https://www.vinaybajrangi.com/yoga.php">Astrology Yoga</a></li>
                            <li><a href="https://www.vinaybajrangi.com/vrat.php">Vrat Dates</a></li>
                            <li><a href="https://www.vinaybajrangi.com/hindu-rituals.php">Hindu Rituals</a></li>
                            <li><a href="https://www.vinaybajrangi.com/jayanti.php">Jayanti</a></li>
                            <li><a href="https://www.vinaybajrangi.com/shubh-muhurat.php">Muhurata</a></li>
                        </ul>
                    </div>
                    <div class="catagory-sidebar all-catagory-option">

                    </div>
                    <style>
                        .le-M {
                            margin-bottom: 30px !important;
                        }

                        .le-M a {
                            width: 100%;
                            margin-bottom: -10px;
                            padding: 3px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>




    <style type="text/css">
        .activee {
            color: #007bff;
        }

        .breadc {
            color: #666666;
        }

        .breadc a {
            font-weight: 300;
        }

        .breadc a:hover {
            text-decoration: underline;
        }

        .breadc i {
            margin: 5px;
        }

        .sub-title-small {
            text-transform: uppercase;
            color: #d8263c;
            font-weight: 600;
        }

        .btn-info {
            color: #fff;
            background-color: #df5c39;
            border-color: #df5c39
        }

        .wh-BG-shadow {
            background: #fff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px 0 rgb(0 0 0 / 5%)
        }

        .wh-BG-shadow b,
        optgroup,
        strong {
            font-weight: 700
        }

        .wh-BG-shadow p {
            margin-bottom: 0;
            text-align: justify;
            font-size: 13px;
            margin-top: 0
        }

        .sub-title-small {
            text-transform: uppercase;
            color: #d8263c;
            font-weight: 600;
            font-size: 20px
        }

        .sub-title-small h1 {
            color: #fff;
            font-size: 18px;
            text-align: center;
            background: #d8263c;
            padding: 6px;
            border-radius: 5px 5px 0 0;
            font-weight: 600;
            margin-bottom: 0
        }
    </style>
</section>