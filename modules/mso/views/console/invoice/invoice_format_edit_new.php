
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
            .textRight input{text-align: right;}
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
	$decode = $details['invoice_meta'];
	$decoded_data = json_decode($decode, true);
	 ?>
        <div class="wrapper">    
            <?php /*<form name="fastbill" action="" method="post"> */?>
			<form>
			<input style="display:none;" type="text" name="invoice_ID" value="<?php echo $details['invoice_ID'];?>"/>
                <div class="header">
                    <div style="width:40%; height:auto; margin-top:3%; float:left; margin-left:10%">
                        <img class="logo" src="<?php echo base_url('modules/bbbc/views/console/extras/LOGO.PNG'); ?>"/>
                        <p>
                            <b style="font-size: 17px">BENGAL BROADBAND & CABLE TV SERVICES PVT. LTD.</b><br/>
                            <b>CIN: U22130WB2010PTC152374 </b>

                        <p style="text-align:left;">
                            891,JESSORE ROAD. KOLKATA-700055
                        </p>
                        <b>MOBILE :</b><span>9073980554</span><br/>
                        </p>
                    </div>
                    <div style="width:50%; height:auto; float:left; margin-top:3%;">
                        <h3 style="text-align:center;"><a style="background: lightgray;"> INVOICE </a></br>
                            <!--input style="font-size:16px;text-align: center" type="text" name="bill_no" value="BB/<?= date('m') ?>/<?= date('y') ?>/00"-->
                            <input style="font-size:16px;text-align: center" type="text" name="bill_no" value="<?php echo $decoded_data['bill_no'];?>">
                        </h3>
                        <!--p style="text-align:center;">MOBILE : 9073980554</p-->
                        <p style="text-align:center;">Date :</b> <input name="invoice_date" style="width:75px" type="text" value="<?php //echo $decoded_data['invoice_date'];?><?=$decoded_data['invoice_date']; ?>" id="datepicker"/></p>
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
                        <!--span style="float: right;margin-right: 10px"><b>Date :</b> <input name="invoice_date" style="width:75px" type="text" value="<?php //echo $decoded_data['invoice_date'];?><?=$decoded_data['invoice_date']; ?>" id="datepicker"/></span-->
                         <span id="GSTINX" style="float: right;margin-right: 10px" ><b>LCO GSTIN : </b><input type="text" id="GSTIN" name="GSTIN" value="<?php echo $decoded_data['GSTIN']; ?>" style=""/></span><br/>
                    </p>
                </div>
                <div style="width:80%;min-width: 500px; margin-left:10%; float:left; height:auto;">
                    <table class="calculation" style="width:100%;border-bottom: none">

                        <tr >
                            <td style="">
                                INVOICE FOR THE MONTH
                            </td>
                            <td style=";text-align:right;">
							<select name="inoice_period" >
							<option>--choose--</option>
                                    <? foreach ($invoice_periods as $key => $value) { ?>
                                        <option value="<?= $key ?>" <? if($key==$decoded_data['inoice_period']){ echo "selected"; }?>><?= $value ?>
										</option>  
                                    <? } ?>
                                </select> 
							<?php/*<input type="text" id="" name="inoice_period" value="<?php echo $decoded_data['inoice_period'];?>"/>  */?>    
                            </td>
                        </tr>
                        <tr>
						     
                            <td style=";" class="hide_print">NO. OF ACTIVE SD PACK: <input style="margin-left:2%;width: 40px" type="text" name="stb" id="stb" value="<?php echo $decoded_data['stb'];?>"/>PCs</td>
                        </tr>
						
						
						<tr>
                            <td style=";" class="hide_print">NO. OF ACTIVE HD PACK: <input style="margin-left:2%;width: 40px" type="text" name="hdstb" id="hdstb" value="<?php echo $decoded_data['hdstb'];?>"/>PCs</td>
                        </tr>
						
                    </table>
                    <table border="" style="width:100%;" cellspacing="0">
                        <tr class="alternet">
                            <td>AMOUNT FOR SD PACK
                                <span class="hide_print">( RATE OF Rs. <input style="width: 60px;" type="text" name="rate" value="<?php echo $decoded_data['rate'];?>" id="ratestb"/>/-)</span>
                            </td>
							                   <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="stbtotal" value="<?php echo $decoded_data['stbtotal'];?>" id="stbtotal"/></td>
                        </tr>
                        <tr>
                            <td>AMOUNT FOR HD PACK
                                <span class="hide_print">( RATE OF Rs. <input style="width: 60px;" type="text" name="hdrate" value="<?php echo $decoded_data['hdrate'];?>" id="hdrate"/>/-)</span>
                            </td>
							                   <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="total_hdstb_costing" value="<?php echo $decoded_data['total_hdstb_costing'];?>" id="hdstbtotal"/></td>
                        </tr>
                         <tr class="alternet">
                            <td>SGST @(9%)</td>
                   <td></td>
                            <td></td>                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="sgst" value="<?php echo $decoded_data['sgst'];?>" id="sgst"/></td>
                        </tr>
                        <tr>
                            <td>CGST @(9%)</td>
                   <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="cgst" value="<?php echo $decoded_data['cgst'];?>" id="cgst"/></td>
                        </tr>
                        <!--tr class="alternet">
                            <td>KRISHI KALYAN CESS@(0.5%)</td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="kktax" value="<?php echo $decoded_data['kktax'];?>" id="kktax"/></td>
                        </tr>
                        <tr>
                            <td>AMUSEMENT TAX@(Rs.10/- PER STB)</td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="amusement_tax" value="<?php echo $decoded_data['amusement_tax'];?>" id="atax"/></td>
                        </tr-->
                        <tr>
                            <td>TOTAL AMOUNT</td>
							<td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td class="textRight"><input type="text" name="total_amount" value="<?php echo $decoded_data['total_amount'];?>" id="total_amount"/></td>
                        </tr>
                        
                        
                     	
                       
                        <tr>
                            <td>ADD OUTSTANDING</td>
                            <td></td>
                            <td></td>
                            <td>Rs.</td>
                            <td><input type="text" name="previous_due" value="<?php echo $decoded_data['previous_due'];?>" id="previous_due"/></td>
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
                                <td style="; text-align: right">Rs. <span id="j"></span>. (Inclusive of all taxes.). &nbsp; &nbsp; <input type="text" id="n_to_w" name="num_to_word" style="display:none ;"/></td>
                            </tr>
                            <tr>
                                <td style="; text-align: right">E & OE.&nbsp; &nbsp;</td>
                            </tr>
                             <tr>
                                <td style="; text-align: left;font-weight: bold;font-size: 11px">**Rs 10/- PER STB DISCOUNT IF PAYMENT WITHIN 25TH DAY FROM THE DATE OF INVOICE</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div style="height: auto; float: right;margin-top: 20%; margin-right: 10%;">
                    <hr/>
                    <p style="text-align:center;height: 20px;">FOR BENGAL BROADBAND & CABLE TV SERVICES PVT. LTD.</p>
                </div>
                <input type="submit" name="submit" style="position: fixed; bottom: 10px; right: 10px;" value="save" class="hide_print"/>

            </form>
            <?php /*<button onclick="window.print();" style="position: fixed; bottom: 10px; right: 100px;" class="hide_print">Print</button> */?>

        </div>
        
		
		
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
                // Convert numbers to words
                // copyright 25th July 2006, by Stephen Chapman http://javascript.about.com
                // permission to use this Javascript on your web page is granted
                // provided that all of the code (including this copyright notice) is
                // used exactly as shown (you can change the numbering system if you wish)

                // American Numbering System
                //var th = ['hundred','thousand','lakh', 'billion','trillion'];
                // uncomment this line for English Number System
                var th = ['hundred', 'thousand', 'lakh', 'milliard', 'billion'];

                var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
                var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
                var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
                function number2text(value) {
                    var fraction = Math.round(frac(value) * 100);
                    var f_text = "";

                    if (fraction > 0) {
                        f_text = "AND " + convert_number(fraction) + " PAISE";
                    }

                    return convert_number(value) + " RUPEE " + f_text + " ONLY";
                }

                function frac(f) {
                    return f % 1;
                }

                function convert_number(number)
                {
                    if ((number < 0) || (number > 999999999))
                    {
                        return "NUMBER OUT OF RANGE!";
                    }
                    var Gn = Math.floor(number / 10000000);  /* Crore */
                    number -= Gn * 10000000;
                    var kn = Math.floor(number / 100000);     /* lakhs */
                    number -= kn * 100000;
                    var Hn = Math.floor(number / 1000);      /* thousand */
                    number -= Hn * 1000;
                    var Dn = Math.floor(number / 100);       /* Tens (deca) */
                    number = number % 100;               /* Ones */
                    var tn = Math.floor(number / 10);
                    var one = Math.floor(number % 10);
                    var res = "";

                    if (Gn > 0)
                    {
                        res += (convert_number(Gn) + " CRORE");
                    }
                    if (kn > 0)
                    {
                        res += (((res == "") ? "" : " ") +
                                convert_number(kn) + " LAKH");
                    }
                    if (Hn > 0)
                    {
                        res += (((res == "") ? "" : " ") +
                                convert_number(Hn) + " THOUSAND");
                    }

                    if (Dn)
                    {
                        res += (((res == "") ? "" : " ") +
                                convert_number(Dn) + " HUNDRED");
                    }


                    var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN");
                    var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY");

                    if (tn > 0 || one > 0)
                    {
                        if (!(res == ""))
                        {
                            res += " AND ";
                        }
                        if (tn < 2)
                        {
                            res += ones[tn * 10 + one];
                        } else
                        {

                            res += tens[tn];
                            if (one > 0)
                            {
                                res += ("-" + ones[one]);
                            }
                        }
                    }

                    if (res == "")
                    {
                        res = "zero";
                    }
                    return res;
                }
        </script>
        <script>
       function calc() {
                var stb = parseFloat($("#stb").val());
                var ratestb = parseFloat($("#ratestb").val());
                var stbtotal = (stb * ratestb);
                var hdstb = parseFloat($("#hdstb").val());
                var hdrate = parseFloat($("#hdrate").val());
                var hdstbtotal = (hdstb * hdrate);

                $("#stbtotal").val(stbtotal.toFixed(2));
                $("#hdstbtotal").val(hdstbtotal.toFixed(2));
                /*var d = parseFloat($("#d").val());
                 var e = (c * (d / 100));
                 $("#e").val(e.toFixed(2));
                 var f = parseFloat($("#f").val());
                 var g = (a * f);
                 $("#g").val(g.toFixed(2));*/

                var previous_due = parseFloat($("#previous_due").val());
                // var servicetax = 14;
                //var swachbharat = 0.5;
                //var krishikalyan = 0.5;

                //			
                //var sum = (c + e + g + h);
                var sum = (stbtotal + hdstbtotal);
                $('#sgst').val((sum * 9.00 / 100).toFixed(2));
                $('#cgst').val((sum * 9.00 / 100).toFixed(2));
               /* $('#kktax').val((sum * 0.50 / 100).toFixed(2));
                $('#atax').val((stb * 10).toFixed(2));*/


                var total_amount = parseFloat($('#sgst').val())+ 
                        parseFloat($('#cgst').val()) +sum;
                       /* parseFloat($('#kktax').val()) +
                        parseFloat($('#atax').val()) */
                       
                $("#total_amount").val(total_amount.toFixed(2));
                // var extrav = (total_amount.toFixed(0)) % 10;
                var roundoff = Math.round(parseFloat($("#total_amount").val())+previous_due);
                $("#roundoff").val(roundoff + '.00');
                $("#amount_payable").val($('#roundoff').val());

                var words = number2text(roundoff);


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

