<?php
ob_start();
clearstatcache();
opcache_reset();
opcache_invalidate(__FILE__, true);
opcache_invalidate('purchase_sale_medicine_search.php');
header("Content-Type: text/html");
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once __DIR__ . '/node_db.php';
$medicine_unit = 0;
if (isset($_GET['term'])) {
  $return_arr = array();

  try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $medicine = $conn->prepare('SELECT medicine_unit FROM medicines where medicine_id=' . $_GET['term'] . ' limit 0,1');
    $medicine->execute();
    while ($row = $medicine->fetch(PDO::FETCH_ASSOC)) {
      $medicine_unit = $row['medicine_unit'];
    }

    $purchase = $conn->prepare('SELECT * FROM purchases join suppliers on purchases.purchase_supplier=suppliers.supplier_ID  WHERE  purchase_medicine_id=' . $_GET['term'] . ' ORDER BY purchase_date DESC');
    $purchase->execute();
    $purchase_total = 0;
    $purchase_free_total = 0;

    while ($row = $purchase->fetch(PDO::FETCH_ASSOC)) {
      $purchase_total += $row['purchase_quantity'];
      $purchase_free_total += $row['purchase_free_quantity'];
      $responce[] = array('data' => $row);
    }

    $sale = $conn->prepare('SELECT * FROM sales  join customers on sales.sale_customer=customers.customer_ID WHERE  sale_medicine_id=' . $_GET['term'] . ' ORDER BY sale_date DESC');
    $sale->execute();

    $sale_total = 0;
    $sale_loose_qty = 0;
    while ($row = $sale->fetch(PDO::FETCH_ASSOC)) {
      $sale_loose_qty += $row['sale_loose_quantity'];
      $sale_total += $row['sale_strip_quantity'];
      $responce[] = array('data' => $row);
    }

    $medicine_stock = $conn->prepare('SELECT * FROM medicine_stocks WHERE  medicine_stock_medicine =' . $_GET['term'] . ' ORDER BY medicine_stock_date DESC');
    $medicine_stock->execute();

    $medicine_stock_total = 0;
    $medicine_stock_loose_total = 0;
    while ($row = $medicine_stock->fetch(PDO::FETCH_ASSOC)) {
      $medicine_stock_total += $row['medicine_strip_stock'];
      $medicine_stock_loose_total += $row['medicine_loose_stock'];
      $responce[] = array('data' => $row);
    }

    $return_purchase = $conn->prepare('SELECT * FROM return_purchases  join suppliers on return_purchases.return_purchase_supplier=suppliers.supplier_ID WHERE  return_purchase_medicine_id=' . $_GET['term'] . ' ORDER BY return_purchase_date DESC');
    $return_purchase->execute();

    $return_purchase_total = 0;
    while ($row = $return_purchase->fetch(PDO::FETCH_ASSOC)) {
      $return_purchase_total += $row['return_purchase_strip'];
      $responce[] = array('data' => $row);
    }

    $return_sale = $conn->prepare('SELECT * FROM returns_sales  join customers on returns_sales.return_sale_customer=customers.customer_ID WHERE  return_sale_medicine_id=' . $_GET['term'] . ' ORDER BY return_sale_date DESC');
    $return_sale->execute();

    $return_sale_total = 0;
    while ($row = $return_sale->fetch(PDO::FETCH_ASSOC)) {
      $return_sale_total += $row['return_sale_strip'];
      $responce[] = array('data' => $row);
    }
  } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }


  foreach ($responce as $key => $val) :

    if ($val['data']['purchase_date']) :
      $final[strtotime($val['data']['purchase_date'])][] = array_merge($val['data'], array('type' => 'purchase'));
    elseif ($val['data']['sale_date']) :
      $final[strtotime($val['data']['sale_date'])][] = array_merge($val['data'], array('type' => 'sale'));
    elseif ($val['data']['return_purchase_date']) :
      $final[strtotime($val['data']['return_purchase_date'])][] = array_merge($val['data'], array('type' => 'return_purchase'));
    elseif ($val['data']['return_sale_date']) :
      $final[strtotime($val['data']['return_sale_date'])][] = array_merge($val['data'], array('type' => 'return_sale'));
    else :
      $final[strtotime($val['data']['medicine_stock_date'])][] = array_merge($val['data'], array('type' => 'update'));
    endif;
  endforeach;
  krsort($final);
}


$balanced_loose = 0 + $medicine_stock_loose_total - $sale_loose_qty;
$looseLeft = 0;
if ($balanced_loose > 0) {
  $fromStrip = ceil($balanced_loose / $medicine_unit);
  $looseLeft =   ($fromStrip * $medicine_unit) - $balanced_loose;
}
if ($balanced_loose < 0) {
  $fromStrip = floor($balanced_loose / $medicine_unit);
  $looseLeft =  $balanced_loose -  ($fromStrip * $medicine_unit);
}
?>

<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  td,
  th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
  }

  tr.purchase {
    background-color: #ffeeba;
  }

  tr.sale {
    background-color: #c3e6cb;
  }

  tr.update {
    background-color: lightpink;
  }

  tr.total {
    background-color: gold;
  }

  tr.return_purchase {
    background-color: coral;
  }

  tr.return_sale {
    background-color: darkseagreen;
  }
