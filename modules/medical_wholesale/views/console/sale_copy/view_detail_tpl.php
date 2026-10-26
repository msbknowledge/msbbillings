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
    <caption><h2>Invoice No:<?= $data[0]['sale_invoice'] ?></h2></caption>
    <tr>
        <th  style="border: none;line-height: 9px;text-align: left;">
            <p style="text-align: left;"><h3>Customer: <?= $data[0]['customer_name'] ?></h3><br/>Address: <?= $data[0]['customer_address'] ?></p>
        </th>
        <th  style="border: none;line-height: 9px;text-align: left;">
            <p style="text-align: left;"><h3>Doctor: <?= $data[0]['doctor_name'] ?></h3><br/>Address: <?= $data[0]['doctor_address'] ?></p>
        </th>
        <th  style=" border: none;">GSTIN: <?= $data[0]['customer_gst'] ?></th>
    </tr>
</table>  
<table style=" border: none;">
    <tr>
        <th  style=" border: none; text-align: left;">DATE: <?= date('d-F-Y', strtotime($data[0]['sale_date'])) ?><br/>Contact:<?= $data[0]['customer_contact'] ?></th>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>

<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
    <caption><h2>Sold Items</h2></caption>
    <tr>
        <th>Sr</th>
        <th>Product Name</th>
        <th>HSN</th>
        <th>Strip/Pack</th>
        <th>Loose</th>
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
</tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    foreach ($data as $k => $value) {
        if ($value['sale_return'] == true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['medicine_name'] ?><br/>Mfg: <?= $value['medicine_manufacturer'] ?></td>  
            <td><?= $value['medicine_hsn'] ?></td>      
            <td><?= $value['sale_strip_quantity'] ?></td>    
            <td><?= $value['sale_loose_quantity'] ?></td>    
            <td><?= $value['sale_batch'] ?></td>   
            <td><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></td>  
            <td><?= $value['sale_mrp'] ?></td>    
            <td><?= $value['sale_rate'] ?></td>      
            <td><?= $value['sale_discount_percent'] ?></td>     
            <td><?= $value['sale_taxable'] ?></td>       
            <td><?= $value['sale_cgst_percent'] ?></td>    
            <td><?=
                $value['sale_cgst'];
                $cgst += $value['sale_cgst'];
                ?></td>    
            <td><?= $value['sale_sgst_percent'] ?></td>    
            <td><?=
                $value['sale_sgst'];
                $sgst += $value['sale_sgst'];
                ?></td>    
            <td><?=
                $value['sale_total'];
                $total += $value['sale_total'];
                ?></td>    
        </tr>
    <?php } ?>
</tbody>
</table>
<table style="border: 1px solid black;" class="sold_calc">

    <tr>
        <th>Items</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>Total Gst</th>
        <th>Grand Total</th>    
        <th>Previous Due</th>
        <th>Payable</th>
        <th>Paid</th>
        <th>Current Due</th>
        <th>Paid By</th>
        <th>Payment Note</th>
    </tr>
    <tr>
        <?php 
            $saleTotalPayable = ($total + $data[0]['sale_total_previous_due']);
            $saleTotalDiscPayable = ($saleTotalPayable * $data[0]['sale_grand_discount'] / 100);
        ?>
        <td class="totalItem"><?= count($counter) ?></td>
        <td class="totalCgst"><?= $cgst ?></td>
        <td class="totalSgst"><?= $sgst ?></td>
        <td class="totalgst"><?= $cgst + $sgst ?></td>
        <td class="totalAmount"><?= $total ?></td>
        <td class="customer_due" style="width: 100px;text-align:center">
            <?= $data[0]['sale_total_previous_due'] ?></td>
        <td class="customer_payable"><?= $saleTotalPayable - $saleTotalDiscPayable; ?></td>
        <td class="paid" style="width: 100px;text-align:center"><?= $data[0]['sale_total_paid'] ?></td>
        <td class="currentdue"><?= round($data[0]['sale_total_previous_due'] - $data[0]['sale_total_paid'] + $total - $saleTotalDiscPayable) ?></td>
        <td class="method" style="width: 100px;text-align:center">
            <?php echo $data[0]['sale_paid_by']; ?></td>
        <td class="paymentnote">
                <?= $data[0]['sale_note']; ?>
        </td>

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
        <th>Return Date</th>
        <th>Product Name</th>
        <th>HSN</th>
        <th>Qty</th>
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
        if ($value['sale_return'] != true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['sale_return_date'] ?></td>  
            <td><?= $value['medicine_name'] ?><Br/>Mfg: <?= $value['medicine_manufacturer'] ?></td>  
            <td><?= $value['medicine_hsn'] ?></td>      
            <td><?= $value['sale_quantity'] ?></td>    
            <td><?= $value['sale_batch'] ?></td>   
            <td><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></td>  
            <td><?= $value['sale_mrp'] ?></td>    
            <td><?= $value['sale_rate'] ?></td>      
            <td><?= $value['sale_discount_percent'] ?></td>     
            <td><?= $value['sale_taxable'] ?></td>       
            <td><?= $value['sale_cgst_percent'] ?></td>    
            <td><?=
                $value['sale_cgst'];
                $cgst += $value['sale_cgst'];
                ?></td>    
            <td><?= $value['sale_sgst_percent'] ?></td>    
            <td><?=
                $value['sale_sgst'];
                $sgst += $value['sale_sgst'];
                ?></td>    
            <td><?=
                $value['sale_total'];
                $total += $value['sale_total'];
                ?></td>    </tr>
    <?php } ?>
</tbody>
</table>
<table style="border: 1px solid black;" class="sold_calc">

    <tr>
        <th>Items</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>Total Gst</th>
        <th>Grand Total</th>    
        <th>Previous Due</th>
        <th>Payable</th>
        <th>Paid</th>
        <th>Current Due</th>
        <th>Paid By</th>
        <th>Payment Note</th>
    </tr>
    <tr>
        <td class="totalItem"><?= count($counter) ?></td>
        <td class="totalCgst"><?= $cgst ?></td>
        <td class="totalSgst"><?= $sgst ?></td>
        <td class="totalgst"><?= $cgst + $sgst ?></td>
        <td class="totalAmount"><?= $total ?></td>
        <td class="customer_due" style="width: 100px;text-align:center">
            <?= $data[0]['sale_total_previous_due'] ?></td>
        <td class="customer_payable"><?= $total + $data[0]['sale_total_previous_due']; ?></td>
        <td class="paid" style="width: 100px;text-align:center">
            <?= $data[0]['sale_total_paid'] ?></td>
                    <td class="currentdue"><?= round($data[0]['sale_total_previous_due'] - $data[0]['sale_total_paid'] + $total) ?></td>
        <td class="method" style="width: 100px;text-align:center">
            <?php echo $data[0]['sale_paid_by']; ?></td>
        <td class="paymentnote">
                <?= $data[0]['sale_note']; ?>
        </td>

    </tr>
</table>