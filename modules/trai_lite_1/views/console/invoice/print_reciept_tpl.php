<style>
 div.receipt_provider_details h2 {
    font-weight: bold;
 }
</style>
<title><?=strtoupper($lcoData['lco_name']); ?>-<?=$lcoData['lco_code']; ?></title>
<div class="main"><?php #pr($lcoData) ?>
    <div style="border: 1px solid black;height: 1106px;">
       <?=str_ireplace('BILL CUM RECEIPT','TAX / INVOICE',get_option('receipt_provider_details'))?>
        <table class="address">
            <tr class="heading">
                <td width="50%" style="color:black; text-align:center; font-weight:bold;"><b>Lco Details</b></td>
                <td width="50%" style="color:black; text-align:center; font-weight:bold;"><b>Bill Details</b></td>
            </tr>
            <tr>
                <td style="border-right: 1px solid;"><b style="color: black; text-align: center; font-weight: bold; ">Lco A/c No. :</b><?= $lcoData['lco_code']; ?></td>
                <td><b style="font-weight:bold;">Bill No. :</b><?= $lcoData['invoiceNo']; ?></td>
            </tr> 
            <tr style="line-height: 18px;">
                <!--td style="border-right: 1px solid;"><b style="font-weight:bold;">STB Serial No. :</b><?= $lcoData['stb_no']; ?><br/>
                    <b style="font-weight:bold;">VC Card No. :</b><?= $lcoData['vc_no']; ?>
                </td-->
                <td><b style="font-weight:bold;">Bill Date :</b><?= $lcoData['invoice_date']; ?></td>
            </tr>
            <tr>
                <td style="border: 1px solid;FONT-WEIGHT: BOLD;FONT-SIZE: 14PX"><b style="">Name : </b><?=strtoupper($lcoData['lco_name']); ?></td>
                <td style="border: 1px solid;"><b style="font-weight:bold;">Billed Amount :</b><?= $lcoData['total_with_previous_due'] ?><br/>

                </td>
            </tr> 
            <tr><?php $address_seg=explode(' ',$lcoData['lco_address']);
            #pr($address_seg);
            $add_one=$address_seg[0];
            $add_two=explode(' ',$address_seg[1]);
            
            
            ?>
                <!--td style="border: 1px solid;"><b style="font-weight:bold;">Address:  </b><?=strtoupper($address_seg[0].' '.$address_seg[1].' '.$address_seg[2].','.'KOLKATA'); ?></td-->
                
            </tr> 
        </table>
        <!--<table>
            <tr>
                <td style=""><b style="font-weight:bold;">Address :</b><?=strtoupper($lcoData['lco_address']); ?></td>
            </tr>
        </table>
        <table class="address">
            <tr>
                <td width="50%" style="border-right: 1px solid;"><b style="font-weight:bold;">Contact No. :</b><?= $lcoData['lco_contact']; ?></td>
                <td width="50%"><b></b></td>
            </tr>
        </table>-->
        <table class="address">
            <tr align="center" style="text-align:center;">
                <td width="100%" style="font-weight:bold;">
                    SUMMARY OF CHARGES FOR THIS BILL PERIOD
                </td>
            </tr>
        </table>
        <table class="calculation" style="width:100%;">
            <tr class="heading" >
                <td width="25%"  style="border-left: none;text-align:center; font-weight:bold;"><b>Package / A La Carte</b></td>
                <td width="25%" style="text-align:center; font-weight:bold;"><b>For the month of</b></td>
                <td width="25%" style="text-align:center; font-weight:bold;"><b>Rate</b></td>
                <td width="25%" style="text-align:center; font-weight:bold;"><b>Amount</b></td>
            </tr>

            <? foreach ($lcoData['packages'] as $package): ?>
                <tr>
                    <!--<td style="text-align:center;border-left: none;"><?= @strtoupper($package['package_name']) ?></td>-->
                    <td style="text-align:center;border-left: none;">Subscription Fee</td>
                    <td style="text-align:center;" ><?= @$lcoData['lco_invoice_for_month'] ?></td>
                    <td style="text-align:center;"><?= @$package['package_rate'] ?></td>
                    <td style="text-align:center;"><?= @$package['package_rate'] ?></td>
                </tr>
            <? endforeach; ?>
            <? foreach ($lcoData['adons'] as $adon): ?>
                <tr>
                    <td style="text-align:center;border-left: none;" >Adons: <?= @strtoupper($adon['channel_name']) ?></td>
                    <td style="text-align:center;" ><?= @$lcoData['lco_invoice_for_month'] ?></td>
                    <td style="text-align:center;" ><?= @$adon['channel_price'] ?></td>
                    <td style="text-align:center;" ><?= @$adon['channel_price'] ?></td>
                </tr>
            <? endforeach; ?>

            <tr>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;">Sub Total:</td>
                <td style="text-align:center;"><?= $lcoData['subtotal'] ?></td>
            </tr>
            <? if (isset($lcoData['discount'])): ?>
                <tr>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;">Discount:</td>
                    <td style="text-align:center;"><?= $lcoData['discount'] ?></td>
                </tr>            
            <? endif; ?>
                 <? foreach ($lcoData['tax'] as $key=>$txvalue) { 
			 
			 ?>
              <tr>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;"><?=$key.'('.$taxes[$key]?><?php if($taxes['type']==0 && !empty($taxes[$key]) ){echo '%'.')';}else{echo ')';} ?></td>
                <td style="text-align:center;"><?=$txvalue;?></td>
            </tr>   
           <? }?>
           
            <tr>
                <td style="text-align:center; border:none;"></td>
                <td style="text-align:center; border:none;"></td>
                <td style="text-align:center;">Previous Due:</td>
                <td style="text-align:center;"><?= number_format((floatval($lcoData['invoice_previous_due_amount']))) ?></td>
            </tr>
            <tr>
                <td style="text-align:center; border:none;"></td>
                <td style="text-align:center; border:none;"></td>
                <td style="text-align:center;">Previous Advance:</td>
                <td style="text-align:center;"><?= number_format((floatval($lcoData['invoice_previous_advance_amount']))) ?></td>
            </tr>
            <tr>  
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;">Total Amount</td>
                <td style="text-align:center;"><?= $lcoData['total'] + $lcoData['invoice_previous_due_amount'] ?></td>
            </tr>
            <tr>  
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border-bottom: none">Round Amount</td>
                <td style="text-align:center;border-bottom: none"><?= $lcoData['total_with_previous_due'] ?></td>
            </tr>
            <tr>  
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border:none;"></td>
                <td style="text-align:center;border-bottom: none">Paid Amount</td>
                <td style="text-align:center;border-bottom: none"><?= $lcoData['invoice_paid_amount'] ?></td>
            </tr>
        </table>
        <table class="address">
            <tr align="center" style="text-align:right;">
                <td width="100%">
                    <?= ucwords(convert_number_to_words($lcoData['total_with_previous_due'])); ?> Only
                </td>
            </tr>
        </table>
        <table class="address">
            <tr align="center" style="text-align:right;">
                <td>Paid Amount:</td>
                <td><?= $lcoData['invoice_paid_amount'] ?></td>
            </tr>

        </table>
        <div class="receipt_provider_details" style="line-height: 28px;">
       <?=get_option('receipt_footer')?>
        </div>
    </div>  
		<span style="font-size: 11px;width: 100%;display: block;text-align: center;">CableBillings.com&copy2017 </span>

	</div>
