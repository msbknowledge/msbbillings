<? if(!empty($medicine['medicine_name'])){	
?>
<table>
    <caption><b><?=$medicine['medicine_name']?></b></caption>
    <tr>
        <th>Mfg By</th>
        <th>Unit/per strip or pack</th>
        <th>Stock Strip/Pack</th>
        <th>Stock Loose</th>
        <th>Storage</th>
    </tr>
        <tr>
        <td><?=$medicine['medicine_manufacturer']?></td>
        <td><?=$medicine['medicine_unit']?></td>
        <td><?=$stock['left_strip']?></td>
        <td><?=$stock['left_loose']?></td>
        <td><?=$medicine['medicine_storage']?></td>
    </tr>
</table>
<? } ?>
