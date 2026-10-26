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
    <caption><h2>Invoice No:<?= $data[0]['purchase_invoice'] ?></h2></caption>
    <tr>

        <th  style="border: none;line-height: 9px;text-align: left;">

            <p style="text-align: left;"><h3>Supplier: <?= $data[0]['supplier_name'] ?></h3><br/>Address: <?= $data[0]['supplier_address'] ?></p>
        </th>
        <th  style=" border: none;">GSTIN: <?= $data[0]['supplier_gst'] ?></th>
    </tr>
</table>  
<table style=" border: none;">
    <tr>
        <th  style=" border: none; text-align: left;">DATE: <?= $data[0]['purchase_date'] ?><br/>Contact:<?= $data[0]['supplier_contact'] ?></th>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>

<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
    <caption><h2>Purchased Items</h2></caption>
    <tr>
        <th>Sr</th>
        <th>Product Name</th>
        <th>HSN</th>
        <th>Manufacturer</th>
        <th>Qty</th>
        <th>Free Qty</th>
        <th>Unit</th>
        <th>Batch</th>
        <th>Exp date<br/>(MM/YY)</th>
        <th>MRP</th>
        <th>Rate</th>
        <th>Disc<br/>%</th>
        <th>Taxable</th>
        <th>CGST<br/>%</th>
        <th>CGST</th>
        <th>SGST<br/>%</th>
        <th>SGST</th>
        <th>Total</th>
    </tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    foreach ($data as $k => $value) {
        if ($value['purchase_return'] == true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['medicine_name'] ?></td>  
            <td><?= $value['medicine_hsn'] ?></td>      
            <td><?= $value['medicine_manufacturer'] ?></td>      
            <td><?= $value['purchase_quantity'] ?></td>    
            <td><?= $value['purchase_free_quantity'] ?></td>    
            <td><?= $value['purchase_unit'] ?></td>   
            <td><?= $value['purchase_batch'] ?></td>   
            <td><?= $value['purchase_expire_month'] ?>/<?= $value['purchase_expire_year'] ?></td>  
            <td><?= $value['purchase_mrp'] ?></td>    
            <td><?= $value['purchase_rate'] ?></td>      
            <td><?= $value['purchase_discount_percent'] ?></td>     
            <td><?= $value['purchase_taxable'] ?></td>       
            <td><?= $value['purchase_cgst_percent'] ?></td>    
            <td><?=
                $value['purchase_cgst'];
                $cgst += $value['purchase_cgst'];
                ?></td>    
            <td><?= $value['purchase_sgst_percent'] ?></td>    
            <td><?=
                $value['purchase_sgst'];
                $sgst += $value['purchase_sgst'];
                ?></td>    
            <td><?=
                $value['purchase_total'];
                $total += $value['purchase_total'];
                ?></td>    </tr>
    <?php } ?>
</tbody>
</table>
<table style="border: 1px solid black;margin-top: 75px;">

    <tr>
        <th>Items</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>Total Gst</th>
        <th>Grand Total</th>
    </tr>
    <tr>
        <td class="totalItem"><?= count($counter) ?></td>
        <td class="totalCgst"><?= $cgst; ?></td>
        <td class="totalSgst"><?= $sgst; ?></td>
        <td class="totalgst"><?= $sgst + $cgst; ?></td>
        <td class="totalAmount"><?= $total ?></td>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>
<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
    <caption><h2>Return Items</h2></caption>
    <tr>
        <th>Sr</th>
        <th>Date</th>
        <th>Product Name</th>
        <th>HSN</th>
        <th>Manufacturer</th>
        <th>Qty</th>
        <th>Free Qty</th>
        <th>Unit</th>
        <th>Batch</th>
        <th>Exp date<br/>(MM/YY)</th>
        <th>MRP</th>
        <th>Rate</th>
        <th>Disc<br/>%</th>
        <th>Taxable</th>
        <th>CGST<br/>%</th>
        <th>CGST</th>
        <th>SGST<br/>%</th>
        <th>SGST</th>
        <th>Total</th>
    </tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    foreach ($data as $k => $value) {
        if ($value['purchase_return'] != true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['purchase_return_date'] ?></td>  
            <td><?= $value['medicine_name'] ?></td>  
            <td><?= $value['medicine_hsn'] ?></td>      
            <td><?= $value['medicine_manufacturer'] ?></td>      
            <td><?= $value['purchase_quantity'] ?></td>    
            <td><?= $value['purchase_free_quantity'] ?></td>    
            <td><?= $value['medicine_unit'] ?></td>   
            <td><?= $value['purchase_batch'] ?></td>   
            <td><?= $value['purchase_expire_month'] ?>/<?= $value['purchase_expire_year'] ?></td>  
            <td><?= $value['purchase_mrp'] ?></td>    
            <td><?= $value['purchase_rate'] ?></td>      
            <td><?= $value['purchase_discount_percent'] ?></td>     
            <td><?= $value['purchase_taxable'] ?></td>       
            <td><?= $value['purchase_cgst_percent'] ?></td>    
            <td><?=
                $value['purchase_cgst'];
                $cgst += $value['purchase_cgst'];
                ?></td>    
            <td><?= $value['purchase_sgst_percent'] ?></td>    
            <td><?=
                $value['purchase_sgst'];
                $sgst += $value['purchase_sgst'];
                ?></td>    
            <td><?=
                $value['purchase_total'];
                $total += $value['purchase_total'];
                ?></td>    </tr>
    <?php } ?>
</tbody>
</table>
<table style="border: 1px solid black;margin-top: 75px;">

    <tr>
        <th>Items</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>Total Gst</th>
        <th>Grand Total</th>
    </tr>
    <tr>
        <td class="totalItem"><?= $counter ?></td>
        <td class="totalCgst"><?= $cgst; ?></td>
        <td class="totalSgst"><?= $sgst; ?></td>
        <td class="totalgst"><?= $sgst + $cgst; ?></td>
        <td class="totalAmount"><?= $total ?></td>
    </tr>
</table>