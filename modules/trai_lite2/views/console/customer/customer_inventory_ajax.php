<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Name<br />(Code)</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Address</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Area</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Bill Date</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Inventory(Qty)</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Billed</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Tax</b></td>

    </tr>

    <?
    $counter = 1;

    $total_subtotal = 0;
    $total_due = 0;

    if (!empty($inventory_data))
        foreach ($inventory_data as $key => $value) :
            $invoice_meta = json_decode($value['invoice_meta'], true);
            // $var += $value['total_invoice'];
            //pr($value, 1);
    ?>
        <tr class="quick_collect" customer_id="<?= $value['customer_ID'] ?>">
            <td style="text-align:center;"><?= $counter++ ?></td>
            <td style="text-align:center;"><?= $value['customer_name'] ?> (<?= $value['customer_code'] ?>)<br /></td>
            <td style="text-align:center;"><?= strip_tags($value['customer_address']) ?></td>
            <td style="text-align:center;"><?= strip_tags($value['customer_area']) ?></td>
            <td style="text-align:center;"><?= $value['invoice_date'] ?></td>
            <td style="text-align:center;"><?php 
            $inventory_meta = array();
             foreach ($invoice_meta['billings']['items'] as $key => $meta) {
                 if($meta['qty'] == ''){
                     $quentity = 0;
                 }else{
                    $quentity = $meta['qty'];
                 }
                array_push($inventory_meta,$meta['name'] .' ('.$quentity.')');
             } 
             echo implode(", ",$inventory_meta);
             ?></td>
            <td style="text-align:center;"><?php $garnd_total_invoice += $value['invoice_billed_amount'];
                                            echo $value['invoice_billed_amount']; ?></td>
            <td style="text-align:center;"><?php $grand_total_tax += $value['invoice_tax_amount'];
                                            echo $value['invoice_tax_amount']; ?></td>

        </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="6">Total</td>

        <td><?= round($garnd_total_invoice, 2) ?></td>
        <td><?= round($grand_total_tax, 2) ?></td>

    </tr>
</table>
<script>
    function quick_collect() {
        $.post('/console/customer/billing', $('#quick_collect_form').serializeArray(), function(resp) {
            alert('Collection successfull!!');
            $('#report_sub').click();
            $("#quickcollectionModal").modal('hide');


        });

    }
    $(document).ready(function() {


        $(".quick_collect").click(function() {
            $("#quickcollectionModal").find("[name='collection_customer']").val($(this).attr('customer_id'));
            $.post('/console/customer/get_collection_for', {
                customer_id: $(this).attr('customer_id')
            }, function(resp) {
                $("#quickcollectionModal").find("datalist#invoices").html(resp);
            });
            $("#quickcollectionModal").modal('show');
        });

    });
</script>