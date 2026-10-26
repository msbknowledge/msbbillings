<?php
function product_count() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT DISTINCT count(product_name) as product_count FROM products')->result_array();
    return $count;
}
function no_unit(){
	 $CI = &get_instance();
    return count($CI->products_model->no_unit());

}
function product_error_expire_date() {
    $CI = &get_instance();
    $count = count($CI->db->query('select products.*, product_stocks.* from product_stocks join products on product_stock_product = product_id where product_expire_year = 0 and product_expire_month =0 order by product_expire_year asc,product_expire_month asc')->result_array());
    return $count;
}
function product_error_storage() {
    $CI = &get_instance();
    return count($CI->products_model->get_list(array('product_storage'=>'')));;
}
function duplicate(){
	 $CI = &get_instance();
    return count( $CI->products_model->duplicate());
}

function total_sale_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(sale_total) as sale FROM `sales` WHERE sale_date=CURRENT_DATE')->result_array();
    return $count;
}
function expiring() {
    $CI = &get_instance();
    $count = count($CI->product_stocks_model->expire());
    return $count;
}
function expired() {
    $CI = &get_instance();
    $count = count($CI->product_stocks_model->expire(true));
    return $count;
}
function product_error_zeronegetive() {
    $CI = &get_instance();
    $count = count($CI->product_stocks_model->zeronegetive());
    //$count =0;
    return $count;
}
function shortage() {
    $CI = &get_instance();
    $count = count($CI->product_stocks_model->shortage());
    return $count;
}
function total_purchase_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(purchase_total) as purchase FROM `purchases` WHERE purchase_date=CURRENT_DATE')->result_array();
    return $count;
}

function generate_invoice_number() {
    if (date('m') > 3) {
        $year = date('y')."-".(date('y') +1);
    }
    else {
        $year = (date('y')-1)."-".date('y');
    }
    $invoice_last_count = (int) get_option('invoice_last_count') + 1;
    $inovice_number = get_option('invoice_number');
    return str_ireplace(array('[{number}]', '[{year}]'), array(sprintf('%05d', $invoice_last_count),$year), $inovice_number);
}
function generate_purchase_number() {
    $purchase_last_count = (int) get_option('purchase_last_count') + 1;
    return sprintf('%05d', $purchase_last_count);
}
function generate_expiry_number() {
    $expiry_last_count = (int) get_option('expiry_last_count') + 1;
    return sprintf('%05d', $expiry_last_count);
}
function increase_purchase_number() {
    set_option('purchase_last_count', 1 + (int) get_option('purchase_last_count'));
}
function increase_expiry_number() {
    set_option('expiry_last_count', 1 + (int) get_option('expiry_last_count'));
}
function increase_invoice_number() {
    set_option('invoice_last_count', 1 + (int) get_option('invoice_last_count'));
}

function product_overview() {
    ?>
    <div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-bell"></i>Overview</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-bordewhite table-striped">
                <thead>
                    <tr>
                        <th>Labels</th>
                        <th>Number Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="label">Effective Product Added In Store</span>
                        </td>
                        <td>
                                <span class="label"> <?php
                                    $product_count = product_count();
                                    if (empty($product_count[0]['product_count'])) {
                                        echo 'N/A';
                                    } else {
                                        echo $product_count[0]['product_count'];
                                    }
                                    ?></span>
                        </td>

                    </tr>
					 <tr>
                        <td>
                            <span class="label label-info">Simplebilling Product Database</span>
                        </td>
                        <td>
                                <span class="label label-info">4Lakh+</span>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <span  class="label label-success">Total Sale of the day</span>
                        </td>
                        <td>
                                <span class="label"> Rs: <?php
                                    $sale_count = total_sale_today();
                                    if (empty($sale_count[0]['sale'])) {
                                        echo 'N/A';
                                    } else {
                                        echo $sale_count[0]['sale'];
                                    }
                                    ?></span>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <span  class="label label-success">Total Purchase of the day</span>
                        </td>
                        <td>
                                <span class="label">Rs: <?php
                                    $purchase_count = total_purchase_today();
                                    if (empty($purchase_count[0]['purchase'])) {
                                        echo 'N/A';
                                    } else {
                                        echo $purchase_count[0]['purchase'];
                                    }
                                    ?></span>
                        </td>

                    </tr>
					<tr>
                        <td>
                            <span  class="label label-warning">Upcoming Expire</span>
                        </td>
                        <td>
						<?php $result = expiring()?>
                            <a href="/console/product_stock/expiring">
							<button class="btn btn-success">
                                <?=$result?>
                            </button>
							</a>
                        </td>

                    </tr>
					<tr>
                        <td>
                            <span  class="label label-important"> Expired</span>
                        </td>
                        <td>
						<?php $result = expired()?>
                            <a href="/console/product_stock/expired">
							<button class="btn btn-danger">
                               <?=$result?>
                            </button>
							</a>
                        </td>

                    </tr>
					<tr>
                        <td>
                            <span  class="label label-warning">Shortage (Less than 3 unit)</span>
                        </td>
                        <td>
						<?php $result = shortage()?>
                            <a href="/console/product_stock/shortage">
							<button class="btn btn-success">
                                <span class="label"><?=$result?></span>
                            </button>
							</a>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div><!--/span-->

    <?php
}

