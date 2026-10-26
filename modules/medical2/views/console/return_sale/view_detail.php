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
    <caption><h2>Entry No:<?= $data[0]['return_sale_entry_number'] ?></h2></caption>
    <tr>

        <th  style="border: none;line-height: 9px;text-align: left;">

            <p style="text-align: left;"><h3>Supplier: <?= $data[0]['customer_name'] ?></h3><br/>Address: <?= $data[0]['customer_address'] ?></p>
        </th>
        <th  style=" border: none;">Invoice No: <?= $data[0]['return_sale_invoice'] ?></th>
        <th  style=" border: none;">GSTIN: <?= $data[0]['customer_gst'] ?></th>
    </tr>
</table>  
<table style=" border: none;">
    <tr>
        <th  style=" border: none; text-align: left;">DATE: <?= $data[0]['return_sale_date'] ?><br/>Contact:<?= $data[0]['customer_contact'] ?></th>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>

<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
        <caption><h2>Sale Return Items</h2></caption>
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
    $totalAmount = 0;
    foreach ($data as $k => $value) {
        if ($value['return_sale_return'] == true) {
            continue;
        }
        $counter++;
        $totalAmount = $totalAmount + $value['return_sale_total'];
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['return_sale_medicine'] ?></td>  
             <td><?= $value['return_sale_HSN'] ?></td>  
                 <td><?= $value['return_sale_Batch'] ?></td>    
            <td><?= $value['return_sale_strip'] ?></td>   
            
            <td><?= $value['return_sale_expire_month'] ?>/<?= $value['return_sale_expire_year'] ?></td>  
            <td><?= (float)$value['return_sale_mrp'] ?></td>  
            <td><?= $value['return_sale_total'] ?></td>    
             </tr>
    <?php } ?>
    <tr><td colspan="7">Total Amount</td><td><?= $totalAmount ?></td></tr>
</tbody>
</table>

<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>
