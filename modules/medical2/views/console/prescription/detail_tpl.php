<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
            <th colspan='6' style="background-color:#063058;color:#fff;font-size:26px;padding:10px;"><center>Student Details</></th>           
                       
           
        </tr>
        <tr>
            <th>Student Id</th>           
            <th>Student Name</th> 
            <th>Student Address</th>           
            <th>Status</th>           
            <th>Activation Date</th> 
            <th>Deactivation Date</th>           
           
        </tr>
       
    </thead>   
    <tbody>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['Name']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['phone']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['address']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['note']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['status']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['image_cupture']) ?></td>
        
                       
    </tbody>
    
</table>  
