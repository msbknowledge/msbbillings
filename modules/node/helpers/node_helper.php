<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* $CI = &get_instance();

  pr($CI->current_user_session); */

function invoice_period_generate() {
    $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $years = array('19','18', '17','16');
    $output_array = null;
    foreach ($years as $year) {
        foreach ($month_names as $month) {

            $output_array[$month . '-' . $year] = $month . '-' . $year;
        }
    }
    return $output_array;
}

function widget_start() {
    ob_start();
    ?>
    <div class="row-fluid sortable">
        <?php
        return ob_get_clean();
    }

    function widget_end() {
        ob_start();
        ?>
    </div>
    <?php
    return ob_get_clean();
}

/* * *****************
  set widget
 * ****************** *///
//set_widget('widget_start','dashboard');
//set_widget('widget_end','dashboard');

function widget_verview() {
    ?>

    <div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-bell"></i>Cable Overview</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-bordered table-striped">

                <tbody>
                    <tr>
                        <td>
                            <span class="label">Customers</span>
                        </td>
                        <td>
                            <a target="_blank" href="<?= console_url('customer/inactive_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ban-circle"></i>Inactive: <?= boxCount(array('customer_status' => 0)) ?></button></a>
                            <a target="_blank" href="<?= console_url('customer/active_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ok-circle"></i>Active:  <?= boxCount(array('customer_status' => 1)) ?></button></a>
                            <a target="_blank" href="<?= console_url('customer/all_customer') ?>"><button class="btn btn-info xt"> <i class="icon-info-sign"></i>Total: <?= boxCount() ?></button></a>
                        </td>
                    </tr>

                    <!--tr>
                        <td><span class="label label-success">Packages</span></td>
                        <td class="">
                            <?
                            $package_subscriber = package_subscriber();

                            if (!empty($package_subscriber))
                                foreach ($package_subscriber as $key => $value):
                                    ?>
                                    <a class="" target="_blank" href="<?= console_url('customer/package_customer/?package=' . $key) ?>" style="display:block; float: left;margin:2px">
                                        <button class="btn btn-info xt">
                                            <i class="icon-list-alt"></i> <?php
                                            $pack = package_name($key);
                                            echo $pack[0]['package_name'];
                                            ?> : <?= $value ?>
                                        </button>
                                    </a>
                                <? endforeach; ?>
                        </td>
                    </tr--->
                    <tr>
                        <td><span class="label label-success">STB Type</span></td>
                        <?
                        $stbs = stb_by_type();
                        ?>
                        <td>
                            <? foreach ($stbs as $value) { ?>
                                <span class="label"><?= $value['stb_type'] ?></span> : <?= $value['total'] ?>

                            <? } ?>
                        </td>

                    </tr>
                    <tr>
                        <td><span class="label label-success">STB MSO</span></td>
                        <td>
                            <?
                            $stbs = stb_by_mso();
                            ?><?
                            foreach ($stbs as $value) {
                                if (empty($value['stb_mso'])) {
                                    $value['stb_mso'] = 'UnSet';
                                }
                                ?>
                                <span class="label"><?= $value['stb_mso'] ?></span> : <?= $value['total'] ?>

                            <? } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="label label-warning">Collection</span></td>
                        <td>Today: Rs <?= totalCollectedToday(); ?>/- | This Month: Rs <?= totalCollectedThisMonth(); ?>/- | This Year: Rs <?= totalCollectedThisYear(); ?>/-</td>
                    </tr>
                    <?php $CI = &get_instance();
                    
                    if($CI->current_user_session['user_login']=='admin'){ ?>
                    <tr>
                        <td><span class="label label-info">Billed</span></td>
                        <td>Today: Rs <?= totalInvoicedToday(); ?>/- | This Month: Rs <?= totalInvoicedThisMonth(); ?>/- | This Year: Rs <?= totalInvoicedThisYear(); ?>/-</td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td><span class="label label-info">Complains</span></td>
                        <td> By Service:                         <?
                            $complain = complain_by_service();
                            ?><?
                            foreach ($complain as $value) {
                                if (empty($value['complain_service'])) {
                                    $value['complain_service'] = 'UnSet';
                                }
                                ?>
                                <span class="label"><?= $value['complain_service'] ?></span> : <?= $value['total'] ?>

                            <? } ?>
                            | By Status:
                            <?
                            $complain = complain_by_status();
                            ?><?
                            foreach ($complain as $value) {
                                if (empty($value['complain_status'])) {
                                    $value['complain_status'] = 'UnSet';
                                }
                                ?>
                                <span class="label <?
                                if ($value['complain_status'] == 'new') {
                                    echo "label-important";
                                }
                                if ($value['complain_status'] == 'assign') {
                                    echo "label-warning";
                                }
                                if ($value['complain_status'] == 'resolved') {
                                    echo "label-success";
                                }
                                ?>"><?= $value['complain_status'] ?></span> : <?= $value['total'] ?>

                            <? } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

    <?php
}

function widget_notification() {
    ob_start();
    ?>
    <div class="box span4">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-bullhorn"></i>Notification</h2>
            <div class="box-icon">


                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">

        </div>
    </div>
    <?php
    return ob_get_clean();
}

function widget_system_graph() {
    ob_start();
    ?>
    <div class="box span4">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-list-alt"></i> Realtime</h2>
            <div class="box-icon">


                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div id="realtimechart" style="height:190px;"></div>
            <p>You can update a chart periodically to get a real-time effect by using a timer to insert the new data in the plot and redraw it.</p>
            <p>Time between updates: <input id="updateInterval" type="text" value="" style="text-align: right; width:5em"> milliseconds</p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function widget_whatsnew() {
    ob_start();
    ?>
    <div class="box span6">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-gift"></i> Whats New</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>
                    <img src="data:image/gif;base64,R0lGODlhGQALAJEAAP////9mM////wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFHgACACwAAAAAGQALAAACI4yPqcvt/4AEZxoZMEaa9uyFyTeRIiduFQUqH7jFLETX9r0UACH5BAUeAAIALAIAAwAUAAUAAAIIjI+py+0PYysAIfkECR4AAgAsAAAAABkACwAAAiOUj6nL7f+ABGcaKTBGmvbshck3kSInbhUFKh+4xSxE1/a9FAA7"/>

                    Software Version:3.9.1!</strong> <br/>New Software Updates are installed!!<br/> Improve Speed and Better Security!!
            </div>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>
                    <img src="data:image/gif;base64,R0lGODlhGQALAJEAAP////9mM////wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFHgACACwAAAAAGQALAAACI4yPqcvt/4AEZxoZMEaa9uyFyTeRIiduFQUqH7jFLETX9r0UACH5BAUeAAIALAIAAwAUAAUAAAIIjI+py+0PYysAIfkECR4AAgAsAAAAABkACwAAAiOUj6nL7f+ABGcaKTBGmvbshck3kSInbhUFKh+4xSxE1/a9FAA7"/>

                    Suggestions Are Invited</strong><br/>We would like to introduce Internet Packages,Thus need your suggestions. Please mail your suggestions at mail@kallol.net or 9903700769.<br/>

            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function boxCount($condition = NULL) {
    $CI = &get_instance();
    return $CI->customers_model->count_total($condition);
}

function invoice_period_difference($start, $end) {
    $start = strtotime(str_ireplace('-', '-20', $start));
    $end = strtotime(str_ireplace('-', '-20', $end));

    $year1 = date('Y', $start);
    $year2 = date('Y', $end);

    $month1 = date('m', $start);
    $month2 = date('m', $end);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff;
}

function totalBilled($invoice_period = NULL) {
    $CI = &get_instance();
    return $CI->invoices_model->total_billed_amount($invoice_period);
}

function stb_by_type() {
    $CI = &get_instance();
    return $CI->db->query('select stb_type,count(*) as total from stbs group by stb_type')->result_array();
}

function complain_by_status() {
    $CI = &get_instance();
    return $CI->db->query('select complain_status,count(*) as total from complains group by complain_status')->result_array();
}

function complain_by_service() {
    $CI = &get_instance();
    return $CI->db->query('select complain_service,count(*) as total from complains group by complain_service')->result_array();
}

function stb_by_mso() {
    $CI = &get_instance();
    return $CI->db->query('select stb_mso,count(*) as total from stbs group by stb_mso')->result_array();
}

function netDue($condition = NULL) {
    $CI = &get_instance();
    return $CI->invoices_model->total_due_amount($condition);
}

function package_name($id) {
    if ($id != 'Unset') {
        $CI = &get_instance();
        $pack = $CI->db->query('select package_name from packages where package_ID=' . $id)->result_array();
    } else {
        $pack[0]['package_name'] = $id;
    }
    return $pack;
}

function package_subscriber() {
    $CI = &get_instance();
    $subscribed = $CI->db->query('SELECT customer_package,count(*) as count FROM customers where customer_status = 1 group by customer_package ');
    $subscribedPackages = $subscribed->result_array();
    $packStatus = null;
    foreach ($subscribedPackages as $key => $value) {
        $packageId = json_decode($value['customer_package'], TRUE);
        $packages = $CI->packages_model->get_list_for_dropdown('package_ID', array('package_ID' => @$packageId[0]));
        $packages = array_values($packages);
        $packStatus[isset($packages[0]) ? $packages[0] : 'Unset'] = $value['count'];
    }

    /*     * ********unset***** */
    $packages = $CI->packages_model->get_list_for_dropdown('package_ID');
    $packagelist = '';
    $condition = array('customer_status' => 1, 'customer_package' => '');
    foreach ($packages as $package_ID => $pack) {
        $packagelist[] = "'[\"$package_ID\"]'";
    }
    $packagelist = implode(',', $packagelist);
    if (!empty($packagelist)) {
        $sql = $CI->db->query('select count(*) as unset from customers where customer_package not in(' . $packagelist . ')');
        $allData = $sql->result_array();
        if ($allData[0]['unset'] > 0) {
            $packStatus['Unset'] = $allData[0]['unset'];
        }
        return $packStatus;
    }
}

function netCollected($condition = NULL) {
    
}

function totalCollectedToday() {
    $CI = &get_instance();
    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date = "' . date('Y-m-d') . '" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date = "' . date('Y-m-d') . '"')->result_array();
    }
    /*     * ****** */
    //$total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date = "' . date('Y-m-d') . '"')->result_array();
    return (float) $total[0]['total'];
}

function totalCollectedThisMonth() {
    $CI = &get_instance();
    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-m-') . '%" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-m-') . '%"')->result_array();
    }
    /*     * ****** */



    //$total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-m-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function totalCollectedThisYear() {
    $CI = &get_instance();

    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-') . '%" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-') . '%"')->result_array();
    }
    /*     * ****** */

    // $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `collections` WHERE collection_date like "' . date('Y-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function totalInvoicedToday() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `invoices` WHERE invoice_date = "' . date('Y-m-d') . '"')->result_array();
    return (float) $total[0]['total'];
}

