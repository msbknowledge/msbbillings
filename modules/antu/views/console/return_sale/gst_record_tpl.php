<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                    <link rel="stylesheet" href="/resources/demos/style.css">
                        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                        <script src="http://www.nikesh.me/js/mootools-1.2.4-core-nc.js" type="text/javascript" ></script>
                        <!--link rel="stylesheet" href="http://www.nikesh.me/demo/main.css" type="text/css" /-->
                        <link rel="stylesheet" href="http://www.nikesh.me/demo/loading.css" type="text/css" />
                        <script src="http://www.nikesh.me/demo/browserCheck.js" type="text/javascript" ></script>

                        <script>
                            $(function () {
                                $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                            });
                        </script>
                        <script>
                            $(document).ready(function () {
                                /* $(".customer_name").autocomplete({
                                 source: '/console/customer/customer_search_by_name/'
                                 });*/

                                $('div#container').hide();


                                $('#start_date,#end_date').on("change", function () {
                                    $('div#container').show();
                                    $.post("", {customer_name: $('.customer_name').val(),customer_gst: $('.customer_gst').val(), start: $('#start_date').val(), end: $('#end_date').val(), key: 'ajax_resp'}, function (resp) {
                                        $(".ajax_resp").html(resp);
                                        $('div#container').hide();
                                    });

                                });
                               
                                $('.customer_name').on("keyup", function () {
                                    $('div#container').show();
                                    $.post("", {customer_name: $('.customer_name').val(),customer_gst: $('.customer_gst').val(), start: $('#start_date').val(), end: $('#end_date').val(), key: 'ajax_resp'}, function (resp) {
                                        $(".ajax_resp").html(resp);
                                        $('div#container').hide();
                                    });

                                });
                                $('.customer_gst').on("keyup", function () {
                                    $('div#container').show();
                                    $.post("", {customer_name: $('.customer_name').val(),customer_gst: $('.customer_gst').val(), start: $('#start_date').val(), end: $('#end_date').val(), key: 'ajax_resp'}, function (resp) {
                                        $(".ajax_resp").html(resp);
                                        $('div#container').hide();
                                    });

                                });

                            });



                        </script>

                        <title>Collection Record</title>
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
                                    background-image:url('../images/bg.png');
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
                            </style>

                            <div class="main" style="page-break-after: always;">
                                <?php
                                $MonthArray = array();
                                $month = array('January-', 'February-', 'March-', 'April-', 'May-', 'June-', 'July-', 'August-', 'September-', 'October-', 'November-', 'December-');
                                for ($i = 17; $i < 18; $i++) {

                                    for ($j = 0; $j < 12; $j++) {
                                        if (($i == 17) && ($j > 5)) {
                                            $MonthArray[] = $month[$j] . $i;
                                        }
                                    }
                                }
                                ?>
                                <h1 style="color:black; text-align:center;">Complete Gst Ready Report Sheet</h1>
                                <div class="form_div" style="margin-bottom: 10px;text-align: center;">
                                    <form method="post">
                                       
                                        
                                        <input type="text" name="customer_name" placeholder="supplier name" class="customer_name">
                                        <input type="text" name="customer_gst" placeholder="supplier gst " class="customer_gst">
                                            <input type="text" id="start_date" name="start" placeholder="start date" class="datepicker" required>
                                                <input type="text" id="end_date" name="end" placeholder="end date" class="datepicker" required>

                                    </form>
                                </div>
                                <div class="ajax_resp">
                                    <div id='container'>

                                        <div id='loading'>
                                            <div id='Gen' style="margin-left:550px" class='marginLeft'>
                                                <div class='block' id='rotate_01'></div>
                                                <div class='block' id='rotate_02'></div>
                                                <div class='block' id='rotate_03'></div>
                                                <div class='block' id='rotate_04'></div>
                                                <div class='block' id='rotate_05'></div>
                                                <div class='block' id='rotate_06'></div>
                                                <div class='block' id='rotate_07'></div>
                                                <div class='block' id='rotate_08'></div>
                                                <div class='clearfix'></div>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="ajax_resp">
                         
                                </div>
                                </div>
                            </div>
                            
                        </body>
                        </html>