<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="5%" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="30%" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b>< Area ></td>
        <td width="30%" style="text-align:center; font-weight:bold;"><b>Address</b></td>
        <td width="20%" style="text-align:center; font-weight:bold;"><b>Area</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Due</b></td>
    </tr>
    <?
    $counter = 1;

    $total_subtotal = 0;
    $total_tax = 0;
    $collectedBy = null;

    if (!empty($customer_data))
        foreach ($customer_data as $key => $value):
            ?>
            <tr style="cursor:pointer;<? if ((int) $value['due'] <= 0) {
            echo 'background:green';
        } ?>" class="quick_collect" customer_id="<?=$value['customer_ID']?>">
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;">

        <?= $value['customer_name'] ?> (<?= $value['customer_code'] ?>)<br/><?= $value['customer_area'] ?>
                </td>
                <td style="text-align:center;"><?= strip_tags($value['customer_address']) ?></td>
                <td style="text-align:center;"><?= strip_tags($value['customer_area']) ?></td>
                <td style="text-align:center;"><?php $total_subtotal += $value['due'];
        echo $value['due']; ?></td>
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="4">Total</td>

        <td ><?= round($total_subtotal, 2) ?></td>

    </tr>
</table>
<script>
    function quick_collect(){
         $.post('/console/customer/billing',$('#quick_collect_form').serializeArray(),function(resp){
             alert('Collection successfull!!');
            $('#report_sub').click();
            $("#quickcollectionModal").modal('hide');
  

         });
        
    }
    $(document).ready(function () {


        $(".quick_collect").click(function () {
            $("#quickcollectionModal").find("[name='collection_customer']").val($(this).attr('customer_id'));
           $.post('/console/customer/get_collection_for',{customer_id:$(this).attr('customer_id')},function(resp){
               $("#quickcollectionModal").find("datalist#invoices").html(resp);
           });
            $("#quickcollectionModal").modal('show');
        });

    });
</script>