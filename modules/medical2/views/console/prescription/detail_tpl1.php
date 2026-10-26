
<?php 

?>
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
            <th colspan='8' style="background-color:#063058;color:#fff;font-size:26px;padding:10px;"><center>Prescription Details</></th>           
                       
           
        </tr>
        <tr>
            <th>Id</th>           
            <th>Name</th>
            <th>Phone No</th>   
            <th>Address</th>    
            <th>Note</th>         
            <th>Status</th>           
            <th>Image</th> 
            <th>Date</th>           
           
        </tr>
       
    </thead>   
    <tbody>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['id']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['Name']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['phone']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['address']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['note']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['status']) ?></td>
    <td class="center"><img src="data:image/jpeg;base64,<?=base64_decode($table_meta['data']['image_cupture'])?>" /> 
 
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['date']) ?></td>
        
                       
    </tbody>
    
</table>  
