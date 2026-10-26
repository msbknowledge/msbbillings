
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
                        <caption><h3>Stock List</h3></caption>
            <tr>
                <th>Sl</th>
                <th>Medicine Name</th>
                <th>Medicine Mfg</th>
                <th>Medicine Unit</th>

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
                    <td><?=$value['medicine_manufacturer']?></td>
                    <td><?=$value['medicine_unit']?></td>
                    <td><?=$value['left_strip']?></td>
                    <td><?=$value['left_loose']?></td>
                    <td><?=$value['medicine_storage']?></td>
                </tr> 
            <?php } ?>
        </table>
        </div>
