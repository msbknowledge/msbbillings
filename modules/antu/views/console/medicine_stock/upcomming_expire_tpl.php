
    <!-- <script>
                                $(function () {
                                    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
                                });
                            </script> -->
    <!--  <script>
                                var reqst = null;
                                $(document).ready(function () {
                                    $('#report_sub').click(function () {
                                        reqst = $.post("<?= base_url() ?>console/medicine_stock/stock/", $('form').serialize(), function (resp) {
                                            $(".ajax_resp").html(resp);
                                            $('div#container').hide();
                                        });
                                    });
                                    $('div#container').hide();
                                   
                                });
                            </script> -->


    <style>
        body {
            background: #FFFFFF;
        }

        body,
        td,
        /*th,*/
        input,
        select,
        textarea,
        option,
        optgroup {
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

        .address,
        .product {
            border-collapse: collapse;
        }

        .address {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid black;
            border-right: 1px solid black;
        }

        .address th,
        .address td {
            border-left: 1px solid black;
            border-bottom: 1px solid black;
            padding: 5px;
            vertical-align: text-bottom;
        }

        /*.address td {*/
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

        .delete,
        .button,
        #addrow,
        #head,
        #actions {
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

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
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
            background-repeat: repeat;
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

        input,
        textarea {
            margin: 0;
            padding: 0;
            border: none;
            outline: none;
            background: transparent;
            font-family: Arial, Helvetica, sans-serif;
        }

        p,
        input {
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

        input:hover,
        textarea:hover {
            background: #FFFFCC;
        }

        input:focus,
        textarea:focus {
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

        #about,
        #how-to {
            padding: 5px;
            background: #EEE;
            color: #333;
            border: 1px solid #666;
        }

        #about p,
        #how-to p {
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

        #headLeft,
        #signatureLeft {
            float: left;
            width: 392px;
            border-bottom: 1px solid #CCC;
        }

        #headLeft p,
        #headRight p,
        #signatureLeft p,
        #signatureRight p {
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

        #headRightRight div,
        #headRightLeft div {
            padding: 0 4px;
        }

        #headRight p {
            padding-left: 4px;
        }

        #headLeft input,
        #headRight input,
        #signatureLeft input,
        #signatureRight input {
            margin-bottom: 8px;
            width: 100%;
            display: block;
        }

        #headRightLeft,
        #headRightRight {
            padding-top: 32px;
            padding-bottom: 60px;
            float: left;
            width: 192px;
        }

        #signatureRightLeft,
        #signatureRightRight {
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

        table {
            border-collapse: collapse;
        }

        table td,
        table th {
            padding: 5px;
        }

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

        .total-line,
        .total-weight,
        .total-qty,
        .total-value {
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

        .main .address,
        .main .product {
            border-collapse: collapse;
        }

        .main .address {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #CDDDDD;
            border-right: 1px solid #CDDDDD;
        }

        .main .address th,
        .main.address td {
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

        textarea,
        input[type=text] {
            font-size: 13px !important;
        }

        .main {
            border: none !important;
            /* height: 1095px;*/
            margin: 0 auto;
        }

        .main .calculation {
            border-top: 1px solid black;
            border-right: 1px solid black;
        }

        .main .calculation th,
        .calculation td {
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
            margin: 0.1in 0.1in 0in 0in;
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
            page-break-before: always;
        }
    </style>
    <style>
        .address th,
        .address td {
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

        .main .calculation th,
        .calculation td {
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

        .main .calculation th,
        .calculation td {
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

        td {
            font-size: 10px;
        }
        .print-only {
                display: none;
            }
        @media print {
            .form_div {
                display: none;
            }

            .display_print {
                display: none;
            }

            .container-fluid {
                display: none;
            }
            a[href]:after {
                content: none !important;
            }
            #link_remove {
                display: none;
            }

            .print-only {
                display: block;
            }

            .tfoot {
                display: none;
            }

            table thead {
                display: table;
                width: 100%;
                background-color: lightblue;
                position: fixed;
            }
        }

        .ajax_resp {
            text-align: center
        }
    </style>
    <style>
            @media print {

                html,
                body {
                    display: block;
                    font-family: "Calibri";
                    margin: 0;
                }

                @page {
                    size: 21.59cm 13.97cm;
                }

                .logo {
                    width: 30%;
                }

            }

            .btn-block {
                color: blue;
                background-color: #337ab7;
                border-color: #2e6da4;
            }
        </style>

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <div class="index-wrapper">
         <div class="row-fluid sortable search_box ui-sortable">
            <div class="box span12">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-search"></i>Upcomming expire</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <h1 style="color:black; text-align:center;">Upcomming Expire Sheet</h1>
                
                    <div class="display_print">
                        <p style="text-align: center;color:red">*** There show only for purchase medicine upcomming expire details ***</p><br>
                        <!-- <div class="form_div form-group" style="margin-bottom: 10px;text-align: center;"> -->
                        <div class="container">
                            <div class="row form-group">
                                <!-- <form action="" id="searchform" role="form" method="post" > -->
                                <form action="<?= base_url() ?>console/medicine_stock/expiring" id="searchform" role="form" method="post" onsubmit="return false">
    <div class="row">
        <!-- Empty column for spacing -->
        <div class="col-sm-4"></div>

        <!-- Medicine Name Input -->
        <div class="col-sm-3">
            <div class="form-group">
                <label for="medicine_name">Medicine Name:</label>
                <input type="text" name="medicine_name" id="medicine_name" value="<?= $medicine_name ?>" required class="form-control" />
            </div>
        </div>

        <!-- Search Button -->
     <div class="col-sm-2">
            <div class="form-group">
                <label>&nbsp;</label> <!-- empty label for spacing -->
                <button type="submit" id="search" class="btn btn-info btn-block">SEARCH</button>
            </div>
        </div>
    </div>
</form>

                            </div>
                        </div>
                        <div class="ajax_resp">Choose Filter To Generate Data</div>
                    </div>
                    <br>
                    
                    <div class="row" style=" margin: 0px; overflow-x: scroll;">
                        <table class="table table-bordered table-striped table-condensed">
                            <!--  <caption><h3>Expire List</h3></caption> -->
            
                            <tr>
                                <th>Sl No.</th>
                                <th>Medicine Name</th>
                                <th>Batch</th>
                                <th>Purchase Date</th>
                                <th>Stock strip</th>
                                <th>Stock loose</th>
                                <th>Mfg</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Storage</th>
                            </tr>
                            <tbody id="searchResult">
            
                            </tbody>
                            <tfoot class="tfoot">
                                <tr>
                                    <!-- <td colspan=9></td> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>

  </div>
<script>
    function myFunction(current_month) {
        var month = new Array();
        month[1] = "January";
        month[2] = "February";
        month[3] = "March";
        month[4] = "April";
        month[5] = "May";
        month[6] = "June";
        month[7] = "July";
        month[8] = "August";
        month[9] = "September";
        month[10] = "October";
        month[11] = "November";
        month[12] = "December";
        var n = month[current_month];
        return n;
    }
    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan=10>Searching Results...</td></tr>");
        }
        //console.log(pageCount);
        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
           
            if (resp.status == "found"){
                if (Object.keys(resp.result).length > 0) {
                    if (pageCount == 1) {
                        $('#searchResult').html("");
                    }
                    // if (objresp.result.length < 400) {
                    // $('tfoot').html("<tr><td colspan=10 class=\"coveo-result-row\"> No More Result Found </td></tr>");
                    // } else {

                    // $(window).scroll(function () { 
                    // if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
                    //     search();
                    // }
                    // });
                    $('tfoot').html("<tr><td colspan=10><button class='btn btn-block' onclick='search()' id='loadmore'>Load More</button></td></tr>");
                    //}
                    if (pageCount == 1) {
                        var counter = pageCount;
                    } else {
                        $getper = localStorage.getItem("previousCount");
                        var counter = parseInt($getper);
                    }
                    $.each(resp.result, function(k, v) {
                        var medicine_id = btoa(v.medicine_id);
                        var tr_des = $("<tr/>");

                        var count_td = $("<td/>").append(counter);
                        $(tr_des).append(count_td);

                        var name_td = $("<td/>").append("<a id='link_remove' href='<?= console_url() ?>medicine_stock/fast_update/" + v.medicine_id + "' target='_blank' class='btn btn-info'>" + v.medicine_name + "</a><p class='print-only'>" + v.medicine_name + "</p>");
                        $(tr_des).append(name_td);

                        var batch_td = $("<td/>").append(v.purchase_batch);
                        $(tr_des).append(batch_td);

                        var date_td = $("<td/>").append(v.purchase_date);
                        $(tr_des).append(date_td);

                        var left_strip_td = $("<td/>").append(v.left_strip);
                        $(tr_des).append(left_strip_td);

                        var left_loose_td = $("<td/>").append(v.left_loose);
                        $(tr_des).append(left_loose_td);

                        var manufacturer_td = $("<td/>").append(v.medicine_manufacturer);
                        $(tr_des).append(manufacturer_td);

                        var getmonth = myFunction(v.purchase_expire_month);

                        var month_td = $("<td/>").append(getmonth);
                        $(tr_des).append(month_td);

                        var year_td = $("<td/>").append(20, v.purchase_expire_year);
                        $(tr_des).append(year_td);

                        var storage_td = $("<td/>").append(v.medicine_storage);
                        $(tr_des).append(storage_td);

                        $('#searchResult').append(tr_des);

                        counter++;
                        localStorage.setItem("previousCount", counter);
                    })
                    pageCount = pageCount + 1;
                } else {
                    pageCount = pageCount + 1;
                    search();
                }
            } else  {
                $('#searchResult').hide();
                $('tfoot').html("<tr><td colspan=10 class=\"coveo-result-row\">No More Result Found</td></tr>");
            } 
        });
    }

    $(document).ready(function() {
        $("#searchform").submit(function() {
            pageCount = 1;
            search();
        });
        $('#searchform').trigger(search());
    });

    $(document).ready(function () {
            $(document).find('[name^="medicine_name"]').autocomplete({
                source: '/search.php?table=medicines&fieldToSearch=medicine_name',
                search: function (event, ui) {
                    $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
                },
                minLength: 1, select: function (event, ui) {
                    targetRow = $(this).parents('.medicine_chooser');
                    $.each(ui.item.complete, function (populate_field, populate_value) {
                        $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                    });
                  $('.rowadd').html('');
                  $('#searchform').trigger(search());
                }
            });
        });
</script>

<div class="container-fluid" style="padding-right: 20px; padding-left: 20px;">
    <hr style="border-top: 1px solid #f5f5f5; border-bottom: 1px solid #cccccc;">
   
</div>