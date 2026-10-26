<? if(!empty($product['product_name'])){	
?>
<table>
    <caption><b><?=$product['product_name']?></b></caption>
    <tr>
        <th>Mfg By</th>
        <th>Unit/per strip or pack</th>
        <th>Stock Strip/Pack</th>
        <th>Stock Loose</th>
        <th>Storage</th>
    </tr>
        <tr>
        <td><?=$product['product_manufacturer']?></td>
        <td><?=$product['product_unit']?></td>
        <td><?=$stock['left_strip']?></td>
        <td><?=$stock['left_loose']?></td>
        <td><?=$product['product_storage']?></td>
    </tr>
</table>
<? } ?>
