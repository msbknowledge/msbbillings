<? if($data){?>
<table>
    <caption><?=$product?></caption>
    <tr>
        <th>Date</th>
        <th>Supplier Name</th>
        <th>Invoice</th>
        <th>Quantity</th>
        <th>MRP</th>
        <th>Purchase Rate</th>
    </tr>
<?
foreach ($data as $value) {?>
    <tr>
<?    foreach ($value as $k=>$v) {?>
        <td><?=$v?></td>
<?    } ?>
    </tr>
<? }?>
</table>
<? } ?>