<?php
function medicine_reminder() {
    $CI = get_instance();
    $count = $CI->db->query('SELECT sale_date,customer_address,customer_name,customer_contact FROM sales join customers on customer_ID = sale_customer')->result_array();
    return $count;
}
function medicine_count() {
    $CI = get_instance();
    $count = $CI->db->query('SELECT DISTINCT count(medicine_name) as medicine_count FROM medicines')->result_array();
    return $count;
}
function no_unit(){
	 $CI = get_instance();
    return count($CI->medicines_model->no_unit());

}
function medicine_error_expire_date() {
    $CI = get_instance();
    $count = count($CI->db->query('select medicines.*, medicine_stocks.* from medicine_stocks join medicines on medicine_stock_medicine = medicine_id where medicine_expire_year = 0 and medicine_expire_month =0 order by medicine_expire_year asc,medicine_expire_month asc')->result_array());
    return $count;
}
function medicine_error_storage() {
    $CI = get_instance();
    return count($CI->medicines_model->get_list(array('medicine_storage'=>'')));;
}
function duplicate(){
	 $CI = get_instance();
    return count( $CI->medicines_model->duplicate());
}

function total_sale_today() {
    $CI = get_instance();
    $count = $CI->db->query('SELECT SUM(sale_total) as sale FROM `sales` WHERE DATE_FORMAT(sale_date, "%Y-%m-%d") = CURRENT_DATE')->result_array();
    return $count;
}
function expiring() {
    $CI = get_instance();
    //$count = count($CI->medicine_stocks_model->expire());
    return $count;
}
function expired() {
    $CI = get_instance();
    //$count = count($CI->medicine_stocks_model->expire(true));
    //return $count;
}
function medicine_error_zeronegetive() {
    $CI = get_instance();
    $count = count($CI->medicine_stocks_model->zeronegetive());
    //$count =0;
    return $count;
}
function shortage() {
    $CI = get_instance();
    //$count = count($CI->medicine_stocks_model->shortage());
    //return $count;
}
function total_purchase_today() {
    $CI = get_instance();
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
    <?php
    $medicine_reminder = medicine_reminder();
    if (!empty($medicine_reminder)) {
        foreach($medicine_reminder as $files){
            $date1 = date("Y-m-d",strtotime($files['sale_date']));
            $date2 = date("Y-m-d",strtotime('+1 day'));
            
            if($files['sale_date']==$date2){
                echo '<div class="dashalert alert alert-success alert-dismissible" role="alert" style="border-radius: 8px; margin-bottom: 15px; font-weight: 600;">
                <button type="button" class="alertclose close close_notice" data-dismiss="alert" aria-label="Close" data-noticeid="138"><span aria-hidden="true">&times;</span></button>
                <a href="" style="color: #065f46;"><i class="fa fa-bell"></i> Patient Reminder: '.$files['sale_date'].' - '. $files['customer_name'].' - '. $files['customer_address'].' - '. $files['customer_contact'].'</a>
                </div>';
            }
        }
    }
    ?>

    <div class="col-lg-6 col-md-6 col-sm-12 mb20">
        <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden;">
            <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #fafafa;">
                <h4 style="margin: 0; font-weight: 700; font-size: 15px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-hospital-o text-success"></i> Store Operations Overview
                </h4>
                <span class="badge" style="background: #ecfdf5; color: #059669; font-weight: 600; padding: 4px 10px; border: 1px solid #a7f3d0;">
                    <i class="fa fa-check-circle text-success"></i> Active
                </span>
            </div>
            <div style="padding: 12px 20px;">
                <table class="table" style="margin-bottom: 0;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-medkit text-primary" style="margin-right: 8px;"></i> Effective Medicine Added In Store
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <span class="label label-default" style="background-color: #0f172a !important; color: #ffffff !important; font-size: 13px !important; font-weight: 700 !important; padding: 5px 12px !important; border-radius: 6px;">
                                    <?php
                                    $medicine_count = medicine_count();
                                    echo empty($medicine_count[0]['medicine_count']) ? '0' : number_format((float)$medicine_count[0]['medicine_count']);
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-database text-info" style="margin-right: 8px;"></i> msbbilling Medicine Database
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <span class="label label-info" style="background-color: #0284c7 !important; color: #ffffff !important; font-size: 12px !important; font-weight: 700 !important; padding: 4px 10px !important; border-radius: 6px;">
                                    4 Lakh+
                                </span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-line-chart text-success" style="margin-right: 8px;"></i> Total Sale of the day
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <span class="label label-default" style="background-color: #047857 !important; color: #ffffff !important; font-size: 13px !important; font-weight: 700 !important; padding: 5px 12px !important; border-radius: 6px;">
                                    Rs: <?php
                                    $sale_count = total_sale_today();
                                    echo empty($sale_count[0]['sale']) ? '0.00' : number_format((float)$sale_count[0]['sale'], 2);
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-shopping-bag text-info" style="margin-right: 8px;"></i> Total Purchase of the day
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <span class="label label-default" style="background-color: #0369a1 !important; color: #ffffff !important; font-size: 13px !important; font-weight: 700 !important; padding: 5px 12px !important; border-radius: 6px;">
                                    Rs: <?php
                                    $purchase_count = total_purchase_today();
                                    echo empty($purchase_count[0]['purchase']) ? '0.00' : number_format((float)$purchase_count[0]['purchase'], 2);
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-clock-o text-warning" style="margin-right: 8px;"></i> Upcoming Expire
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine_stock/expiring_view') ?>" class="btn btn-xs" style="background: #f59e0b; color: #fff; font-weight: 600; border-radius: 4px; padding: 4px 10px;">
                                    <i class="fa fa-eye"></i> Check Upcoming Expire
                                </a>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-ban text-danger" style="margin-right: 8px;"></i> Expired Stock
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine_stock/expired_view') ?>" class="btn btn-xs btn-danger" style="font-weight: 600; border-radius: 4px; padding: 4px 10px;">
                                    <i class="fa fa-exclamation-circle"></i> Check Expired
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-cubes text-info" style="margin-right: 8px;"></i> Stock Shortage (&lt; 3 Units)
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine_stock/shortage_view') ?>" class="btn btn-xs btn-default" style="font-weight: 600; border-radius: 4px; padding: 4px 10px; border: 1px solid #cbd5e1; color: #334155;">
                                    <i class="fa fa-list"></i> Check Shortage
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <div class="col-lg-6 col-md-6 col-sm-12 mb20">
        <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden;">
            <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #fafafa;">
                <h4 style="margin: 0; font-weight: 700; font-size: 15px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-shield text-danger"></i> Entry Audit & Error Report
                </h4>
                <span class="badge" style="background: #fef2f2; color: #dc2626; font-weight: 600; padding: 4px 10px; border: 1px solid #fecaca;">
                    <i class="fa fa-bell-o text-danger"></i> Audit System
                </span>
            </div>
            <div style="padding: 12px 20px;">
                <table class="table" style="margin-bottom: 0;">
                    <tbody>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-folder-open-o text-warning" style="margin-right: 8px;"></i> Storage Rack Not Assigned
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine/storage_unassigned') ?>">
                                    <span class="label label-warning" style="background-color: #f59e0b !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                        <?= medicine_error_storage() ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-calendar-times-o text-danger" style="margin-right: 8px;"></i> Expiry Date Error
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine_stock/expired_view') ?>">
                                    <span class="label label-danger" style="background-color: #ef4444 !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                        <?= medicine_error_expire_date() ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-minus-circle text-danger" style="margin-right: 8px;"></i> Zero or Negative Stock Error
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine_stock/zeronegetive') ?>">
                                    <span class="label label-danger" style="background-color: #ef4444 !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                        <?= medicine_error_zeronegetive() ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-clone text-info" style="margin-right: 8px;"></i> Duplicate Entry Detection
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine/duplicate') ?>">
                                    <span class="label label-info" style="background-color: #0284c7 !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                        <?= duplicate() ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-tag text-danger" style="margin-right: 8px;"></i> Unit Not Assigned
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <a href="<?= console_url('medicine/no_unit') ?>">
                                    <span class="label label-danger" style="background-color: #ef4444 !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                        <?= no_unit() ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 12px 0; font-weight: 600; color: #334155; vertical-align: middle;">
                                <i class="fa fa-check-square-o text-success" style="margin-right: 8px;"></i> Sale Entry Integrity
                            </td>
                            <td style="padding: 12px 0; text-align: right; vertical-align: middle;">
                                <span class="label label-success" style="background-color: #10b981 !important; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                    <i class="fa fa-check"></i> Audit Clear
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}
register_hook('medicine_overview', 'dashboard');
register_hook('medicine_stock_overview', 'dashboard');
register_hook('medicine_js', 'dashboard');

