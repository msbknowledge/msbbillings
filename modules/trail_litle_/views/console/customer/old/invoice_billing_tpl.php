<? $totalCount = 0;?>
<style>
    @media print{
        .breadcrumb,.main-menu-span,.main-menu-span * ,.box-header,.box-header *{display: none}
    }
    
</style>
<div class="" style="page-break-after:always">
    <div class="span12" style="">
        
        <div class="box-content">


            <div class="span9" style="width:100%">
                <table class="table table-condensed">
                    <tr>
                        <td style="border-top: none;">
                            <img src="<?=@ base_url('uploads/' . NODE . '/' . get_option('site_logo')) ?>" style="max-height: 200px;width: 200px">        
                        </td>

                        <td style="border-top: none;text-align: right">
                            <h3><?=@get_option('invoice_title');?></h3>                       
                            <h3>
                                <small>
                                    Invoice No:<?=$customerData['invoiceNo'];?><br> 
                                    <span class="spd">Invoice Date:<?=@$customerData['invoice_date']?></span> <br>
                                    Invoice Period : <?=$customerData['customer_invoice_for_month'].' ('.@$customerData['customer_service_start_date']?> to &nbsp;<?=  $customerData['customer_service_end_date'].')'?><br>
                                    Due Date :<?=$customerData['customer_due_date']?>                        
                                </small>
                            </h3>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            VC No:<?=@$customerData['stb_no']?><br>
                            STB No:<?=@$customerData['vc_no']?><br>
                            Customer Code :<?=@$customerData['customer_code']?><br><br>
                            <?=@$customerData['customer_name']?><br>
                            <?=@$customerData['customer_address']?><br>
                        </td>
                        <td style="text-align: right">
                            <?=@get_option('invoice_company_details');?>
                                                     
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered" style=" border-collapse: separate !important;">

                    <thead>
                        <tr style="background: #d9edf7;border-color:#bce8f1;color: #31708f ">
                            <th class="text-center" colspan="2">
                    <h4>Bouquet</h4>
                    </th>
                    <th class="text-center">
                    <h4>Amount(Rs)</h4>
                    </th>           
                    </tr>
                    </thead>


                    <tbody>
                        <? foreach ($customerData['packages'] as  $package):?>
                        <tr>
                            <td class="text-center" colspan="2"><?=@$package['package_name']?></td>
                            <td class="text-center"><?=@$package['package_rate']?></td>
                            <?$totalCount+=floatval($package['package_rate'])?>
                        </tr>
                        <? endforeach;?>
                      <? foreach ($customerData['adons'] as  $adon):?>
                        <tr>
                            <td class="text-center" colspan="2">Ad-on Channel: <?=@$adon['channel_name']?></td>
                            <td class="text-center"><?=@$adon['channel_price']?></td>
                        <? $totalCount+=floatval($adon['channel_price']);?>
                        </tr>
                        <? endforeach;?>
                     

                    </tbody>
                </table>


                <div class="span11">
                    
                    <p style="float: right;text-align: right">
                        <strong>
                            Sub Total @ <span>Rs: <?=@$totalCount;?>/-</span><br>
                            Service Tax @ (<?=@get_option('invoice_service_tax');?>%):
                                <span>Rs: <?=@number_format((float)($totalCount *  floatval(get_option('invoice_service_tax'))/100), 2, '.', '')?>/-</span><br>
                                <? $totalCount+= number_format((float)($totalCount *  floatval(get_option('invoice_service_tax'))/100), 2, '.', '')?>
                           
                            Amusement Tax per STB :
                            <span>Rs: <?=@ number_format(floatval(get_option('invoice_service_amusement_tax')), 2, '.', '')?>/-</span><br>                            
                                  <? $totalCount+= number_format(floatval(get_option('invoice_service_amusement_tax')), 2, '.', '')?>
                                
                            <span>Previous Due :</span>
                            <span>Rs: <?=@number_format(floatval($customerData['invoice_previous_due_amount']),2,'.','')?>/-</span><br>                            
                                  <? $totalCount+= number_format(floatval($customerData['invoice_previous_due_amount']), 2, '.', '')?>
                                
                        </strong>
                    </p>
                    <h3 style="clear: both;float: right">    Total @<span>Rs: <?=$totalCount?>/-</span><br></h3>
                    <h2 style="clear: both;float: right">    Total(Round off)@<span>Rs: <?=  floor($totalCount)?>/-</span><br></h2>
                    <h1 style="clear: both;float: right">    Paid @<span>Rs: <?=number_format(floatval($customerData['invoice_paid_amount']),2,'.','')?>/-</span><br></h1>
                    <h3 style="clear: both;float: right">    Due @<span>Rs: <?=number_format(floatval($customerData['invoice_due_amount']),2,'.','')?>/-</span><br></h3>

                </div>

            </div>
        </div>
    </div>
</div>
