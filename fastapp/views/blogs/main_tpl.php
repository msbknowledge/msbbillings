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

  .blog-sidebar .widget-title {
    /*background-color: #f8f8f8;
  padding: 15px 20px;
  color: #222d39;*/
    background-color: #d8263c;
    padding: 8px 20px;
    color: #ffffff;
    border-radius: 5px 5px 0px 0px;
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
<div class="main-content-area">



  <section class="blog-section section-ptb">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 main-content">
          <div class="mid-content" id="blog-div-html-data">
            <div class="row">
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','126');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/mokshada-ekadashi-2023"><img src="https://www.vinaybajrangi.com/blog/uploads/default/blog-default.png" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-15</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/mokshada-ekadashi-2023">इस दिन मनाई जाएगी मोक्षदा एकादशी । मोक्षदा एकादशी 2023 शुभ मुहूर्त</a></h2>
                    <div class="mid-text-p">Mokshada Ekadashi Vrat 2023: मान्यता है कि एकादशी तिथि भगवान विष्णु जी को अति-प्रिय होती है। मार्गशीर्ष माह के शुक्ल पक्ष की एकादशी को मोक्षदा एकादशी कहा जाता है। धार्मिक मान्यताओं के अनुसार, मोक्षदा एकादशी के दिन भगवान विष्णु ने अर्जुन को गीता का उपदेश दिया था इसलिए इस दिन को गीता जयंती के रूप में भी मनाया जाता है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/mokshada-ekadashi-2023" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','125');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/festival/vivah-panchami-2023"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/1696Vivah_Panchami_2023.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-14</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/festival/vivah-panchami-2023">विवाह पंचमी कब है | विवाह पंचमी 2023 | Vivah Panchami Shubh Muhurat</a></h2>
                    <div class="mid-text-p">धार्मिक मान्यताओं के अनुसार विवाह पंचमी के दिन मर्यादा पुरुषोत्तम भगवान श्री राम जी का विवाह माता जानकी से हुआ था। विवाह पंचमी को प्रभु श्री राम और मां सीता के विवाह की वर्षगांठ के रूप में मनाया जाता है। हिन्दू धर्म में भगवान श्री राम और माता सीता की जोड़ी को एक आदर्श जोड़ी के रूप में पूजा जाता है। ऐसी मान्यता है कि इस दिन भगवान राम और माता सीता जी की पूजा अर्चना करने से वैवाहिक जीवन में खुशियां और सुख-शांति बनी रहती है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/festival/vivah-panchami-2023" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','124');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/durga-ashtami-vrat-2024"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/77572024_में_मासिक_दुर्गा_अष्टमी_व्रत_कब_है.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-13</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/durga-ashtami-vrat-2024">Masik Durga Ashtami Vrat - 2024 में मासिक दुर्गा अष्टमी व्रत कब है</a></h2>
                    <div class="mid-text-p">हर महीने के शुल्क पक्ष की अष्टमी तिथि को मासिक दुर्गाष्टमी तिथि मनाई जाती है। इस दिन मां दुर्गा की आराधना की जाती है। यह हर महीने मनाई जाती है इसलिए इसे मासिक दुर्गाष्टमी कहा जाता है। दुर्गा अष्टमी के दिन मंदिरों में काफी चहल-पहल देखी जाती है क्योंकि भक्त बड़ी संख्या में मां दुर्गा का आशीर्वाद लेने आते हैं। इस विशेष दिन भक्त पूरी श्रद्धा के साथ मां दुर्गा की पूजा अर्चना करते है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/durga-ashtami-vrat-2024" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','123');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/vinayaka-chaturthi-2024"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/3239विनायक_चतुर्थी_2024.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-12</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/vinayaka-chaturthi-2024">Ganesh Chaturthi - 2024 में कब है विनायक चतुर्थी । विनायक चतुर्थी 2024</a></h2>
                    <div class="mid-text-p">हिन्दू धर्म में विनायक चतुर्थी का बहुत ही अधिक महत्व माना गया है। प्रत्येक माह में शुक्ल पक्ष की चतुर्थी तिथि को विनायक चतुर्थी का व्रत रखा जाता है। चतुर्थी तिथि भगवान गणेश जी को समर्पित है। इस दिन गौरी पुत्र गणेश जी की पूजा-अर्चना की जाती है। हिन्दू धर्म में भगवान श्री गणेश जी को सभी देवी देवताओं में परम पूजनीय माना जाता है। इस दिन भगवान श्री गणेश जी का व्रत रखने से बुद्धि, ज्ञान और ऐश्वर्य की प्राप्ति होती है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/vinayaka-chaturthi-2024" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','122');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/margashirsha-amavasya-2023"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/6053कब_है_मार्गशीर्ष_अमावस्या_2023.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-08</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/margashirsha-amavasya-2023">कब है इस साल की आखिरी अमावस्या | मार्गशीर्ष अमावस्या 2023 शुभ मुहूर्त</a></h2>
                    <div class="mid-text-p">मार्गशीर्ष अमावस्या 12 दिसंबर 2023, मंगलवार को मनाई जाएगी। इस दिन मंगलवार होने के कारण यह अमावस्या भौमवती अमावस्या कहलाएगी। मंगवार का दिन हनुमानजी और मंगल देवता को समर्पित होता है इसलिए इस दिन हनुमान जी और मंगल देव का भी विशेष पूजन किया जाता है। मंगलवारी अमावस्या के दिन पितरों का पूजन करने से मनुष्य पितृ ऋण से मुक्त हो जाता है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/margashirsha-amavasya-2023" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','121');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/masik-shivartri-2024"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/16552024_मासिक_शिवरात्रि_पूजा_की_तारीख_व_समय.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-07</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/masik-shivartri-2024">मासिक शिवरात्रि व्रत 2024 | Masik Shivratri 2024 | कब है शिवरात्रि</a></h2>
                    <div class="mid-text-p">मासिक शिवरात्रि का व्रत रखने वालों पर महादेव शिव की विशेष कृपा बरसती है। इस दिन व्रत रखने से वैवाहिक जीवन में सुख समृद्धि आती है और कुंवारे लोगों को मनचाहा वर मिलता है।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/masik-shivartri-2024" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','120');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/property/auspicious-days-to-buy-new-house"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/1306Auspicious_Day_to_Buy_a_New_House_in_2024.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-06</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/property/auspicious-days-to-buy-new-house">Which day is good for Buy new house | Property Purchase Dates 2024</a></h2>
                    <div class="mid-text-p">In Hindu traditions, people perform the Griha Pravesh ceremony before living in a new home. The ceremony is performed not just on any date; the family members have to ask a learned person for an auspicious day. The puja removes negativity from the house and brings fortune. It is a one-time ritual and should be performed with due care. The Panchang has auspicious dates for performing Griha Pravesh.</div>
                    <a href="https://www.vinaybajrangi.com/blog/property/auspicious-days-to-buy-new-house" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','119');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/masik-krishna-janmashtami-vrat"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/9194मासिक_कृष्ण_जन्माष्टमी_2024.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-05</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/masik-krishna-janmashtami-vrat">Janmashtmai 2024 - जानें 2024 में मासिक कृष्ण जन्माष्टमी व्रत की तारीख</a></h2>
                    <div class="mid-text-p">हर महीने के कृष्ण पक्ष की अष्टमी तिथि को मासिक जन्माष्टमी मनाई जाती है। ऐसी मान्यता है कि भगवान विष्णु के नवमें अवतार श्री कृष्ण का जन्म अष्टमी तिथि को हुआ था इसलिए भक्त हर महीने के कृष्ण पक्ष की अष्टमी तिथि को मासिक जन्माष्टमी मनाते हैं</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/masik-krishna-janmashtami-vrat" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','118');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/horoscope/kannada-horoscope-2024"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/3951Kannada_Horoscope_2024.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-04</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/horoscope/kannada-horoscope-2024">2024 ರ ಜೀವನ ಭವಿಷ್ಯವನ್ನು ಓದಿ | Kannada Horoscope 2024 | ಜಾತಕ 2024</a></h2>
                    <div class="mid-text-p">ವಾರ್ಷಿಕ ಜಾತಕ 2024 ಗ್ರಹಗಳು ಮತ್ತು ನಕ್ಷತ್ರಗಳ ಚಲನೆಯನ್ನು ಆಧರಿಸಿದೆ, ವಿವಿಧ ರಾಶಿಚಕ್ರ ಚಿಹ್ನೆಗಳ ಮೇಲೆ ಅವುಗಳ ಸ್ಥಾನಗಳು ಮತ್ತು ಪರಿಣಾಮಗಳನ್ನು ಪರಿಗಣಿಸಿ. ಇದು ಕುಟುಂಬ, ಮದುವೆ, ಪ್ರೀತಿ, ಶಿಕ್ಷಣ, ವೃತ್ತಿ, ಹಣಕಾಸು, ಸಂಪತ್ತು, ಆರೋಗ್ಯ ಮತ್ತು ಹೆಚ್ಚಿನವುಗಳಂತಹ ಜೀವನದ ಅಂಶಗಳ ಕುರಿತು ಅಗತ್ಯ ಒಳನೋಟಗಳನ್ನು ಒದಗಿಸುತ್ತದೆ. ಈ ವಾರ್ಷಿಕ ಜಾತಕವು ಎಲ್ಲಾ 12 ರಾಶಿಚಕ್ರದ ಚಿಹ್ನೆಗಳಿಗೆ ನಿರ್ಣಾಯಕ ಮಾಹಿತಿಯನ್ನು ನೀಡುವ ಗುರಿಯನ್ನು ಹೊಂದಿದೆ, 2024 ಎಲ್ಲರಿಗೂ ಮಹತ್ವದ ವರ್ಷವಾಗಿದೆ ಎಂದು ಸೂಚಿಸುತ್ತದೆ.</div>
                    <a href="https://www.vinaybajrangi.com/blog/horoscope/kannada-horoscope-2024" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','117');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/moon/role-of-moon-in-the-birth-chart"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/6390What_is_the_role_of_the_Moon_in_a_horoscope.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-03</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/moon/role-of-moon-in-the-birth-chart">What is the role of Moon in astrology | Role of Moon in Horoscope</a></h2>
                    <div class="mid-text-p">In birth chart Moon plays a important role in shaping an individual's emotional and psychological landscape. It represents our inner self, emotions, instincts, and reactions to life's experiences. The Moon's position at birth influences your emotional needs, how you nurture and seek security and your connection to your family, especially the mother.</div>
                    <a href="https://www.vinaybajrangi.com/blog/moon/role-of-moon-in-the-birth-chart" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','116');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/horoscope/rashi-palan-2024"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/2674Tamil_Horoscope_2024.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-02</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/horoscope/rashi-palan-2024">Rashi Palan 2024 - அதிர்ஷ்டம் பெறும் 4 ராசிகள் | Tamil Horoscope 2024</a></h2>
                    <div class="mid-text-p">2024 ஆம் ஆண்டிற்கான ஜாதகம் கிரகங்கள் மற்றும் நட்சத்திரங்களின் இயக்கங்களை அடிப்படையாகக் கொண்டது, பல்வேறு ராசி அறிகுறிகளில் அவற்றின் நிலைகள் மற்றும் விளைவுகளை கணக்கில் எடுத்துக்கொண்டு, உங்கள் வாழ்க்கையின் அனைத்து அம்சங்களையும் பற்றிய முக்கிய நுண்ணறிவுகளை வழங்குகிறது.</div>
                    <a href="https://www.vinaybajrangi.com/blog/horoscope/rashi-palan-2024" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb--20">

                <div class="post-item" onclick="update_view('blog','115');">
                  <div class="post-thumb">
                    <a href="https://www.vinaybajrangi.com/blog/vrat/ekadashi-vrat"><img src="https://www.vinaybajrangi.com/blog/uploads/blogs/2102कैसे_और_कब_हुआ_एकादशी_व्रत_का_शुभारंभ.jpg" alt></a>
                  </div>
                  <div class="post-content border-effect">
                    <ul class="meta-post list-unstyled pl-0 d-flex justify-content-between">
                      <li> <span class="icon"><i class="far fa-clock"></i></span> <span class="meta-content">2023-12-01</span> </li>
                      <li> <span class="icon"><i class="far fa-comment-alt"></i></span> <a href="javascript:void(0);" class="meta-link"> Comments</a> </li>
                    </ul>
                    <h2 class="title-head"><a href="https://www.vinaybajrangi.com/blog/vrat/ekadashi-vrat">Utpanna Ekadashi 2023 - कैसे और कब हुआ एकादशी व्रत का शुभारंभ</a></h2>
                    <div class="mid-text-p">हिंदू धर्म में सभी व्रतो में एकादशी का व्रत सबसे श्रेष्ठ माना गया है। शास्त्रों में बताया भी गया है कि एकादशी व्रत से ज्यादा कुछ और भगवान विष्णु को प्रिय नहीं है। हिंदु मान्यता अनुसार सभी तिथियों में से भगवान विष्णु को एकादशी तिथि सबसे ज्यादा प्रिय है। हिंदु पंचांग/Hindu Panchang, के अनुसार हर माह दो एकादशी तिथि और साल में 24 एकादशी तिथियां पड़ती हैं।</div>
                    <a href="https://www.vinaybajrangi.com/blog/vrat/ekadashi-vrat" id class="blog-btn">Read More</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <ul class="pagination justify-content-center justify-content-lg-start">
                  <li class="d-md-block"> <a class="active">1</a></li>
                  <li class="d-md-block"><a href="https://www.vinaybajrangi.com/blog/pages/12" data-ci-pagination-page="2">2</a></li>
                  <li class="d-md-block"><a href="https://www.vinaybajrangi.com/blog/pages/24" data-ci-pagination-page="3">3</a></li>
                  <li class="d-md-block"><a href="https://www.vinaybajrangi.com/blog/pages/12" data-ci-pagination-page="2" rel="next"><span class="text">Next</span><i class="icon fas fa-angle-right"></i></a></li>
                  <li class="d-md-block"><a href="https://www.vinaybajrangi.com/blog/pages/120" data-ci-pagination-page="11">Last Page</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <style>
          #premium-products .carousel-item a {
            display: block;
          }
        </style>
        <div class="col-lg-3 sidebar blog-sidebar">
          <div class="widget">
            <h5 class="widget-title">Recent Blog</h5>
            <?php
            foreach ($recentblogcont as $row) {
              $id = $row->id;
              $slug = $row->slug;
            ?>
              <div class="widget-wrapper1">
                <div class="small-post-list">
                  <div class="post-item d-flex">
                    <div class="post-thumb"><a href="<?php echo base_url('blogs/blogdetails/' . $slug . '') ?>"><img src="<?php echo base_url('uploads/blogs'); ?>/<?php echo $row->blog_images; ?>" alt="">
                      </a> </div>
                    <div class="post-content"> <a class="title" href="<?php echo base_url('blogs/blogdetails/' . $slug . '') ?>"><?php echo $row->blog_title; ?></a>

                      <ul class="meta-post list-unstyled pl-0 d-flex">
                        <li> <span class="meta-content"><?php echo $row->publish_date; ?></span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
          <div class="widget">
            <h5 class="widget-title">Latest Video</h5>
            <div class="widget-wrapper1">
              <div class="small-post-list">
                <div class="post-item d-flex" onclick="update_view('right','2');">
                  <div class="post-thumb"><a target="_blank" href="https://youtu.be/kpHge2XHGvE"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/4607saturn.png" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://youtu.be/kpHge2XHGvE">Saturn Transit in Aquarius 2023</a>
                  </div>
                </div>
                <div class="post-item d-flex" onclick="update_view('right','3');">
                  <div class="post-thumb"><a target="_blank" href="https://youtu.be/YabovqrAB68"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/3271love_marriage.png" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://youtu.be/YabovqrAB68">Love Marriage Yoga in Kundli</a>
                  </div>
                </div>
                <div class="post-item d-flex" onclick="update_view('right','10');">
                  <div class="post-thumb"><a target="_blank" href="https://youtu.be/sAKbj1ogKSY"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/9742marriage_or_love.png" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://youtu.be/sAKbj1ogKSY">Know why you are not able to marry your love?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget">
            <h5 class="widget-title">Press Release</h5>
            <div class="widget-wrapper1">
              <div class="small-post-list">
                <div class="post-item d-flex" onclick="update_view('right','4');">
                  <div class="post-thumb"><a target="_blank" href="https://theprint.in/theprint-valuead-initiative/astrology-for-legal-cases/1540114/"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/99782023-01-31.jpg" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://theprint.in/theprint-valuead-initiative/astrology-for-legal-cases/1540114/">The Print - Astrology for legal cases</a>
                  </div>
                </div>
                <div class="post-item d-flex" onclick="update_view('right','5');">
                  <div class="post-thumb"><a target="_blank" href="https://www.outlookindia.com/outlook-spotlight/how-will-saturn-transit-impact-me-news-258040"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/84792023-01-31.jpg" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://www.outlookindia.com/outlook-spotlight/how-will-saturn-transit-impact-me-news-258040">Outlook India - How Will Saturn Transit Impact Me</a>
                  </div>
                </div>
                <div class="post-item d-flex" onclick="update_view('right','6');">
                  <div class="post-thumb"><a target="_blank" href="https://www.outlookindia.com/outlook-spotlight/can-we-see-legal-cases-from-birth-chart--news-280293"><img src="https://www.vinaybajrangi.com/blog/uploads/right_side/5485job-issues.png" alt>
                    </a> </div>
                  <div class="post-content"> <a target="_blank" class="title" href="https://www.outlookindia.com/outlook-spotlight/can-we-see-legal-cases-from-birth-chart--news-280293">Outlook India - Can We See Legal Cases From Birth Chart?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget">
            <h5 class="widget-title">Categories</h5>
            <div class="widget-wrapper1">
              <ul class="catagory-list list-unstyled">

                <?php

                foreach ($catdetails as $row) {

                ?>
                  <li><a class="d-flex align-items-center justify-content-between" href="<?php echo base_url('blog?name=' . $row['slug_hin'] . '') ?>"> <span class="text"><?php echo $row['categories_hindi']; ?></span> <span class="count"><?php echo $row['categories_count']; ?></span> </a></li>

                <?php } ?>


              </ul>
            </div>
          </div>
          <div class="widget">
            <h5 class="widget-title">Tag Widgets</h5>
            <div class="widget-wrapper1">
              <ul class="tag-list list-unstyled">
                <?php

                foreach ($tags as $rows) {
                ?>
                  <li><a href="<?php echo base_url('blogs/index?tags=' . $rows->tags_hin . '') ?>"><?php echo $rows->tags_hin; ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>

        </div>

  </section>
</div>