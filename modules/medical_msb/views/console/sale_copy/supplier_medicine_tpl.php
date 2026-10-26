<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="shortcut icon" href="/uploads/fab.png">
                    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                        <link id="bs-css" href="/css/bootstrap-spacelab.css" rel="stylesheet">
                            <script>
                                $(function () {
                                    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                                });
                            </script>
                            <script>
                                var reqst = null;
                                $(document).ready(function () {
                                    $('#report_sub').click(function () {
                                        reqst = $.post("<?= base_url() ?>console/sale/supplier_medicine_details/", $('form').serialize(), function (resp) {
                                            $(".ajax_resp").html(resp);
                                           
                                        });
                                    });
                                 });



                            </script>

                            <title>Medicine Record</title>
                            </head>

                            <body>
                                <style>
                                    body {
                                        background: #FFFFFF;
                                    }
                                    body, td, th, input, select, textarea, option, optgroup {
                                        font-family: Verdana, Arial, Helvetica, sans-serif;
                                        font-size: 12px;
                                        color: #000000;
                                    }
                                    h1 {
                                        text-transform: uppercase;
                                        color: #CCCCCC;
                                        text-align: right;
                                        font-size: 24px;
                                        font-weight: normal;
                                        padding-bottom: 5px;
                                        margin-top: 0px;
                                        margin-bottom: 15px;
                                        border-bottom: 1px solid black;
                                    }
                                    .store {
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }
                                    .div2 {
                                        float: left;
                                        display: inline-block;
                                    }
                                    .div3 {
                                        float: right;
                                        display: inline-block;
                                        padding: 5px;
                                    }
                                    .heading td {
                                        background: #E7EFEF;
                                    }
                                    .address, .product {
                                        border-collapse: collapse;
                                    }
                                    .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .address th, .address td {
                                        border-left: 1px solid black;
                                        border-bottom: 1px solid black;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .address td {
                                        width: 50%;
                                    }
                                    .product {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .product td {
                                        border-left: 1px solid black;
                                        border-bottom: 1px solid black;
                                        padding: 5px;
                                    }
                                </style>
                                <style media="print">
                                    body {
                                        background-color: #FFF;
                                        background-image: none;
                                    }

                                    .delete, .button, #addrow, #head, #actions {
                                        display: none;
                                    }

                                    #main {
                                        border: none;
                                        height: auto;
                                    }

                                    table tr td textarea {
                                        margin-top: 0;
                                    }

                                    body {
                                        margin-top: -50px;
                                    }

                                    textarea {
                                        background: #FFF;
                                    }

                                    input {
                                        background: #FFF;
                                    }

                                    .sub-total {
                                        border-top: 1px dashed #CCC;
                                        border-bottom: 1px dashed #CCC;
                                    }
                                </style>
                                <style>	
                                    /* http://meyerweb.com/eric/tools/css/reset/ 
                                       v2.0 | 20110126
                                       License: none (public domain)
                                    */

                                    html, body, div, span, applet, object, iframe,
                                    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
                                    a, abbr, acronym, address, big, cite, code,
                                    del, dfn, em, img, ins, kbd, q, s, samp,
                                    small, strike, strong, sub, sup, tt, var,
                                    b, u, i, center,
                                    dl, dt, dd, ol, ul, li,
                                    fieldset, form, label, legend,
                                    table, caption, tbody, tfoot, thead, tr, th, td,
                                    article, aside, canvas, details, embed, 
                                    figure, figcaption, footer, header, hgroup, 
                                    menu, nav, output, ruby, section, summary,
                                    time, mark, audio, video {
                                        margin: 0;
                                        padding: 0;
                                        border: 0;
                                        font-size: 100%;
                                        font: inherit;
                                        vertical-align: baseline;
                                    }
                                    /* HTML5 display-role reset for older browsers */
                                    article, aside, details, figcaption, figure, 
                                    footer, header, hgroup, menu, nav, section {
                                        display: block;
                                    }
                                    body {
                                        line-height: 1;
                                    }
                                    ol, ul {
                                        list-style: none;
                                    }
                                    blockquote, q {
                                        quotes: none;
                                    }
                                    blockquote:before, blockquote:after,
                                    q:before, q:after {
                                        content: '';
                                        content: none;
                                    }
                                    table {
                                        border-collapse: collapse;
                                        border-spacing: 0;
                                    }

                                    /*__________________________________________________Universal
                                    Universal
                                    */

                                    body {
                                        background-color: #F0F0F0;
                                        background-repeat:repeat;
                                        font-size: 100%;
                                        color: #000;
                                        font-family: Arial, Helvetica, sans-serif;
                                    }

                                    .left {
                                        float: left;
                                    }

                                    .right {
                                        float: right;
                                    }

                                    .clear {
                                        clear: both;
                                    }

                                    input, textarea {
                                        margin: 0;
                                        padding: 0;
                                        border: none;
                                        outline: none;
                                        background: transparent;
                                        font-family: Arial, Helvetica, sans-serif;
                                    }

                                    p, input {
                                        font-size: 1em;
                                        padding: 2px 0;
                                    }

                                    textarea {
                                        display: block;
                                        background: #E3FAFA;
                                    }

                                    input {
                                        background: #E3FAFA;
                                    }

                                    input:hover, textarea:hover {
                                        background: #FFFFCC;
                                    }

                                    input:focus, textarea:focus {
                                        border: 1px solid #666;
                                    }

                                    .price:hover {
                                        background: #FFF;
                                    }

                                    .price:focus {
                                        border: none;
                                    }

                                    .button {
                                        display: inline;
                                        padding: 4px 8px; 
                                        background: url(../images/button-bg.png) repeat-x; 
                                        color: #666;
                                        border: 1px solid #ccc; 
                                        font: bold .95em Helvetica; 
                                        text-decoration: none;
                                    }

                                    .button:hover { 
                                        color: #333;
                                        border: 1px solid #666;
                                        background: url(../images/button-bg.png) repeat-x; 
                                    }

                                    .button:active {
                                        background: url(../images/button-bg.png) repeat-x; 
                                        background-position: bottom left;
                                    }

                                    /*__________________________________________________Head
                                    Head
                                    */

                                    #head {
                                        margin: 0 auto;
                                        padding-top: 10px;
                                        margin-bottom: 20px;
                                        width: 864px;
                                    }

                                    h1 {
                                        padding-bottom: 10px;
                                        color: #EEE;
                                        font-weight: normal;
                                        font-size: 2em;
                                    }

                                    #about-head {
                                        margin-bottom: 4px;
                                    }

                                    h3 {
                                        color: #333;
                                        font-size: 1.4em;
                                        display: inline;
                                    }

                                    #about, #how-to {
                                        padding: 5px;
                                        background: #EEE;
                                        color: #333;
                                        border: 1px solid #666;
                                    }

                                    #about p, #how-to p {
                                        padding-bottom: 8px;
                                    }

                                    strong {
                                        font-weight: bold;
                                    }	

                                    /*__________________________________________________Banner Ad
                                    Banner AD
                                    */

                                    #banner-ad {
                                        margin-bottom: 20px;
                                    }

                                    /*__________________________________________________Actions
                                    Actions
                                    */

                                    #actions {
                                        margin: 0 auto;
                                        padding-top: 10px;
                                        margin-bottom: -20px;
                                        width: 864px;
                                    }

                                    /*__________________________________________________Main
                                    Main
                                    */

                                    #main {
                                        margin: 30px auto;
                                        padding: 32px;
                                        width: 800px;
                                        height: 1040px;
                                        background: #FFF;
                                        border: 1px solid #808080;
                                    }
                                    .main {
                                        margin: 30px auto;
                                        padding: 32px;
                                        /*width: 800px;*/
                                        height: 1040px;
                                        background: #FFF;
                                        border: 1px solid #808080;
                                        page-break-after: always;
                                    }

                                    /*__________________________________________________Invoice
                                    Invoice
                                    */

                                    #title {
                                        font-weight: bold;
                                        text-align: center;
                                        padding-bottom: 16px;
                                    }

                                    #title h1 {
                                        padding: 0;
                                        margin: 0;
                                        font-size: 1.25em;
                                        color: #000;
                                    }

                                    #title h2 {
                                        font-size: 1em;
                                        color: #000;
                                    }


                                    #invHeader {
                                        padding-bottom: 16px;
                                        margin-bottom: 16px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headLeft, #signatureLeft {
                                        float: left;
                                        width: 392px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headLeft p, #headRight p, #signatureLeft p, #signatureRight p {
                                        font-weight: bold;
                                        font-size: .85em;
                                    }

                                    #legal {
                                        padding: 4px;
                                        margin-bottom: 4px;
                                        border: 1px solid #CCC;
                                        font-size: .70em;
                                    }

                                    #legal ul {
                                        list-style-type: circle;
                                    }

                                    #legal ul li {
                                        padding: 4px 0;
                                        margin-left: 2em;
                                    }

                                    #signature p {
                                        padding-left: 4px;
                                    }

                                    #headLeft div {
                                        padding: 4px;
                                        border-top: 1px solid #CCC;
                                        border-left: 1px solid #CCC;
                                        border-right: 1px solid #CCC;
                                    }

                                    #signatureLeft div {
                                        padding: 1px 4px;
                                        border-top: 1px solid #CCC;
                                        border-left: 1px solid #CCC;
                                        border-right: 1px solid #CCC;
                                    }

                                    #signatureRight div {
                                        padding: 1px 4px;
                                    }

                                    #signatureRightRight {
                                        border-left: none !important;
                                    }

                                    #headLeft textarea {
                                        font-size: 1.2em;
                                        text-align: left;
                                        width: 100%;
                                        height: 96px;
                                    }

                                    #headRight {
                                        margin-left: 12px;
                                        float: left;
                                        width: 392px;
                                        border: 1px solid #CCC;
                                    }

                                    #signatureRight {
                                        float: left;
                                        width: 402px;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    #headRightRight div, #headRightLeft div {
                                        padding: 0 4px;
                                    }

                                    #headRight p {
                                        padding-left: 4px;
                                    }

                                    #headLeft input, #headRight input, #signatureLeft input, #signatureRight input {
                                        margin-bottom: 8px;
                                        width: 100%;
                                        display: block;
                                    }

                                    #headRightLeft, #headRightRight {
                                        padding-top: 32px;
                                        padding-bottom: 60px;
                                        float: left;
                                        width: 192px;
                                    }

                                    #signatureRightLeft, #signatureRightRight {
                                        float: left;
                                        width: 192px;
                                    }

                                    #headRight textarea {
                                        font-size: 1em;
                                        text-align: left;
                                        width: 100%;
                                        height: 72px;
                                    }

                                    #headRightBottom {
                                        padding: 4px;
                                        border-top: 1px solid #CCC;
                                        width: 374px;
                                    }

                                    #headRightBottom textarea {
                                        font-size: 1.2em;
                                        text-align: left;
                                        width: 100%;
                                        height: 96px;
                                    }

                                    table {
                                        width: 800px;
                                    }

                                    table { border-collapse: collapse; }
                                    table td, table th { padding: 5px; }

                                    table th {
                                        text-align: left;
                                        font-weight: bold;
                                        border-bottom: 1px solid #CCC;
                                    }

                                    table th input {
                                        font-weight: bold;
                                        display: inline;
                                        width: 32px;
                                    }

                                    table tr td input {
                                        width: 100%;
                                    }

                                    table tr td textarea {
                                        margin-top: -16px;
                                        width: 100%;
                                        height: 24px;
                                        font-size: 16px;
                                    }

                                    .item-name {
                                        width: 432px;
                                    }


                                    .hsNo {
                                        width: 80px;
                                    }

                                    .NC {
                                        width: 80px;
                                    }

                                    .mfr {
                                        width: 80px;
                                    }

                                    .pref {
                                        width: 80px;
                                    }

                                    .country {
                                        width: 80px;
                                    }

                                    .countryInpt {
                                        width: 80px;
                                    }

                                    .delete-wpr input {
                                        display: inline;
                                        width: 432px;
                                    }

                                    .delete {
                                        text-decoration: none;
                                        font-weight: bold;
                                        color: red;
                                        padding-right: 3px;
                                        margin-right: 3px;
                                        margin-left: -19px;
                                        border-right: 1px solid #000;
                                    }

                                    #addrow {
                                        text-decoration: none;
                                        color: green;
                                    }
                                    .total-line,  .total-weight, .total-qty, .total-value {
                                        font-weight: bold;
                                    }

                                    .sub-total {
                                        background: #DDD;
                                    }

                                    #signature {
                                        margin-top: 32px;
                                    }
                                    /**default*/

                                    .main h1 {
                                        text-transform: uppercase;
                                        color: #CCCCCC;
                                        text-align: right;
                                        font-size: 24px;
                                        font-weight: normal;
                                        padding-bottom: 5px;
                                        margin-top: 0px;
                                        margin-bottom: 15px;
                                        border-bottom: 1px solid #CDDDDD;
                                    }
                                    .main .store {
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }
                                    .main .div2 {
                                        float: left;
                                        display: inline-block;
                                    }
                                    .main .div3 {
                                        float: right;
                                        display: inline-block;
                                        padding: 5px;
                                    }
                                    .main .heading td {
                                        background: #E7EFEF;
                                    }
                                    .main .address,.main .product {
                                        border-collapse: collapse;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #CDDDDD;
                                        border-right: 1px solid #CDDDDD;
                                    }
                                    .main .address th,.main.address td {
                                        border-left: 1px solid #CDDDDD;
                                        border-bottom: 1px solid #CDDDDD;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .main .address td {
                                        width: 50%;
                                    }
                                    .main .product {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #CDDDDD;
                                        border-right: 1px solid #CDDDDD;
                                    }
                                    .main .product td {
                                        border-left: 1px solid #CDDDDD;
                                        border-bottom: 1px solid #CDDDDD;
                                        padding: 5px;
                                    }
                                    textarea, input[type=text]
                                    {
                                        font-size:13px!important;
                                    }
                                    .main
                                    {
                                        border:none!important;
                                        /* height: 1095px;*/
                                        margin: 0 auto;
                                    }
                                    .main .calculation {
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid black;
                                        border: 1px solid black;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main h1 {
                                        border-bottom: 1px solid black;
                                    }
                                    @page {
                                        size: A4 portrait;
                                        margin:0.1in 0.1in 0in 0in;
                                    }
                                    @media print {
                                        /* td{
                                             border-color: black;
                                             border-width: 2px;
                                             background:#fff;
                                         }
                                        */
                                    }
                                    .main+.main {
                                        page-break-before:always;
                                    }
                                </style>
                                <style>
                                    .address th, .address td {
                                        border-left: 0px solid #000;
                                        border-bottom: 1px solid #000;
                                        padding: 5px;
                                        vertical-align: text-bottom;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid #000;
                                        border-right: 0px solid #000;
                                    }

                                    .main .calculation {
                                        border-top: 1px solid #000;
                                        border-right: 0px solid #000;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid #000;
                                        border-top-width: 1px;
                                        border-right-width: 0px;
                                        border-bottom-width: 1px;
                                        border-left-width: 1px;
                                        border-top-style: solid;
                                        border-right-style: solid;
                                        border-bottom-style: solid;
                                        border-left-style: solid;
                                        border-top-color: #000;
                                        border-right-color: #000;
                                        border-bottom-color: #000;
                                        border-left-color: #000;
                                        -moz-border-top-colors: none;
                                        -moz-border-right-colors: none;
                                        -moz-border-bottom-colors: none;
                                        -moz-border-left-colors: none;
                                        border-image-source: none;
                                        border-image-slice: 100% 100% 100% 100%;
                                        border-image-width: 1 1 1 1;
                                        border-image-outset: 0 0 0 0;
                                        border-image-repeat: stretch stretch;
                                    }

                                </style>
                                <style>
                                    .main {
                                        border: medium none !important;
                                        height: auto;
                                        display: block;
                                    }
                                    .main .calculation {
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                        width: 100%;
                                        border-spacing: 0px;
                                        border-collapse: collapse;
                                    }
                                    .main .calculation th, .calculation td {
                                        border: 1px solid black;
                                        border: 1px solid black;
                                    }
                                    .main .address {
                                        width: 100%;
                                        margin-bottom: 20px;
                                        border-top: 1px solid black;
                                        border-right: 1px solid black;
                                    }
                                    .main h1 {
                                        border-bottom: 1px solid black;
                                    }
                                    td{font-size: 10px;}
                                    @media print{
                                        .form_div{
                                            display:none;
                                        }
                                    }
                                    .ajax_resp{text-align:center}
                                </style>

                    <div class="main" style="page-break-after: always;">
                        <h1 style="color:black; text-align:center;">Medicine Report</h1>
                            <a href="/console/" >
                                <img src="/img/simplebillingslogo.jpeg" style="position: absolute;top: 0;background-color: white; height: 50px">
                            </a><hr/>
                           <!--  <div class="form_div" style="margin-bottom: 10px;text-align: center;"> -->
                            <div class="container">
                                <div class="row form-group">
                                    <form method="post" onsubmit="return false">
                                        <div class="form-row">
                                            <div class="form-group col-sm-3">
                                                <label for="supplier_id">Supplier:</label>
                                                <select name="supplier_id" class="form-control">
                                                    <option value="">--supplier name--</option>
                                                    <?php foreach ($supplier as $val) { ?>
                                                        <option value="<?= $val['supplier_id'] ?>"><?= $val['supplier_name'] ?></option> 
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="datepicker">Start Date:</label>
                                                <input typex="text" type="date-local" value="<?=  date('Y-m-d',strtotime("-1 month")) ?>" id="start" name="start" class="datepicker form-control">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="datepicker">End Date:</label>
                                                <input typex="text" type="date-local" value="<?=  date('Y-m-d') ?>" id="end" name="end" class="datepicker form-control">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <button id="report_sub" class="btn btn-info" style=" margin-top: 9%;">SEARCH</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="ajax_resp">Choose Filter To Generate Data</div>
                            </div>                                                
                        </body>
                    </html>
                    <div class="container-fluid" style="padding-right: 20px; padding-left: 20px;">
                    <hr style="border-top: 1px solid #f5f5f5; border-bottom: 1px solid #cccccc;">                                           
                    <footer style="text-shadow: 0px 1px 9px #99B8C4;font-weight: bold;font-size: smaller;">
                    <div class="row-fluid">
                        <div class="span4">© <?=date('Y')?> SimpleBillings - All Rights Reserved</div>
                        <div class="span4" style="text-align: center;"><p class="center">Powered By <br> <a target="_blank" href="https://www.logicmystery.com"><img style="height: 50px;" src="/img/logicmystery.png"/></a></p></div>
                    <div id="google_translate_element" class="span4" style="text-align: right;"></div>
                    </div>

                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                      new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                    }
                    </script>

                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </footer>
                    </div>