function totalInvoicedThisMonth() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `invoices` WHERE invoice_date like "' . date('Y-m-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function totalInvoicedThisYear() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `invoices` WHERE invoice_date like "' . date('Y-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

/* * *
 *
 * the master billing
 *
 * * */

function generate_invoice($customerID = NULL, $invoiceDate = NULL) {


    if (strpos($invoiceDate, '-')) {
        $invoiceDate = str_ireplace('-', ' 20', $invoiceDate);
    }
    #pr($invoiceDate,1);


    $ci = &get_instance();
    if ($customerID == NULL) {
        return;
    }
    /*     * *********get last month invoice data************************ */
    $lastInvoiceData = $ci->invoices_model->get_list(array('invoice_customer' => $customerID), NULL, null, 0, null, 'invoice_ID desc');

    $deferanceMonth = 0;
    if ($invoiceDate == NULL)
        $invoiceDate = date('F', time()) . '-' . Date('y', time());
    /*     * *******CURRENT INVOICE(DEFAULT CURRENT MONTH)*********** */
    $invoicePeriod = date('F', strtotime($invoiceDate)) . '-' . Date('y', strtotime($invoiceDate));

    //pr($invoicePeriod);
    /*     * ***********ONE MONTH PREVIOUS INVOICE MONTH WAS************************** */
    if (!empty($lastInvoiceData[0])) {
        $deferanceMonth = invoice_period_difference($lastInvoiceData[0]['invoice_period'], $invoicePeriod);
    }

    if (intval($deferanceMonth) < 0) {
        $invoiceDate = strtotime($lastInvoiceData[0]['invoice_date']);
        $invoicePeriod = date('F', strtotime(date('Y-m-d', $invoiceDate))) . '-' . Date('y', $invoiceDate);
        $deferanceMonth = 0;
    }
    /*     * *GENERATE ON SPECIFIC TIME OR DEFAULT TIME********************* */

    /*     * ***INITIALISING DATA WITH NULL, HERE ALL DATA WILL BE GENERATE************* */
    $completeData = NULL;
    /*     * **complete customer data**** */
    $customerData = $ci->customers_model->get_list(array('customer_ID' => $customerID));

    /*     * *******************************************calculation logic************************************************************************************ */
    /*     * **override meta correction[!!!ATTENTION OLD DATA CAN CAUSE ERROR ]************ */
    $lastInvoiceFullData = array_merge($lastInvoiceData[0], json_decode($lastInvoiceData[0]['invoice_meta'], true));
    /*     * ***0-30 days approx its for billing due date******** */
    $gressPeriod = get_option('gress_period');

    /*     * ******basig invoice code generation******** */
    #$customerData[0]['invoiceNo'] = get_option('invoice_prefix') . '-' . Date('Y', $invoiceDate) . '-' . Date('M', $invoiceDate) . '-' . $customerData[0]['customer_ID'];
    $customerData[0]['invoiceNo'] = invoice_pattern($customerData[0]['customer_ID'], $invoiceDate);
    /*     * **********curreent date/ invoicing date*********** */
    $customerData[0]['invoice_due_amount'] = 0.00;
    $customerData[0]['invoice_date'] = date('d-F-Y');
    $customerData[0]['invoice_period'] = $invoicePeriod;
    if ($deferanceMonth == 0) {
        $customerData[0]['invoice_paid_amount'] = isset($lastInvoiceFullData['invoice_paid_amount']) ? $lastInvoiceFullData['invoice_paid_amount'] : 0.00;
        $customerData[0]['discount'] = isset($lastInvoiceFullData['discount']) ? $lastInvoiceFullData['discount'] : 0.00;
    } else {
        $customerData[0]['discount'] = 0.00;
        $customerData[0]['invoice_paid_amount'] = 0.00;
    }

    /*     * *******customer is activated on********** */
    $activationDate = strtotime($customerData[0]['customer_activation_date']);
    $timediff = floor((abs($invoiceDate - $activationDate) / (60 * 60 * 24)) / 30) * 30;
    $invoicePeriodStart = $timediff;

    $customerData[0]['customer_service_start_date'] = Date('Y-m-d', strtotime("+$invoicePeriodStart days", strtotime($customerData[0]['customer_activation_date'])));
    $customerData[0]['customer_service_end_date'] = Date('Y-m-d', strtotime("+30 days", strtotime($customerData[0]['customer_service_start_date'])));
    $customerData[0]['customer_invoice_for_month'] = $invoicePeriod;
    $customerData[0]['customer_due_date'] = Date('Y-m-d', strtotime("+$gressPeriod days", time()));

  $packages = json_decode($customerData[0]['customer_package'], 'true');
  $packages = $ci->packages_model->get_list_in(array('package_ID' => $packages));
    $completeData['package_price'] = $packages[0]['package_rate'];
    $adons = json_decode($customerData[0]['customer_adons'], 'true');
    if (!empty($adons))
        $adons = $ci->channels_model->get_list_in(array('channel_ID' => $adons));
   $completeData = array_merge($customerData[0], array('packages' => $packages), array('package_price' => $packages[0]['package_rate']));
    $adon_price = 0.0;
    foreach ($adons as $key => $value) {
        $adon_price += $value['channel_price'];
    }
    $completeData = array_merge($completeData, array('adons' => $adons), array('adon_price' => $adon_price));
    $completeData['subtotal'] = $completeData['package_price'] + $completeData['adon_price'];
    $completeData = array_merge($completeData, $ci->taxes_model->calulate_tax($completeData['subtotal']));
    /*     * *******special updates********** */
    $lastDue = isset($lastInvoiceData[0]['invoice_due_amount']) ? $lastInvoiceData[0]['invoice_due_amount'] : 0.00;
    $lastAdvance = isset($lastInvoiceData[0]['invoice_advance_amount']) ? $lastInvoiceData[0]['invoice_advance_amount'] : 0.00;
    $previousBalance = $lastDue - $lastAdvance;
    $recurranceBill = $completeData['round'];
    $recurrancePayable = ($deferanceMonth * $recurranceBill) + $previousBalance;
    $recurranceDue = $recurrancePayable - $recurranceBill;

    if ($deferanceMonth > 0) {
        if ($recurranceDue >= 0) {
            $customerData[0]['invoice_previous_due_amount'] = $recurranceDue;
            $completeData['invoice_due_amount'] = $recurranceDue;
            $completeData['invoice_previous_due_amount'] = $recurranceDue;
            $completeData['invoice_advance_amount'] = 0.00;
            $completeData['invoice_previous_advance_amount'] = 0.00;
        } else {
            $customerData[0]['invoice_previous_advance_amount'] = -$recurranceDue;
            $completeData['invoice_due_amount'] = 0;
            $completeData['invoice_advance_amount'] = -$recurranceDue;
            $completeData['invoice_previous_due_amount'] = 0.00;
            $completeData['invoice_previous_advance_amount'] = - $recurranceDue;
        }
    } else {
        $completeData['invoice_due_amount'] = 0.00;
        $completeData['invoice_previous_due_amount'] = 0.00;
        $completeData['invoice_advance_amount'] = 0.00;
        $completeData['invoice_previous_advance_amount'] = 0.00;
    }
    /*     * **special updates********** */

    /*     * *****check if previous invoice is available for current month then add current else full**************** */
    if (!empty($lastInvoiceData[0]['invoice_meta']) && $deferanceMonth == 0) {
        $completeData['invoice_due_amount'] = $lastInvoiceFullData['invoice_due_amount'];
        $completeData['invoice_previous_due_amount'] = $lastInvoiceFullData['invoice_previous_due_amount'];
        $completeData['invoice_advance_amount'] = $lastInvoiceFullData['invoice_advance_amount'];
        $completeData['invoice_previous_advance_amount'] = $lastInvoiceFullData['invoice_previous_advance_amount'];

        $completeData = array_merge($completeData, array('total_with_previous_due' => $lastInvoiceData[0]['invoice_previous_due_amount'] - $lastInvoiceData[0]['invoice_previous_advance_amount']));
    } else {
        $completeData = array_merge($completeData, array('total_with_previous_due' => $customerData[0]['invoice_previous_due_amount'] - $customerData[0]['invoice_previous_advance_amount'] + round($completeData['total'])));
    }

    if ($deferanceMonth == 0)
        $completeData['invoice_billed_amount'] = isset($lastInvoiceData[0]['invoice_billed_amount']) ? $lastInvoiceData[0]['invoice_billed_amount'] : $completeData['total_with_previous_due'];
    else
        $completeData['invoice_billed_amount'] = $completeData['total_with_previous_due'];
    if ($lastInvoiceData[0]['invoice_paid_amount'] != 0 && $deferanceMonth == 0) {
        $completeData['invoice_payable_amount'] = $lastInvoiceFullData['invoice_due_amount'];
    } else {
        $completeData['invoice_payable_amount'] = $completeData['invoice_billed_amount'];
    }
    /*     * **by koushik** */
    $already_paid = $ci->db->query("SELECT SUM(invoice_paid_amount) as paid FROM `invoices` WHERE invoice_period='" . $customerData[0]['invoice_period'] . "' and invoice_customer=" . $customerID)->result_array();
    $completeData['invoice_already_paid_amount'] = floatval($already_paid[0]['paid']);
    /*     * ***** */
    return $completeData;
}

