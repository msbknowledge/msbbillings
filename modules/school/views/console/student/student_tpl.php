
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
            <th colspan='3' style="background-color:#063058;color:#fff;font-size:26px;padding:10px;"><center>student Details</></th>           
                       
           
        </tr>
        <tr>
            <th>Course Id</th>           
            <th>Course Name</th> 
            <th>Course Price</th>           
           
        </tr>
        
    </thead>   
    <tbody>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['student_ID']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['student_name']) ?></td>
    <td class="center"><?= htmlspecialchars_decode($table_meta['data']['student_address']) ?></td>
         
                       
    </tbody>
    
</table>  
