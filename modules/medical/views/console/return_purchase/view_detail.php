<style>
    table{
        width: 100%;
        text-align: center;

    }

    th{
        border: 1px solid black;
        border-bottom: 1px solid black;
    }

    td{
        border: 1px solid black;
    }

</style>
<table style=" border: none;">
    <caption><h2>Entry No:<?= $data[0]['return_purchase_entry_number'] ?></h2></caption>
    <tr>

        <th  style="border: none;line-height: 9px;text-align: left;">

            <p style="text-align: left;"><h3>Supplier: <?= $data[0]['supplier_name'] ?></h3><br/>Address: <?= $data[0]['supplier_address'] ?></p>
        </th>
        <th  style=" border: none;">GSTIN: <?= $data[0]['supplier_gst'] ?></th>
    </tr>
</table>  
<table style=" border: none;">
    <tr>
        <th  style=" border: none; text-align: left;">DATE: <?= $data[0]['return_purchase_date'] ?><br/>Contact:<?= $data[0]['supplier_contact'] ?></th>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>

<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
        <caption><h2>Purchase Return Items</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
            <th>HSN</th>
            <th>Batch</th>
            <th>Strip</th>
            <th>Exp Date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Total</th>

        </tr>
    </tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    foreach ($data as $k => $value) {
        if ($value['return_purchase_return'] == true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['return_purchase_medicine'] ?></td>  
                <td><?= $value['return_purchase_HSN'] ?></td>  
                 <td><?= $value['return_purchase_Batch'] ?></td>  
            <td><?= $value['return_purchase_strip'] ?></td>   
            
            <td><?= $value['return_purchase_expire_month'] ?>/<?= $value['return_purchase_expire_year'] ?></td>  
            <td><?= (float)$value['return_purchase_mrp'] ?></td>  
            <td><?= (float)$value['return_purchase_mrp']*(float)$value['return_purchase_strip'];
                    $total += (float)$value['return_purchase_mrp']*(float)$value['return_purchase_strip'];
             ?></td>    
             </tr>
    <?php } ?>
</tbody>
</table>
<table style="border: 1px solid black;margin-top: 75px;">

    <tr>
        <th>Items</th>
        <th>Grand Total</th>
        <th>Round Total</th>
    </tr>
    <tr>
        <td class="totalItem"><?= $counter ?></td>
        <td class="totalAmount"><?= $total; ?></td>
        <td class="totalAmount"><?= round($total); ?></td>
    </tr>
</table>

<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>
