<? if($data){?>
<table>
    <caption><?=$medicine?></caption>
    <tr>
        <th>Date</th>
        <th>Supplier Name</th>
        <th>Invoice</th>
        <th>Quantity</th>
        <th>MRP</th>
        <th>Purchase Rate</th>
    </tr>
<?
//print_r($data);
foreach ($data as $k=>$value) {?>
    <tr>
        <td><?=$data[$k]['purchase_date']?></td>
        <td><?=$data[$k]['supplier_name']?></td>
        <td><?=$data[$k]['purchase_invoice']?></td>
        <td><?=$data[$k]['purchase_quantity']?></td>
        <td><?=$data[$k]['purchase_mrp']?></td>
        <td><?=$data[$k]['purchase_rate']?></td>
    </tr>
<? }?>
</table>
<? } ?>