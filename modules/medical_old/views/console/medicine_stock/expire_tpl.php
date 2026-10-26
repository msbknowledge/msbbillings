
        <style>
            @media print {
                html, body {
                    display: block; 
                    font-family: "Calibri";
                    margin: 0;
                }

                @page {
                    size: 21.59cm 13.97cm;
                }

                .logo {
                    width: 30%;
                }

            }
        </style>
        <div class="row" style=" margin: 0px; overflow-x: scroll;">
                    <table class="table table-bordered table-striped table-condensed">
                       <caption><h3>Expire List</h3></caption>
          
            <tr>
                <th>Sl.</th>
                <th>Medicine Name</th>
                <th>Batch</th>
                <th>Stock strip</th>
                <th>Stock loose</th>
                <th>Mfg</th>
                <th>Month</th>
                <th>Year</th>
                <th>Storage</th>
            </tr> 
            <tbody>
            <?php 
			$count = 1;
			foreach ($result['data'] as $value) { ?>
                <tr>
                    <td><?=$count++?> </td>
                    <td><a href="<?=console_url();?>medicine_stock/fast_update/<?=$value['medicine_id']?>" target="_blank" class="btn btn-info"><?=$value['medicine_name']?></a></td>
                    <td><?=$value['purchase_batch']?></td>
                     <td><?=$value['stock']['left_strip']?> </td><td> <?=$value['stock']['left_loose']?></td>
                    <td><?=$value['medicine_manufacturer']?></td>
                    <td><?= date('F', mktime(0, 0, 0, $value['purchase_expire_month'], 10))?></td>
                    <td>20<?=$value['purchase_expire_year']?></td>
                    <td><?=$value['medicine_storage']?></td>
                </tr> 
            <?php } ?>
            </tbody>
             <tr>
                <th>Sl.</th>
                <th>Medicine Name</th>
                <th>Batch</th>
                <th>Stock strip</th>
                <th>Stock loose</th>
                <th>Mfg</th>
                <th>Month</th>
                <th>Year</th>
                <th>Storage</th>
            </tr>
             
        </table>
       <div class="span12" style="clear: both;margin: 0 auto;text-align: center;">
        <?php 
        for($i=1;$i<=$result['count'][0]['count']/1000;$i++){?>
        <a class="btn" href="/console/medicine_stock/<?=$uri?>/<?=$i?>"><?=$i?></a>
        <?php } ?>
        </div>
        </div>