function product_stock_update($product_batch, $product_id, $product_strip_stock,$product_loose_stock=0, $type = "+", $product_mrp = null, $product_expire_month = null, $product_expire_year = null) {
    $CI = &get_instance();
    $CI->db->set('product_strip_stock', "product_strip_stock $type $product_strip_stock", FALSE);
    $CI->db->set('product_loose_stock', "product_loose_stock $type $product_loose_stock", FALSE);
    if ($product_mrp != null) {
        $CI->db->set('product_mrp', $product_mrp);
    }
    if ($product_expire_month != null) {
        $CI->db->set('product_expire_month', $product_expire_month);
    }
    if ($product_expire_year != null) {
        $CI->db->set('product_expire_year', $product_expire_year);
    }
    $CI->db->where(array('product_stock_product' => $product_id, 'product_stock_batch' => $product_batch));
    $CI->db->update('product_stocks');
    if ($CI->db->affected_rows() == 0) {
        $CI->db->set('product_strip_stock', "product_strip_stock $type $product_strip_stock", FALSE);
        $CI->db->set('product_loose_stock', "product_loose_stock $type $product_loose_stock", FALSE);
        $CI->db->set('product_stock_product', $product_id);
        $CI->db->set('product_stock_batch', $product_batch);
        if ($product_mrp != null) {
            $CI->db->set('product_mrp', $product_mrp);
        }
        if ($product_expire_month != null) {
            $CI->db->set('product_expire_month', $product_expire_month);
        }
        if ($product_expire_year != null) {
            $CI->db->set('product_expire_year', $product_expire_year);
        }
        $CI->db->insert('product_stocks');
    }
    #$CI->db->query('delete from product_stocks where product_loose_stock <= 0 && product_strip_stock <= 0');
}

function product_stock_overview(){
	?>
	<div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-bell"></i>Entry Error Report</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-bordewhite table-striped">
                <thead>
                    <tr>
                        <th>Labels</th>
                        <th>Number Count</th>
                    </tr>
					  
					</thead>
                <tbody>
				<tr>
						<td>Storeage Not Assigned</td>
						<td><a href="/console/product/storage_unassigned"><button><?=product_error_storage()?></button></a></td>
					</tr>
					<tr>
						<td>Expiry date error</td>
						<td><a href="/console/product_stock/expired"><button><?=product_error_expire_date()?></button></a></td>
					</tr> 
                                        <tr>
						<td>Zero or Negative Stock error</td>
						<td><a href="/console/product_stock/zeronegetive"><button><?=product_error_zeronegetive()?></button></a></td>
					</tr> 

					<tr>
						<td>Duplicate Entry</td>
						<td><a href="/console/product/duplicate"><button><?=duplicate()?></button></a></td>
					</tr> 
					<tr>
						<td><span  class="label label-important">Unit not assigned</span></td>
						<td><a href="/console/product/no_unit"><button class="btn btn-danger"><?=no_unit()?></button></a></td>
					</tr>	
					<tr>
						<td>Error In Sale Entry</td>
						<td>Counting...</td>
					</tr>							
				</tbody>
            </table>
		</div>
	</div>		
<?}
register_hook('product_overview', 'dashboard');
register_hook('product_stock_overview', 'dashboard');