/* * *
 * standard header script
 * ** */

function header_cable_script() {
    return 'header';
}

/* * *
 * standard footer script
 * ** */

function footer_cable_script() {
    return 'footer';
}
function generate_invoice_number() {
    $invoice_last_count = (int) get_option('invoice_last_count') + 1;
    $inovice_number = get_option('invoice_number');
    return str_ireplace(array('[{number}]', '[{year}]'), array(sprintf('%05d', $invoice_last_count), date('Y')), $inovice_number);
}
function increase_invoice_number() {
    set_option('invoice_last_count', 1 + (int) get_option('invoice_last_count'));
}

function invoice_pattern($invoice_customer, $invoiceDate) {
    $pattern = get_option('invoice_no_pattern');
    if (empty($pattern)) {
        set_option('invoice_no_pattern', '[{invoice_prefix}]-[{year}]-[{month}]-[{invoice_customer}]');
    }
    $serial = get_option('serial_no');
    $num_padded = sprintf("%04d", $serial);
    $prefix = get_option('invoice_prefix');
    #pr($pattern);
    $pattern_data = array('[{invoice_prefix}]' => $prefix,
        '[{year}]' => Date('y', $invoiceDate),
        '[{month}]' => Date('M', $invoiceDate),
        '[{date}]' => Date('d', $invoiceDate),
        '[{invoice_customer}]' => $invoice_customer,
        '[{serial_no}]' => $num_padded);
    return str_ireplace(array_keys($pattern_data), array_values($pattern_data), get_option('invoice_no_pattern'));
}

//register_hook('widget_verview', 'dashboard');
