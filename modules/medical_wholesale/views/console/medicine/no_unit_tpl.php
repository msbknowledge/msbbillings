
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
                        <caption><h3>No Unit Assigned List</h3></caption>
            <tr>
                <th>Sl</th>
                <th>Medicine Name</th>
                <th>Enter Storage</th>
            </tr> 
            <?php 
			$count = 1;
			foreach ($result as $value) { ?>
                <tr>
                    <td><?=$count++?></td>
                    <td><?=$value['medicine_name']?></td>
                    <td><form action="" method="post" style="margin:0 10px"><input type="text" name="medicine_unit[<?=$value['medicine_id']?>]"><button class="btn btn-success">Save</button></form></td>
                </tr> 
            <?php } ?>
        </table>
