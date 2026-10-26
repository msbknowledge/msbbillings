<table class="span11">
    <tr>
        <td>Choose</td>
        <td>Invoice Number</td>
        <td>Invoice Entry Number</td>
        <td>Date</td>
        <td>Amount</td>
    </tr>
    <? foreach ($data as $key => $value): ?>
       <tr>
         <td><input type="checkbox"  value="<?=$value['purchase_invoice']?>"></td>
         <td><?=$value['purchase_invoice']?></td>
          <td><?=$value['purchase_entry_number']?></td>
        <td><?= date('d/m/Y', strtotime($value['purchase_date']))?></td>
        <td><?= round($value['total'])?></td>
    </tr>
  <? endforeach;?>
     
    
</table>
