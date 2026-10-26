<html>
    <head>
        <title>Credit Note</title>
        <style>
            .calculation
            {
                border: 1px solid #000;
            }
            body{font-family: sans-serif;font-size: 14px}
            input[type='Text']{border: none;font-family: sans-serif;}
            @media print{
                .hide_print{ display: none}
            }
            .wrapper table {
                border-style: solid;
                min-width: 500px;
                border-collapse: collapse;
            }
            .wrapper table td {
                border-style: inset;
                font-size: 14px;
            }
            .wrapper {
                padding: 10px;
                /*background-color: #F00;*/
                /*                height: 25cm;*/
            }
            .breakline1{
                height: auto;
                width: 80%;
                float: left;
                padding: 0px 10%;
            }
            .logo{ width: 55%}
            .wrapper table td {
                border-style: solid;
                border-width: 1px;
            }
            #container {
                display: table;
            }

            #row  {
                display: table-row;
            }

            #left, #right, #middle {
                display: table-cell;
            }
        </style>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    </head>
    <body>
        <div class="wrapper">    
            <form name="fastbill" action="" method="post"> 
                <div class="header">
                    <div style="width:40%; height:auto; margin-top:3%; float:left; margin-left:10%">
                        <img class="logo" src="<?php echo base_url('modules/bbbc/views/console/extras/LOGO.PNG'); ?>"/>
                        <p>
                            <b>BENGAL BROADBAND & CABLE TV SERVICES PVT. LTD.</b><br/>
                        <p style="text-align:left;">
                            891,JESSORE ROAD. KOLKATA-700055
                        </p>
                        </p>
                    </div>
                    <div style="width:50%; height:auto; float:left; margin-top:3%;">
                        <h3 style="text-align:center;"><a style="background: lightgray;"> Credit Note </a></br>
                            <input style="font-size:16px;text-align: center" type="text" value="BB/<?=  date('m')?>/<?=  date('y')?>/04">
                        </h3>
                        <p style="text-align:center;">MOBILE : 9051616767</p>
                    </div>
                </div>
                <div class="breakline1" >
                    <hr/>
                </div>
               
                <div style="margin-left: 10%;margin-top: 30px; float: left; height: auto; width: 80%;">
                    <p style="line-height: 30px;">
                        <b>NAME OF LCO :</b> <span id="NAME_OF_LCO"></span> <br/>
                        <b>ADDRESS :</b> <span id="ADDRESS"></span><br/>
                        <b>CONTACT  PERSON :</b> <span  id="CONTACT_PERSON" ></span><br/>
                        <b>CODE :</b> <input type="text" id="lco_id" name="lco_id" value="" style="display: none;"/>
                        <input style="width:40%;"  type="text" value="" id="code" placeholder="PLEASE ENTER THE CODE"/>
                        <span style="float: right;margin-right: 10px"><b>Date :</b> <input name="invoice_date" style="width:75px" type="text" value="<?= date('d/m/Y'); ?>" id="datepicker"/> </span>
                    </p>
                </div>
                <div style="width:80%;min-width: 500px; margin-left:10%; float:left; height:auto;">
                    <table class="calculation" style="width:100%;border-bottom: none">

                        <tr >
                            <td style="border:none">
                                CREDIT NOTE FOR THE PERIOD OF
                            </td>
                            <td style="border:none;text-align:right;">
                                FROM <select name="credit_note_period_start">
                                    <? foreach ($invoice_periods as $key => $value) { ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>  
                                    <? } ?>
                                </select>    
                            </td>
							<td style="border:none;text-align:right;">
                                TO <select name="credit_note_period_end">
                                    <? foreach ($invoice_periods as $key => $value) { ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>  
                                    <? } ?>
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;" class="hide_print">NO. OF ACTIVE STBs: <input style="margin-left:2%;width: 40px" type="text" name="stb" id="a" value="0"/>PCs</td>
                        </tr>
                    </table>
                    <table border="" style="width:100%;" cellspacing="0">
                        <tr>
                            <td>RATE</td>
                            <td>Rs.</td>
                            <td><input type="text" name="rate" value="5.00" id="b"/></td>
                            <td>Rs.</td>
                            <td><input type="text" name="total_stb_costing" value="0.00" id="c"/></td>
                        </tr>
               
                        <tr>
                            <td>AMOUNT PAYABLE</td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="amount_payable" value="0.00" id="i"/></td>
                        </tr>
                    </table>
                    <table class="calculation" style="width:100%;border-top: none">

                        <tbody>
                            <tr>
                                <td style="border:none; text-align: right">Rs. <span id="j"></span> ONLY.&nbsp; &nbsp; </td>
                            </tr>
                            <tr>
                                <td style="border:none; text-align: right">E & OE.&nbsp; &nbsp;</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div style="height: auto; float: right;margin-top: 20%; margin-right: 10%;">
                    <hr/>
                    <p style="text-align:center;height: 20px;">FOR BENGAL BROADBAND & CABLE TV SERVICES PVT. LTD.</p>
                </div>
                <input type="submit" style="position: fixed; bottom: 10px; right: 10px;" value="save" class="hide_print"/>

            </form>
            <button onclick="window.print();" style="position: fixed; bottom: 10px; right: 100px;" class="hide_print">Print</button>

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
                        source: "../lco/search",
                        minLength: 2,
                        select: function (event, ui) {
                            $('#NAME_OF_LCO').html(ui.item.NAME_OF_LCO);
                            $('#lco_id').val(ui.item.id);
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
           
                
                var sum = (c);
                $("#i").val(sum.toFixed(2));

                var words = toWords(sum.toFixed(2));

                $("#j").html(words.replace("POINT ZERO ZERO",""));
            }
            $(document).ready(function () {

                $("input").on("keyup", function () {
                    calc();
                })
            })

            $(function () {
                $("#datepicker").datepicker();
                $("#datepicker").datepicker("option", "dateFormat", 'dd/mm/yy');
                $("#datepicker").datepicker("setDate", "<?= date('d/m/Y'); ?>");

            });
        </script>


    </body>
</html>
