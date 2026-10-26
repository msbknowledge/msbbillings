<html>
    <head>
        <title>Statement Of Month</title>
		<style media="print">
		.wrapper{    page-break-after: always;}
		</style>
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
			.wrapper+.wrapper{    page-break-before: always;}
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
			#unique_code{
			position: absolute;
			margin-left: -70px;
			font-weight: initial;
			font-size: 16px;
			}
        </style>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: '',
            data: $('form').serialize(),
            success: function () {
              alert('Your data has been submitted successfully.');
            }
          });

        });

      });
    </script>
		
    </head>
    <body>
	<?php 
	//echo "hello";
	//pr($details);
	$decode = $details['invoice_meta'];
	//$b = json_decode($decode);
	$decoded_data = json_decode($decode, true);
	//pr($decoded_data);
	 ?>
        <div class="wrapper">    
            <?php /*<form name="fastbill" action="" method="post"> */?>
			<form>
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
                        <h3 style="text-align:center;"><a style="background: lightgray;"> Statement of Account </a></br>
						<?php// print_r($decoded_data);   ?>
                            <input style="font-size:16px;text-align: center" type="text" value="<?php echo $decoded_data['bill_no'];?>">
                        </h3>
                        <p style="text-align:center;">MOBILE : 9051616767</p>
                    </div>
                </div>
				
                <div class="breakline1" >
                    <hr/>
                </div>
                <div style="margin-left: 10%; float: left; height: auto; width: 80%;line-height: 25px">
                    <div style="clear: both; margin: 0px auto;"><span>SERVICE TAX REGN. NO.</span><span style="float: right"><b>AACCC1439JST001</b></span></div>
                    <div style="clear: both; margin: 0px auto;"><span>AMUSEMENT TAX NO.</span><span style="float: right"><b>8/ATS/KOL/2006</b></span></div>               
                </div>  
                <div style="margin-left: 10%;margin-top: 30px; float: left; height: auto; width: 80%;">
                    <p style="line-height: 30px;">
                        <b>NAME OF LCO :</b> <?php echo $decoded_data['name_of_lco'];?> <br/>
                        <b>ADDRESS :</b> <?php echo $decoded_data['address'];?><br/>
                        <b>CONTACT  PERSON :</b> <?php echo $decoded_data['contact_person'];?><br/>
                        <b>CODE :</b> <input type="text" id="lco_id" name="lco_id" value="" style="display: none;"/>
                        <?php echo $decoded_data['code'];?>
                        <span style="float: right;margin-right: 10px"><b>Date :</b> <?php echo $decoded_data['invoice_date'];?></span>
                    </p>
                </div>
                <div style="width:80%;min-width: 500px; margin-left:10%; float:left; height:auto;">
                    <table class="calculation" style="width:100%;border-bottom: none">

                        <tr >
                            <td style="border:none">
                                STATEMENT FOR THE MONTH 
                            </td>
                            <td style="border:none;text-align:right;">
                                <?php echo $decoded_data['inoice_period'];?>    
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none;display:none;" class="hide_print">NO. OF ACTIVE STBs: <?php echo $decoded_data['stb'];?>PCs</td>
                        </tr>
						
						<tr>
						     <td style="border:none;display:none;" class="hide_print">NO. OF ACTIVE HD PACK: <?php echo $decoded_data['hdstb'];?>PCs</td>
                            
                        </tr>
						
                    </table>
                    <table border="" style="width:100%;" cellspacing="0">
                      
						<tr>
                            <td>AMOUNT 
                               <!-- <span class="hide_print">( RATE OF Rs. <?php echo $decoded_data['rate'];?>/-)</span>-->
                            </td>
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['total_stb_costing'];?></td>
                        </tr>
						 <tr>
                            <td>AMOUNT OF HD PACK 
                               <!-- <span class="hide_print">( RATE OF Rs. <?php echo $decoded_data['hdrate'];?>/-)</span>-->
                            </td>
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['total_hdstb_costing'];?></td>
                        </tr>
						
						
						
						
						
                        <?php /* <tr>
                            <td>ADD S.TAX @</td>
                            <td>%</td>
                            <td><?php echo $decoded_data['stax'];?></td>
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['total_service_tax'];?></td>
                        </tr>
                        <tr>
                            <td>ADD AMUSEMENT TAX</td>
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['amusement_tax'];?></td>
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['amusement_tax_total'];?></td>
                        </tr> */ ?>
                        <tr>
                            <td>ADD OUTSTANDING</td>
                         
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['previous_due'];?></td>
                        </tr>
                        <tr>
                            <td>TOTAL AMOUNT</td>
                           
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['total_amount'];?></td>
                        </tr>
                        <tr>
                            <td>ROUND OFF</td>
                            
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['roundoff'];?></td>
                        </tr>
                        <tr>
                            <td>AMOUNT PAYABLE </td>
                            
                            <td>Rs.</td>
                            <td><?php echo $decoded_data['amount_payable'];?></td>
                        </tr>
                    </table>
                    <table class="calculation" style="width:100%;border-top: none">

                        <tbody>
                            <tr>
                                <td style="border:none; text-align: right">Rs. <?php echo $decoded_data['num_to_word'];?> &nbsp; &nbsp; </td>
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
                <?php /* <input type="submit" name="submit" style="position: fixed; bottom: 10px; right: 10px;" value="save" class="hide_print"/> */?>

            </form>
            <?php /**/?><button onclick="window.print();" style="position: fixed; bottom: 10px; right: 100px;" class="hide_print">Print</button> 

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
							$('#hda').val(ui.item.NO_OF_ACTIVE_HDSTBS);
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
				var x = parseFloat($("#hda").val());
                var y = parseFloat($("#hdb").val());
                var z = (x * y);
                $("#c").val(c.toFixed(2));
				 $("#z").val(z.toFixed(2));
                /*var d = parseFloat($("#d").val());
                var e = (c * (d / 100));
                $("#e").val(e.toFixed(2));
                var f = parseFloat($("#f").val());
                var g = (a * f);
                $("#g").val(g.toFixed(2));*/
                var h = parseFloat($("#h").val());
                //var sum = (c + e + g + h);
                var sum = (c + h+z);
                $("#i").val(sum.toFixed(2));
                var extrav = (sum.toFixed(0)) % 10;
                var roundoff = sum.toFixed(0);
                $("#roundoff").val(roundoff+'.00');
                $("#amount_payable").val($('#roundoff').val());

                var words = testSkill(roundoff);


                $("#j").html(words);
                $("#n_to_w").val(words);
            }
            $(document).ready(function () {

                $("input").not('#roundoff').on("keyup", function () {
                    calc();
                });
                $('#roundoff').on("keyup", function () {
                    $("#amount_payable").val($('#roundoff').val());

                    var words = testSkill($('#roundoff').val());

                    $("#j").html(words);
					$("#n_to_w").val(words);
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
