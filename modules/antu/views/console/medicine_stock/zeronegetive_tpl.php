
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
                    <table class="table table-bordered table-striped table-condensed">
                        <caption><h3>Zero and Negative List</h3></caption>
            <tr>
                <th>Sl.</th>
                <th>Medicine Name</th>
                <th>Medicine Batch</th>
                <th>Medicine Mfg</th>
                <th>Medicine Month</th>
                <th>Medicine Year</th>
                <th>Medicine Stock</th>
                <th>Medicine Loose</th>
                <th>Medicine Storage</th>
            </tr> 
            <?php 
			$count = 1;
			foreach ($result as $value) { ?>
                <tr>
                    <td><?=$count++?></td>
                    <td><?=$value['medicine_name']?></td>
                    <td><?=$value['medicine_stock_batch']?></td>
                    <td><?=$value['medicine_manufacturer']?></td>
                    <td><?= date('F', mktime(0, 0, 0, $value['medicine_expire_month'], 10))?></td>
                    <td><?=$value['medicine_expire_year']?></td>
                    <td><?=$value['medicine_strip_stock']?></td>
                    <td><?=$value['medicine_loose_stock']?></td>
                    <td><?=$value['medicine_storage']?></td>
                </tr> 
            <?php } ?>
        </table>
