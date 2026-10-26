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
                                    Invoice No:<?=$studentData['invoiceNo'];?><br> 
                                    <span class="spd">Invoice Date:<?=@$studentData['invoice_date']?></span> <br>
                                    Invoice Period : <?=$studentData['student_invoice_for_month'].' ('.@$studentData['student_service_start_date']?> to &nbsp;<?=  $studentData['student_service_end_date'].')'?><br>
                                    Due Date :<?=$studentData['student_due_date']?>                        
                                </small>
                            </h3>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            VC No:<?=@$studentData['stb_no']?><br>
                            STB No:<?=@$studentData['vc_no']?><br>
                            student Code :<?=@$studentData['student_code']?><br><br>
                            <?=@$studentData['student_name']?><br>
                            <?=@$studentData['student_address']?><br>
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
                        <? foreach ($studentData['packages'] as  $package):?>
                        <tr>
                            <td class="text-center" colspan="2"><?=@$package['package_name']?></td>
                            <td class="text-center"><?=@$package['package_rate']?></td>
                            <?$totalCount+=floatval($package['package_rate'])?>
                        </tr>
                        <? endforeach;?>
                      <? foreach ($studentData['adons'] as  $adon):?>
                        <tr>
                            <td class="text-center" colspan="2">Ad-on course: <?=@$adon['course_name']?></td>
                            <td class="text-center"><?=@$adon['course_price']?></td>
                        <? $totalCount+=floatval($adon['course_price']);?>
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
                            <span>Rs: <?=@number_format(floatval($studentData['invoice_previous_due_amount']),2,'.','')?>/-</span><br>                            
                                  <? $totalCount+= number_format(floatval($studentData['invoice_previous_due_amount']), 2, '.', '')?>
                                
                        </strong>
                    </p>
                    <h3 style="clear: both;float: right">    Total @<span>Rs: <?=$totalCount?>/-</span><br></h3>
                    <h2 style="clear: both;float: right">    Total(Round off)@<span>Rs: <?=  floor($totalCount)?>/-</span><br></h2>
                    <h1 style="clear: both;float: right">    Paid @<span>Rs: <?=number_format(floatval($studentData['invoice_paid_amount']),2,'.','')?>/-</span><br></h1>
                    <h3 style="clear: both;float: right">    Due @<span>Rs: <?=number_format(floatval($studentData['invoice_due_amount']),2,'.','')?>/-</span><br></h3>

                </div>

            </div>
        </div>
    </div>
</div>
