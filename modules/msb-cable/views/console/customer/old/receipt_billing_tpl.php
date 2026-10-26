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
                            <img src="<?= base_url('uploads/' . NODE . '/' . get_option('site_logo')) ?>" style="max-height: 200px;width: 200px">        
                        </td>

                        <td style="border-top: none;text-align: right">
                            <h3><?=get_option('invoice_title');?></h3>                       
                            <h3>
                                <small>
                                    Collection No.:<?=get_option('invoice_prefix');?><?=$collectionData['collection_ID']?><br> 
                                    <span class="spd">Collection Date:<?=$collectionData['collection_date']?></span> <br>
                                    Collection Period : <?=$collectionData['collection_service_start']?> to &nbsp;<?= Date('Y-m-d', strtotime("+30 days",  strtotime($collectionData['collection_service_start'])));?><br>
                                    Due Date :<?=Date('Y-m-d', strtotime("+45 days",  strtotime($collectionData['collection_service_start'])))?>                        
                                </small>
                            </h3>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            VC No:<?=$collectionData['vc_no']?><br>
                            STB No:<?=$collectionData['stb_no']?><br>
                            Customer Code :<?=$collectionData['customer_code']?><br><br>
                            <?=$collectionData['customer_name']?><br>
                            <?=$collectionData['customer_address']?><br>
                        </td>
                        <td style="text-align: right">
                            <?=get_option('invoice_company_details');?>
                                                     
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
                        <? foreach ($collectionData['packages'] as  $package):?>
                        <tr>
                            <td class="text-center" colspan="2"><?=$package['package_name']?></td>
                            <td class="text-center"><?=$package['package_rate']?></td>
                            <?$totalCount+=floatval($package['package_rate'])?>
                        </tr>
                        <? endforeach;?>
                      <? foreach ($collectionData['adons'] as  $adon):?>
                        <tr>
                            <td class="text-center" colspan="2">Ad-on Channel: <?=$adon['channel_name']?></td>
                            <td class="text-center"><?=$adon['channel_price']?></td>
                        <? $totalCount+=floatval($adon['channel_price']);?>
                        </tr>
                        <? endforeach;?>
                     

                    </tbody>
                </table>


                <div class="span11">
                    
                    <p style="float: right;text-align: right">
                        <strong>
                            Sub Total @ <span>Rs: <?=$totalCount;?>/-</span><br>
                            Service Tax @ (<?=get_option('invoice_service_tax');?>%):
                                <span>Rs: <?=number_format((float)($totalCount *  floatval(get_option('invoice_service_tax'))/100), 2, '.', '')?>/-</span><br>
                                <? $totalCount+= number_format((float)($totalCount *  floatval(get_option('invoice_service_tax'))/100), 2, '.', '')?>
                           
                            Amusement Tax per STB :
                            <span>Rs: <?= number_format(floatval(get_option('invoice_service_amusement_tax')), 2, '.', '')?>/-</span><br>                            
                                  <? $totalCount+= number_format(floatval(get_option('invoice_service_amusement_tax')), 2, '.', '')?>
                                
                            <span>Previous Due :</span>
                            <span>Rs: <?=$collectionData['collection_previous_due_amount']?>/-</span><br>                            
                                  <? $totalCount+= number_format(floatval($collectionData['collection_previous_due_amount']), 2, '.', '')?>
                                
                        </strong>
                    </p>
                    <h2 style="clear: both;float: right">    Total @<span>Rs: <?=$totalCount?>/-</span><br></h2>
                    <h1 style="clear: both;float: right">    Paid @<span>Rs: <?=number_format(floatval($collectionData['collection_paid_amount']),2,'.','')?>/-</span><br></h1>
                    <h3 style="clear: both;float: right">    Due @<span>Rs: <?= number_format(floatval($totalCount),2,'.','') - number_format(floatval($collectionData['collection_paid_amount']),2,'.','')?>/-</span><br></h3>

                </div>

            </div>
        </div>
    </div>
</div>
