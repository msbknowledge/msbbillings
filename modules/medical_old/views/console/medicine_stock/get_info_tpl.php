<? if(!empty($medicine['medicine_name'])){	

$totalstrip = 0;
$totalloose = 0;
foreach($stock as $st){
	$totalstrip += $st['left_strip'];
	$totalloose += $st['left_loose'];
}
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
        <td><?=$totalstrip?></td>
        <td><?=$totalloose?></td>
        <td><?=$medicine['medicine_storage']?></td>
    </tr>
</table>
<? } ?>
