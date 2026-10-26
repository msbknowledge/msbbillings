<?php
function medicine_count() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT DISTINCT count(medicine_name) as medicine_count FROM medicines')->result_array();
    return $count;
}
function no_unit(){
	 $CI = &get_instance();
    return count($CI->medicines_model->no_unit());

}
function medicine_error_expire_date() {
    $CI = &get_instance();
    $count = count($CI->db->query('select medicines.*, medicine_stocks.* from medicine_stocks join medicines on medicine_stock_medicine = medicine_id where medicine_expire_year = 0 and medicine_expire_month =0 order by medicine_expire_year asc,medicine_expire_month asc')->result_array());
    return $count;
}
function medicine_error_storage() {
    $CI = &get_instance();
    return count($CI->medicines_model->get_list(array('medicine_storage'=>'')));;
}
function duplicate(){
	 $CI = &get_instance();
    return count( $CI->medicines_model->duplicate());
}

function total_sale_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(sale_total) as sale FROM `sales` WHERE sale_date=CURRENT_DATE')->result_array();
    return $count;
}
function expiring() {
    $CI = &get_instance();
    //$count = count($CI->medicine_stocks_model->expire());
    return $count;
}
function expired() {
    $CI = &get_instance();
    //$count = count($CI->medicine_stocks_model->expire(true));
    //return $count;
}
function medicine_error_zeronegetive() {
    $CI = &get_instance();
    $count = count($CI->medicine_stocks_model->zeronegetive());
    //$count =0;
    return $count;
}
function shortage() {
    $CI = &get_instance();
    //$count = count($CI->medicine_stocks_model->shortage());
    //return $count;
}
function total_purchase_today() {
    $CI = &get_instance();
    $count = $CI->db->query('SELECT SUM(purchase_total) as purchase FROM `purchases` WHERE purchase_date=CURRENT_DATE')->result_array();
    return $count;
}

function generate_invoice_number() {
    $invoice_last_count = (int) get_option('invoice_last_count') + 1;
    $inovice_number = get_option('invoice_number');
    return str_ireplace(array('[{number}]', '[{year}]'), array(sprintf('%05d', $invoice_last_count), date('Y')), $inovice_number);
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

function medicine_overview() {
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
                            <span class="label">Effective Medicine Added In Store</span>
                        </td>
                        <td>
                                <span class="label"> <?php
                                    $medicine_count = medicine_count();
                                    if (empty($medicine_count[0]['medicine_count'])) {
                                        echo 'N/A';
                                    } else {
                                        echo $medicine_count[0]['medicine_count'];
                                    }
                                    ?></span>
                        </td>

                    </tr>
					 <tr>
                        <td>
                            <span class="label label-info">Simplebilling Medicine Database</span>
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
                            <a href="/console/medicine_stock/expiring">
							<button class="btn btn-success">
                              Click To check upcoming Expire
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
                            <a href="/console/medicine_stock/expired">
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
                            <a href="/console/medicine_stock/shortage">
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

function medicine_stock_update($medicine_batch, $medicine_id, $medicine_strip_stock,$medicine_loose_stock=0, $type = "+", $medicine_mrp = null, $medicine_expire_month = null, $medicine_expire_year = null) {
    /*$CI = &get_instance();
    $CI->db->set('medicine_strip_stock', "medicine_strip_stock $type $medicine_strip_stock", FALSE);
    $CI->db->set('medicine_loose_stock', "medicine_loose_stock $type $medicine_loose_stock", FALSE);
    if ($medicine_mrp != null) {
        $CI->db->set('medicine_mrp', $medicine_mrp);
    }
    if ($medicine_expire_month != null) {
        $CI->db->set('medicine_expire_month', $medicine_expire_month);
    }
    if ($medicine_expire_year != null) {
        $CI->db->set('medicine_expire_year', $medicine_expire_year);
    }
    $CI->db->where(array('medicine_stock_medicine' => $medicine_id, 'medicine_stock_batch' => $medicine_batch));
    $CI->db->update('medicine_stocks');
    if ($CI->db->affected_rows() == 0) {
        $CI->db->set('medicine_strip_stock', "medicine_strip_stock $type $medicine_strip_stock", FALSE);
        $CI->db->set('medicine_loose_stock', "medicine_loose_stock $type $medicine_loose_stock", FALSE);
        $CI->db->set('medicine_stock_medicine', $medicine_id);
        $CI->db->set('medicine_stock_batch', $medicine_batch);
        if ($medicine_mrp != null) {
            $CI->db->set('medicine_mrp', $medicine_mrp);
        }
        if ($medicine_expire_month != null) {
            $CI->db->set('medicine_expire_month', $medicine_expire_month);
        }
        if ($medicine_expire_year != null) {
            $CI->db->set('medicine_expire_year', $medicine_expire_year);
        }
        $CI->db->insert('medicine_stocks');
    }
    #$CI->db->query('delete from medicine_stocks where medicine_loose_stock <= 0 && medicine_strip_stock <= 0');
    */
}
function medicine_js(){
?>
<script>
localStorage.setItem("bla","bla")
function get_expired_medicine(){
alert("Down for maintainence");
}
//get_expired_medicine();
/*****************/
function get_unique_medicine(){
$.post("/console/medicine_stock/get_unique_medicine_id",function(){

})
}

</script>
<?}
function medicine_stock_overview(){
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
						<td><a href="/console/medicine/storage_unassigned"><button><?=medicine_error_storage()?></button></a></td>
					</tr>
					<tr>
						<td>Expiry date error</td>
						<td><a href="/console/medicine_stock/expired"><button><?=medicine_error_expire_date()?></button></a></td>
					</tr> 
                                        <tr>
						<td>Zero or Negative Stock error</td>
						<td><a href="/console/medicine_stock/zeronegetive"><button><?=medicine_error_zeronegetive()?></button></a></td>
					</tr> 

					<tr>
						<td>Duplicate Entry</td>
						<td><a href="/console/medicine/duplicate"><button><?=duplicate()?></button></a></td>
					</tr> 
					<tr>
						<td><span  class="label label-important">Unit not assigned</span></td>
						<td><a href="/console/medicine/no_unit"><button class="btn btn-danger"><?=no_unit()?></button></a></td>
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
register_hook('medicine_overview', 'dashboard');
register_hook('medicine_stock_overview', 'dashboard');
register_hook('medicine_js', 'dashboard');

