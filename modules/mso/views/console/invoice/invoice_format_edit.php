
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
			#unique_code{
			position: absolute;
			margin-left: -70px;
			font-weight: initial;
			font-size: 16px;
			}
        </style>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

		<?php/**/?><script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: '',
            data: $('form').serialize(),
            success: function () {
              alert('Your data has been Updated successfully.');
            }
          });

        });

      });
    </script>
		
  
	<?php 
	//echo "hello";
	//pr($details);
	//pr($details['invoice_ID']);
	$decode = $details['invoice_meta'];
	//$b = json_decode($decode);
	$decoded_data = json_decode($decode, true);
	//pr($decoded_data);
	//pr($invoice_periods);
	 ?>
        <div class="wrapper">    
            <?php /*<form name="fastbill" action="" method="post"> */?>
			<form>
			<input style="display:none;" type="text" name="invoice_ID" value="<?php echo $details['invoice_ID'];?>"/>
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
                            <input style="font-size:16px;text-align: center" type="text" name="bill_no" value="<?php echo $decoded_data['bill_no'];?>">
                        </h3>
                        <p style="text-align:center;">MOBILE : 9051616767</p>
                    </div>
                </div>
                <div class="breakline1" >
                    <hr/>
                </div>
                <div style="margin-left: 10%; float: left; height: auto; width: 80%;line-height: 25px">
                    <div style="clear: both; margin: 0px auto;"><span>SERVICE TAX REGN. NO.</span><span style="float: right"><b>AAFCB0558ASD002</b></span></div>
                    <div style="clear: both; margin: 0px auto;"><span>AMUSEMENT TAX NO.</span><span style="float: right"><b>APPLIED FOR</b></span></div>                
                </div>
                <div style="margin-left: 10%;margin-top: 30px; float: left; height: auto; width: 80%;">
                    <p style="line-height: 30px;">
                        <b>NAME OF LCO :</b> <input type="text" id="N_O_L" name="name_of_lco" value="<?php echo $decoded_data['name_of_lco'];?>"/> <br/>
                        <b>ADDRESS :</b> <input type="text" id="add" name="address" style="width: 60%;" value="<?php echo $decoded_data['address'];?>"/><br/>
                        <b>CONTACT  PERSON :</b> <input type="text" id="c_p" name="contact_person" value="<?php echo $decoded_data['contact_person'];?>"/><br/>
                        <b>CODE :</b> <input type="text" id="lco_id" name="lco_id" value="<?php echo $decoded_data['lco_id'];?>" style="display: none;"/>
						<?php echo $decoded_data['code'];?>
						<input style="width:40%;display:none"  name="code" type="text" value="<?php echo $decoded_data['code'];?>" id="code" placeholder="PLEASE ENTER THE CODE"/>
                        <span style="float: right;margin-right: 10px"><b>Date :</b> <input name="invoice_date" style="width:75px" type="text" value="<?php //echo $decoded_data['invoice_date'];?><?=$decoded_data['invoice_date']; ?>" id="datepicker"/></span>
                    </p>
                </div>
                <div style="width:80%;min-width: 500px; margin-left:10%; float:left; height:auto;">
                    <table class="calculation" style="width:100%;border-bottom: none">

                        <tr >
                            <td style="border:none">
                                INVOICE FOR THE MONTH
                            </td>
                            <td style="border:none;text-align:right;">
							<select name="inoice_period" >
							<option>--choose--</option>
                                    <? foreach ($invoice_periods as $key => $value) { ?>
                                        <option value="<?= $key ?>" <? if($key==$decoded_data['inoice_period']){ echo "selected"; }?>><?= $value ?>
										</option>  
                                    <? } ?>
                                </select> 
							<?php /*<input type="text" id="" name="inoice_period" value="<?php echo $decoded_data['inoice_period'];?>"/>  */?>    
                            </td>
                        </tr>
                        <tr>
						     
                            <td style="border:none;" class="hide_print">NO. OF ACTIVE STBs: <input style="margin-left:2%;width: 40px" type="text" name="stb" id="a" value="<?php echo $decoded_data['stb'];?>"/>PCs</td>
                        </tr>
						
						
						<tr>
                            <td style="border:none;" class="hide_print">NO. OF ACTIVE HDSTBs: <input style="margin-left:2%;width: 40px" type="text" name="hdstb" id="hda" value="<?php echo $decoded_data['hdstb'];?>"/>PCs</td>
                        </tr>
						
                    </table>
                    <table border="" style="width:100%;" cellspacing="0">
                        <tr>
                            <td>RATE</td>
                            <td>Rs.</td>
                            <td><input type="text" name="rate" value="<?php echo $decoded_data['rate'];?>" id="b"/></td>
                            <td>Rs.</td>
                            <td><input type="text" name="total_stb_costing" value="<?php echo $decoded_data['total_stb_costing'];?>" id="c"/></td>
                        </tr>
						
						 <tr>
                            <td>RATE</td>
                            <td>Rs.</td>
                            <td><input type="text" name="hdrate" value="<?php echo $decoded_data['hdrate'];?>" id="hdb"/></td>
                            <td>Rs.</td>
                            <td><input type="text" name="total_hdstb_costing" value="<?php echo $decoded_data['total_hdstb_costing'];?>" id="z"/></td>
                        </tr>
						
                        <?php /*<tr>
                            <td>ADD S.TAX @</td>
                            <td>%</td>
                            <td><input type="text" name="stax" value="<?php echo $decoded_data['stax'];?>" id="d"/></td>
                            <td>Rs.</td>
                            <td><input type="text" name="total_service_tax" value="<?php echo $decoded_data['total_service_tax'];?>" id="e"/></td>
                        </tr>
                        <tr>
                            <td>ADD AMUSEMENT TAX</td>
                            <td>Rs.</td>
                            <td><input type="text" name="amusement_tax" value="<?php echo $decoded_data['amusement_tax'];?>" id="f"/></td>
                            <td>Rs.</td>
                            <td><input type="text" name="amusement_tax_total" value="<?php echo $decoded_data['amusement_tax_total'];?>" id="g"/></td>
                        </tr> */ ?>
                        <tr>
                            <td>ADD OUTSTANDING</td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="previous_due" value="<?php echo $decoded_data['previous_due'];?>" id="h"/></td>
                        </tr>
                        <tr>
                            <td>TOTAL AMOUNT</td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="total_amount" value="<?php echo $decoded_data['total_amount'];?>" id="i"/></td>
                        </tr>
                        <tr>
                            <td>ROUND OFF</td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="roundoff" value="<?php echo $decoded_data['roundoff'];?>" id="roundoff"/></td>
                        </tr>
                        <tr>
                            <td>AMOUNT PAYABLE </td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="amount_payable" value="<?php echo $decoded_data['amount_payable'];?>" id="amount_payable"/></td>
                        </tr>
                    </table>
                    <table class="calculation" style="width:100%;border-top: none">

                        <tbody>
                            <tr>
                                <td style="border:none; text-align: right">Rs. <span id="j"></span>. (Inclusive of all taxes.). &nbsp; &nbsp; <input type="text" id="n_to_w" name="num_to_word" style="display:none ;"/></td>
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
                <input type="submit" name="submit" style="position: fixed; bottom: 10px; right: 10px;" value="Save Changes" class="hide_print"/>

            </form>
            <?php /*<button onclick="window.print();" style="position: fixed; bottom: 10px; right: 100px;" class="hide_print">Print</button> */?>

        </div>
        <script>
                // Convert numbers to words
                // copyright 25th July 2006, by Stephen Chapman http://javascript.about.com
                // permission to use this Javascript on your web page is granted
                // provided that all of the code (including this copyright notice) is
                // used exactly as shown (you can change the numbering system if you wish)

                // American Numbering System
                //var th = ['', 'thousand', 'million', 'billion', 'trillion'];
                // uncomment this line for English Number System
                // var th = ['','thousand','million', 'milliard','billion'];
				var th = ['hundred','thousand','lakh', 'milliard','billion'];
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
		
		<script>
        
        var iWords = ['Zero', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine'];
var ePlace = ['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
var tensPlace = ['', ' Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety'];
var inWords = [];
 
var numReversed, inWords, actnumber, i, j;
 
function tensComplication() {
    'use strict';
    if (actnumber[i] === 0) {
        inWords[j] = '';
    } else if (actnumber[i] === 1) {
        inWords[j] = ePlace[actnumber[i - 1]];
    } else {
        inWords[j] = tensPlace[actnumber[i]];
    }
}
 
function testSkill(junkVal) {
    'use strict';
    junkVal = Math.floor(junkVal);
    var obStr = junkVal.toString();
    numReversed = obStr.split('');
    actnumber = numReversed.reverse();
 
    if (Number(junkVal) >= 0) {
        //do nothing
    } else {
        window.alert('wrong Number cannot be converted');
        return false;
    }
    if (Number(junkVal) === 0) {
        document.getElementById('container').innerHTML = obStr + '' + 'Rupees Zero Only';
        return false;
    }
    if (actnumber.length > 9) {
        window.alert('Oops!!!! the Number is too big to covertes');
        return false;
    }
 
 
 
    var iWordsLength = numReversed.length;
    var finalWord = '';
    j = 0;
    for (i = 0; i < iWordsLength; i++) {
        switch (i) {
            case 0:
                if (actnumber[i] === '0' || actnumber[i + 1] === '1') {
                    inWords[j] = '';
                } else {
                    inWords[j] = iWords[actnumber[i]];
                }
                inWords[j] = inWords[j] + ' Only';
                break;
            case 1:
                tensComplication();
                break;
            case 2:
                if (actnumber[i] === '0') {
                    inWords[j] = '';
                } else if (actnumber[i - 1] !== '0' && actnumber[i - 2] !== '0') {
                    inWords[j] = iWords[actnumber[i]] + ' Hundred and';
                } else {
                    inWords[j] = iWords[actnumber[i]] + ' Hundred';
                }
                break;
            case 3:
                if (actnumber[i] === '0' || actnumber[i + 1] === '1') {
                    inWords[j] = '';
                } else {
                    inWords[j] = iWords[actnumber[i]];
                }
                if (actnumber[i + 1] !== '0' || actnumber[i] > '0') {
                    inWords[j] = inWords[j] + ' Thousand';
                }
                break;
            case 4:
                tensComplication();
                break;
            case 5:
                if (actnumber[i] === '0' || actnumber[i + 1] === '1') {
                    inWords[j] = '';
                } else {
                    inWords[j] = iWords[actnumber[i]];
                }
                if (actnumber[i + 1] !== '0' || actnumber[i] > '0') {
                    inWords[j] = inWords[j] + ' Lakh';
                }
                break;
            case 6:
                tensComplication();
                break;
            case 7:
                if (actnumber[i] === '0' || actnumber[i + 1] === '1') {
                    inWords[j] = '';
                } else {
                    inWords[j] = iWords[actnumber[i]];
                }
                inWords[j] = inWords[j] + ' Crore';
                break;
            case 8:
                tensComplication();
                break;
            default:
                break;
        }
        j++;
    }
 
 
    inWords.reverse();
    for (i = 0; i < inWords.length; i++) {
        finalWord += inWords[i];
    }
   return finalWord.toUpperCase();
}
    </script>
		

        <?/*<script>
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
        </script>*/?>

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
                var sum = (c + h+z);
                $("#i").val(sum.toFixed(2));
                var extrav = (sum.toFixed(0)) % 10;
                var roundoff = sum.toFixed(0);
                $("#roundoff").val(roundoff);
                $("#amount_payable").val($('#roundoff').val());

                var words = testSkill(roundoff);

                $("#j").html(words);
                $("#n_to_w").val(words);
            }
            $(document).ready(function () {
				calc();
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
                $("#datepicker").datepicker("setDate", "<?= $decoded_data['invoice_date']; ?>");

            });
        </script>

