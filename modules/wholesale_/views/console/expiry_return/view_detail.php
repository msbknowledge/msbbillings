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
    <caption><h2>Entry No:<?= $data[0]['expiry_return_entry_number'] ?></h2></caption>
    <tr>

        <th  style="border: none;line-height: 9px;text-align: left;">

            <p style="text-align: left;"><h3>Supplier: <?= $data[0]['supplier_name'] ?></h3><br/>Address: <?= $data[0]['supplier_address'] ?></p>
        </th>
        <th  style=" border: none;">GSTIN: <?= $data[0]['supplier_gst'] ?></th>
    </tr>
</table>  
<table style=" border: none;">
    <tr>
        <th  style=" border: none; text-align: left;">DATE: <?= $data[0]['expiry_return_date'] ?><br/>Contact:<?= $data[0]['supplier_contact'] ?></th>
    </tr>
</table>
<?php
$total = 0;
$cgst = 0;

$sgst = 0;
?>

<table style="border-top: 1px solid black; border-bottom: 1px solid black;">
    <thead>
        <caption><h2>Expiry Items</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
 <th>HSN</th>
            <th>Batch</th>
            <th>Strip</th>

            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Total</th>

        </tr>
    </tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    foreach ($data as $k => $value) {
        if ($value['expiry_return_return'] == true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td><?= $value['expiry_return_medicine'] ?></td>  
              <td><?= $value['expiry_return_HSN'] ?></td>  
                 <td><?= $value['expiry_return_Batch'] ?></td>    
            <td><?= $value['expiry_return_strip'] ?></td>   
            
            <td><?= $value['expiry_return_expire_month'] ?>/<?= $value['expiry_return_expire_year'] ?></td>  
            <td><?= (float)$value['expiry_return_mrp'] ?></td>  
            <td><?= (float)$value['expiry_return_mrp']*(float)$value['expiry_return_strip'] ?></td>    
             </tr>
    <?php } ?>
</tbody>
</table>

<?php
$total = 0;
$cgst = 0;
$sgst = 0;
?>
