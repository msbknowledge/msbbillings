<table class="span11">
    <tr>
        <td>Choose</td>
        <td>Invoice Number</td>
        <td>Date</td>
        <td>Ammount</td>
    </tr>
    <? foreach ($data as $key => $value): ?>
       <tr>
         <td><input type="checkbox"  value="<?=$value['sale_invoice']?>"></td>
         <td><?=$value['sale_invoice']?></td>
        <td><?= date('d/m/Y', strtotime($value['sale_date']))?></td>
        <td><?= round($value['total'])?></td>
    </tr>
  <? endforeach;?>
     
    
</table>
