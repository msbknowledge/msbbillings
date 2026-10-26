<html>
    <head>
        <title>INVOICE</title>
        <style>
            .calculation
            {
                border: 1px solid #000;
            }
            body{font-family: sans-serif;}
            input{border: none;font-family: sans-serif;}
        </style>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        
        <div style="width:40%; height:auto; margin-top:3%; float:left; margin-left:10%">
            <img src="<?php base_url()?>/img_1/<?= get_option('site_logo')?>"/>
                <?php echo (get_option('company_details'));?>
            <!-- <img style="width: 36%;" src="<?php// echo base_url('modules/bbbc/views/console/extras/LOGO.PNG'); ?>"/>
            <p>
                <b>BENGAL BROADBAND & CABLE TV SERVICES PVT. LTD.</b><br/>
            <p style="text-align:left;">
                891,JESSORE ROAD. KOLKATA-700055
            </p>
        </p> -->
    </div>
    <div style="width:40%; height:auto; float:left; margin-top:3%;">
        <h3 style="text-align:center;"><a style="background: lightgray;"> INVOICE </a></br>
        <?php echo (get_option('invoice_number'));?>
        <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice"/>
        </h3>
        <!-- <p style="text-align:center;">MOBILE : 9051616767</p> -->
    </div>
    <div style="height:auto; width:75%; margin-left:7%; float:left;">
        <hr/>
    </div>
    <div style="width:75%; margin-left:7%; float:left; height:auto;">
        <div style="width:40%; height:auto; float:left; margin-left: 4%;">
            <p>
                SERVICE TAX REGN. NO.<br/><br/>
                AMUSEMENT TAX NO.
            </p>
        </div>
        <div style="width:56%; height:auto; float:left;">
            <p style="text-align:right;">
                <b>AAFCB0558ASD002<br/><br/>
                    APPLIED FOR</b>
            </p>
            <hr/>
        </div>
    </div>
    <div style="width:77%; margin-left:7%; float:left; height:auto;">
        <p style="margin:4%; line-height: 25px;">
            <b>NAME OF LCO :</b> <span id="NAME_OF_LCO"></span> <br/>
            <b>ADDRESS :</b> <span id="ADDRESS"></span><br/>
            <b>CONTACT  PERSON :</b> <span  id="CONTACT_PERSON" ></span><br/>
            <b>CODE :</b> <input style="width:40%;" type="text" value="" id="code" placeholder="PLEASE ENTER THE CODE"/>
            <span style="float: right"><b>Date :</b> <input style="width:66px" type="text" value="<?=date('d.m.Y');?>"/> </span>
        </p>
    </div>
    <div style="width:71%; margin-left:10%; float:left; height:auto;">
        <table class="calculation" style="width:100%;">
            <tr>
                <td></td>
                <td style="text-align:right;">Date: 30.04.2015</td>
            </tr>
            <tr>
                <td>
                    INVOICE FOR THE MONTH
                </td>
                <td style="text-align:right;">
                    APRIL 2015
                </td>
            </tr>
            <tr>
                <td style="display: none">NO. OF ACTIVE STBs: <input style="margin-left:2%;width: 40px" type="text" name="stb" id="a" value="0.00"/>PCs</td>
            </tr>
        </table>
        <table border="" style="width:100%;">
            <tr>
                <td>RATE</td>
                <td>Rs.</td>
                <td><input type="text" name="rate" value="87.72" id="b"/></td>
                <td>Rs.</td>
                <td><input type="text" name="total" value="0.00" id="c"/></td>
            </tr>
            <tr>
                <td>ADD S.TAX @</td>
                <td>%</td>
                <td><input type="text" name="stax" value="14" id="d"/></td>
                <td>Rs.</td>
                <td><input type="text" name="addstax" value="0.00" id="e"/></td>
            </tr>
            <tr>
                <td>ADD AMUSEMENT TAX</td>
                <td>Rs.</td>
                <td><input type="text" name="aat" value="10.00" id="f"/></td>
                <td>Rs.</td>
                <td><input type="text" name="addaat" value="0.00" id="g"/></td>
            </tr>
            <tr>
                <td>ADD OUTSTANDING</td>
                <td></td>
                <td></td>
                <td>Rs.</td>
                <td><input type="text" name="ao" value="0.00" id="h"/></td>
            </tr>
            <tr>
                <td>AMOUNT PAYBLE</td>
                <td></td>
                <td></td>
                <td>Rs.</td>
                <td><input type="text" name="ap" value="0.00" id="i"/></td>
            </tr>
        </table>
        <div style="width:100%; float:left; height:auto; border: 1px solid #000; border-top:none;">
            <p style="text-align:right;">Rs. <input style="width: 40%;" type="text" name="to" value="0.00" id="j"/> ONLY.&nbsp; &nbsp; <br/>
                E & OE.&nbsp; &nbsp;
            </p>
        </div>
    </div>
    <div style="width:30%; margin-top: 6%; height:auto; float:left; margin-left:10%">
        <hr/>
        <p style="text-align:center;height: 20px;">ISSUED BY</p>
    </div>
    <div style="width:30%; margin-top: 6%; margin-left: 11%; height:auto; float:left;">
        <hr/>
        <p style="text-align:center;height: 20px;">AUTHORISED SIGNATORY</p>
    </div>
    <div style="height:20%; width:78%; margin-left:7%; float:left;">
        <hr/>
    </div>

    <script src="<?php echo base_url('modules/bbbc/views/console/extras/jquery.min.js'); ?>"></script>
    <script>
        // Convert numbers to words
        // copyright 25th July 2006, by Stephen Chapman http://javascript.about.com
        // permission to use this Javascript on your web page is granted
        // provided that all of the code (including this copyright notice) is
        // used exactly as shown (you can change the numbering system if you wish)

        // American Numbering System
        var th = ['', 'thousand', 'million', 'billion', 'trillion'];
        // uncomment this line for English Number System
        // var th = ['','thousand','million', 'milliard','billion'];

        var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
        var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
        var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
        function toWords(s) {
            s = s.toString();
            s = s.replace(/[\, ]/g, '');
            if (s != parseFloat(s))
                return 'not a number';
            var x = s.indexOf('.');
            if (x == -1)
                x = s.length;
            if (x > 15)
                return 'too big';
            var n = s.split('');
            var str = '';
            var sk = 0;
            for (var i = 0; i < x; i++) {
                if ((x - i) % 3 == 2) {
                    if (n[i] == '1') {
                        str += tn[Number(n[i + 1])] + ' ';
                        i++;
                        sk = 1;
                    } else if (n[i] != 0) {
                        str += tw[n[i] - 2] + ' ';
                        sk = 1;
                    }
                } else if (n[i] != 0) {
                    str += dg[n[i]] + ' ';
                    if ((x - i) % 3 == 0)
                        str += 'hundred ';
                    sk = 1;
                }
                if ((x - i) % 3 == 1) {
                    if (sk)
                        str += th[(x - i - 1) / 3] + ' ';
                    sk = 0;
                }
            }
            if (x != s.length) {
                var y = s.length;
                str += 'point ';
                for (var i = x + 1; i < y; i++)
                    str += dg[n[i]] + ' ';
            }
            return str.replace(/\s+/g, ' ').toUpperCase();
            
        }
    </script>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function () {
            function log(message) {
                $("<div>").text(message).prependTo("#log");
                $("#log").scrollTop(0);
            }

            $("#code").autocomplete({
                source: "./search",
                minLength: 2,
                select: function (event, ui) {
                    $('#NAME_OF_LCO').html(ui.item.NAME_OF_LCO);
                    $('#ADDRESS').html(ui.item.ADDRESS);
                    $('#CONTACT_PERSON').html(ui.item.CONTACT_PERSON);
                    $('#a').val(ui.item.NO_OF_ACTIVE_STBS);
                    calc();

                }
            });
        });
    </script>

    <script>
        function calc() {
            var a = parseFloat($("#a").val());
            var b = parseFloat($("#b").val());
            var c = (a * b);
            $("#c").val(c.toFixed(2));
            var d = parseFloat($("#d").val());
            var e = (c * (d / 100));
            $("#e").val(e.toFixed(2));
            var f = parseFloat($("#f").val());
            var g = (a * f);
            $("#g").val(g.toFixed(2));
            var h = parseFloat($("#h").val());
            var sum = (c + e + g + h);
            $("#i").val(sum.toFixed(2));

            var words = toWords(sum.toFixed(2));
           
            $("#j").val(words);
        }
        $(document).ready(function () {

            $("input").on("keyup", function () {
                calc();
            })
        })
    </script>

</body>
</html>