</style>
<table>
  <caption>Total break Counts</caption>
  <tr class="purchase">
    <td>Purchase</td>
    <td><?= $purchase_total ?></td>
    <td>Purchase free</td>
    <td><?= $purchase_free_total ?></td>
  </tr>
  <tr class="sale">
    <td>Sold</td>
    <td><?= $sale_total ?></td>
    <td>Sold Loose</td>
    <td><?= $sale_loose_qty ?></td>
  </tr>
  <tr class="update">
    <td>Adjusted Strip</td>
    <td><?= $medicine_stock_total ?> </td>
    <td>Adjusted loose</td>
    <td><?= $medicine_stock_loose_total ?></td>
  </tr>
  <tr>
    <td>Purchase Return</td>
    <td><?= $return_purchase_total ?></td>
    <td>Sale Return</td>
    <td><?= $return_sale_total ?></td>
  </tr>
  <tr class="total">
    <td colspan=4>

      <h1>Total Stock: <?php echo  ($purchase_total + $purchase_free_total - $sale_total + $medicine_stock_total - $return_purchase_total + $return_sale_total + $fromStrip); ?>
        &nbsp; &nbsp;&nbsp;
        Loose: Approx (<?= $looseLeft ?>) pc</h1>
    </td>
  </tr>
</table>
<table>
  <tr>
    <th>Sl.no</th>
    <th>Date</th>
    <th>Type</th>
    <th>Supplier / Customer</th>
    <th>Quantity</th>
    <th>Batch</th>
    <th>Expiry</th>
    <th>MRP</th>
    <th>Rate</th>
    <th>Bill / Invoice</th>
  </tr>
  <?php
  $i = 1;
  foreach ($final as $key => $value) :  ?>
    <?php foreach ($value as $keys => $val) :  ?>
      <tr class="<?php echo $val['type'] ?>">

        <td><?= $i ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_date'];
            elseif ($val['type'] == 'sale') :
              echo $val['sale_date'];
            elseif ($val['type'] == 'return_purchase') :
              echo $val['return_purchase_date'];
            elseif ($val['type'] == 'return_sale') :
              echo $val['return_sale_date'];
            else :
              echo $val['medicine_stock_date'];
            endif;
            ?></td>
        <td><?= ucfirst(str_ireplace("_", ' ', $val['type'])); ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['supplier_name'];
            elseif ($val['type'] == 'sale') :
              echo $val['customer_name'];
            elseif ($val['type'] == 'return_purchase') :
              echo $val['supplier_name'];
            elseif ($val['type'] == 'return_sale') :
              echo $val['customer_name'];
            else :

            endif;
            ?></td>

        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_quantity'] . ' ( free: ' . $val['purchase_free_quantity'] . ' )';
            elseif ($val['type'] == 'sale') :
              echo ($val['sale_strip_quantity'] . ' ( loose: ' . $val['sale_loose_quantity'] . ' )');
            elseif ($val['type'] == 'return_purchase') :
              echo ($val['return_purchase_strip']);
            elseif ($val['type'] == 'return_sale') :
              echo ($val['return_sale_strip']);
            else :
              echo ($val['medicine_loose_stock'] + $val['medicine_strip_stock']);
            endif;
            ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_batch'];
            elseif ($val['type'] == 'sale') :
              echo ($val['sale_batch']);
            elseif ($val['type'] == 'return_purchase') :
              echo ($val['return_purchase_Batch']);
            elseif ($val['type'] == 'return_sale') :
              echo ($val['return_sale_Batch']);
            else :
              echo ($val['medicine_stock_batch']);
            endif;
            ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_expire_month'] . '/' . $val['purchase_expire_year'];
            elseif ($val['type'] == 'sale') :
              echo $val['sale_expire_month'] . '/' . $val['sale_expire_year'];
            elseif ($val['type'] == 'return_purchase') :
              echo $val['return_purchase_expire_month'] . '/' . $val['return_purchase_expire_year'];
            elseif ($val['type'] == 'return_sale') :
              echo $val['return_sale_expire_month'] . '/' . $val['return_sale_expire_year'];
            else :
              echo $val['medicine_expire_month'] . '/' . $val['medicine_expire_year'];
            endif;
            ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_mrp'];
            elseif ($val['type'] == 'sale') :
              echo $val['sale_mrp'];
            elseif ($val['type'] == 'return_purchase') :
              echo $val['return_purchase_mrp'];
            elseif ($val['type'] == 'return_sale') :
              echo $val['return_sale_mrp'];
            else :
              echo $val['medicine_mrp'];
            endif;
            ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_rate'];
            elseif ($val['type'] == 'sale') :
              echo $val['sale_rate'];
            elseif ($val['type'] == 'return_purchase') :

            elseif ($val['type'] == 'return_sale') :
              echo $val['return_sale_total'];
            else :

            endif;
            ?></td>
        <td><?php if ($val['type'] == 'purchase') :
              echo $val['purchase_invoice'] . ' (' . $val['purchase_entry_number'] . ')';
            elseif ($val['type'] == 'sale') :
              echo $val['sale_invoice'];
            elseif ($val['type'] == 'return_purchase') :
              echo $val['return_purchase_entry_number'];
            elseif ($val['type'] == 'return_sale') :
              echo $val['return_sale_invoice'];
            else :

            endif;
            ?></td>
      </tr>

    <?php $i++;
    endforeach;  ?>
  <?php endforeach;  ?>
</table>

<?php
$data = ob_get_contents();
ob_end_clean();
echo $data;
?>
