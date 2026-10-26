<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css" id="" media="print, projection, screen" />

<div class="scrollgard" style=" overflow-x: auto;">
<table id="myTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>ID</th> 
    <th>Name</th> 
    <th>Code</th> 
    <th>Area</th> 
    <th>STB</th> 
    <th>VC</th> 
    <th>Contact</th> 
    <th>Total Billed</th> 
    <th>Total Collected</th> 
    <th>Due</th> 
</tr> 
</thead> 
<tbody> 
<? $totalDue = 0.00;
$totalCollected = 0.00;
$totalInvoice = 0.00;
        foreach ($customers as $key => $value) {?>
      <tr> 
    <td><?=$key?></td> 
    <td><?=$value['customer_name']?></td> 
    <td><?=$value['customer_code']?></td> 
    <td><?=$value['customer_area']?></td> 
    <td><?=$value['stb_no']?></td> 
    <td><?=$value['stb_vc']?></td> 
    <td><?=$value['customer_contact']?></td> 
    <td><?=$value['total_invoice']?></td> 
    <td><?=$value['total_collected']?></td> 
    <td><?=$value['due']?></td> 
</tr>   
<?  
$totalDue+=(float) $value['due'];
$totalInvoice+=(float) $value['total_invoice'];
$totalCollected+=(float) $value['total_collected'];
}?>

</tbody> 
</table> 
   
    <span class="label">Total Invoice:</span> Rs: <?=$totalInvoice?>/
    <span class="label label-success">Total Collected:</span> <?=$totalCollected?> <span class="label label-important">Total Due:</span> <?=$totalDue?>
</div>
<script>
    $(document).ready(function() 
    { 
           $('#myTable').DataTable();
    } 
); 
    
</script>