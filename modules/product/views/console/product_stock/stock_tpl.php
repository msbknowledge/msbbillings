
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
                <th>Product Name</th>
                <th>Product Mfg</th>
                <th>Product Stock</th>
                <th>Product Loose</th>
                <th>Product Storage</th>
                <th>Total MRP</th>
            </tr> 
            <?php 
			$count = 1;
			foreach ($result as $value) { ?>
                <tr>
                    <td><?=$count++?></td>
                    <td><?=$value['product_name']?></td>
                    <td><?=$value['product_manufacturer']?></td>
                    <td><?=$value['stock_count']?></td>
                    <td><?=$value['loose_count']?></td>
                    <td><?=$value['product_storage']?></td>
                    <td><?=$mrp=(($value['stock_count']*$value['product_mrp'])+(($value['product_mrp']*$value['loose_count'])+$value['product_unit']))?></td>
                    <td<?=$total+=$mrp?>>
                </tr> 
            <?php } ?>
                 <tr >
        <td style="text-align:center;" colspan="6">Total</td>

  <td ><?= round($total, 1) ?></td>
</tr>
        </table>
        </div>
