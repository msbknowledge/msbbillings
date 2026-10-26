
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
        <th>Medicine Name</th>
        <th>Medicine Count</th>
        <th>Medicine IDS</th>
        <th>Medicine Merge</th>

    </tr> 
    <?php
    $count = 1;
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= $value['medicine_name'] ?></td>
            <td><?= $value['total'] ?></td>
            <td><?= implode(',', $value['IDS']) ?></td>
            <td><a class="merge_list" href="/console/medicine/merge/<?= implode('_', $value['IDS']) ?>"> Merge</a></td>
        </tr> 
    <?php } ?>
</table>
<form action="/console/medicine/merge_medicine/" method="post">
    <table>
        <tr>
            <td>Main</td>
            <td>Replace</td>
            <td>action</td>
        </tr>
        <tr>
            <td><input id="main" type="text"><input type="hidden" id="medicine_main" name="medicine_main"></td>
            <td><input id="replace" type="text"><input type="hidden" id="medicine_replace" name="medicine_replace">
                </td>
            <td><input type="submit" value="Merge"></td>
        </tr>
    </table>
</form>

<script>
    $(document).ready(function () {
        $("#main").autocomplete({
            source: '/search.php?location=medicine&table=medicines&fieldToSearch=medicine_name',
            minLength: 2,
            select: function (event, ui) {
                $('#medicine_main').val(ui.item.complete.medicine_id)
            }

        });
        $("#replace").autocomplete({
            source: '/search.php?location=medicine&table=medicines&fieldToSearch=medicine_name',
            minLength: 2,
            select: function (event, ui) {
                $('#medicine_replace').val(ui.item.complete.medicine_id)
            }

        });
    });
</script>
