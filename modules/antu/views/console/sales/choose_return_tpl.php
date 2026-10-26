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
    <caption><h2>Sold Items</h2></caption>
    <thead>
        <tr>
            <th>Sr</th>
            <th>Choose</th>
            <th>Product Name</th>
            <th>Loose</th>
            <th>Batch</th>
            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Billed Total</th>
            <th>Return Qty</th>
        </tr>
        </tr>
    </thead>
    <tbody class="appendHere">
        <?php
        $counter = 0;
        foreach ($data as $k => $value) {
            ?>    

            <tr class="rowline">
                <td>
                    <span><?= ++$counter; ?></span>
                </td>  
                <td>
                    <input type="checkbox" name="return_sale_ID[][<?= $value['sale_ID'] ?>]"> 
                </td>  
                <td><?= $value['medicine_name'] ?><br/>Mfg: <?= $value['medicine_manufacturer'] ?></td>
                <td><?= $value['sale_loose_quantity'] ?></td>    

                <td><?= $value['sale_batch'] ?></td>   
                <td><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></td>  

                <td><?= $value['sale_mrp'] ?></td>    
                <td><?=
                    $value['sale_total'];
                    $total += $value['sale_total'];
                    ?></td>   
                <td>
                    <? if ($value['sale_strip_quantity'] > 0) { ?>
                        <input name="return_qty" type="number" max="<?= $value['sale_strip_quantity'] ?>" min="0" value="<?= $value['sale_strip_quantity'] ?>">
                    <? } ?>
                </td>    

            </tr>
        <?php } ?>
    </tbody>
</table>