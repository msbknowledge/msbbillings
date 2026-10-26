
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
    <caption><h3>Duplicate List</h3></caption>
    <tr>
        <th>Sl</th>
        <th>Product Name</th>
        <th>Product Count</th>
        <th>Product IDS</th>
        <th>Product Merge</th>

    </tr> 
    <?php
    $count = 1;
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= $value['product_name'] ?></td>
            <td><?= $value['total'] ?></td>
            <td><?= implode(',', $value['IDS']) ?></td>
            <td><a class="merge_list" href="/console/product/merge/<?= implode('_', $value['IDS']) ?>"> Merge</a></td>
        </tr> 
    <?php } ?>
</table>
<form action="/console/product/merge_product/" method="post">
    <table>
        <tr>
            <td>Main</td>
            <td>Replace</td>
            <td>action</td>
        </tr>
        <tr>
            <td><input id="main" type="text"><input type="hidden" id="product_main" name="product_main"></td>
            <td><input id="replace" type="text"><input type="hidden" id="product_replace" name="product_replace">
                </td>
            <td><input type="submit" value="Merge"></td>
        </tr>
    </table>
</form>

<script>
    $(document).ready(function () {
        $("#main").autocomplete({
            source: '/search.php?location=product&table=products&fieldToSearch=product_name',
            minLength: 2,
            select: function (event, ui) {
                $('#product_main').val(ui.item.complete.product_id)
            }

        });
        $("#replace").autocomplete({
            source: '/search.php?location=product&table=products&fieldToSearch=product_name',
            minLength: 2,
            select: function (event, ui) {
                $('#product_replace').val(ui.item.complete.product_id)
            }

        });
    });
</script>
