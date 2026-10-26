<?php
$server_string = explode(".", $_SERVER['SERVER_NAME']);
$node = $server_string[0];

/* * ****aceeess of simplebillings*** */
$servername = "localhost";
$username = "simplebillings";
$password = "#logic#123";
$dbname = "simplebillings_" . $node;
// Create connection
$conn_simple = mysqli_connect($servername, $username, $password, $dbname);


/* * ****aceeess of cablebillings*** */
$_servername = "localhost";
$_username = "cable";
$_password = "u08HQKv9OX9stRpywsmT";
$_dbname = "cable_" . $node;
$conn_cable = mysqli_connect($_servername, $_username, $_password, $_dbname);



/* * ****fetch cable customer data*** */
$sql_cable_cust_data = "SELECT * FROM customers";
$result_cable_cust = mysqli_query($conn_cable, $sql_cable_cust_data);
//echo mysqli_num_rows($result);
if (mysqli_num_rows($result_cable_cust) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_cust)) {
        $cable_cust_data[] = $row;
    }
}

/* * *** */

/*
 * read invoice strip to invoce and collections 
 * **************** */

/* * **truncate customer table*** */
$sql_customer_truncate = "TRUNCATE TABLE `customers`";
mysqli_query($conn_simple, $sql_customer_truncate);
/* * ** */
/* * **truncate stb table*** */
$sql_stb_truncate = "TRUNCATE TABLE  `stbs`";
mysqli_query($conn_simple, $sql_stb_truncate);
/* * ** */
/* * ****
 * fetch stbs
 *  ********** */
$sql_stb = "SELECT distinct stb_no,vc_no FROM customers";
$result = mysqli_query($conn_cable, $sql_stb);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $sql_simple_stb_insert = "INSERT INTO"
                . " `stbs`("
                . "`stb_no`,`stb_vc`,`stb_type`) VALUES ('" . $row['stb_no'] . "','" . $row['vc_no'] . "','ASSIGNED')";
        mysqli_query($conn_simple, $sql_simple_stb_insert);
    }
}

/* * **truncate packages table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `packages`");
/* * ** */

/* * ****fetch cable packages data*** */
$sql_cable_pack_data = "SELECT * FROM `packages`";

$result_cable_pack = mysqli_query($conn_cable, $sql_cable_pack_data);
if (mysqli_num_rows($result_cable_pack) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_pack)) {
        $cable_result_pack_data[] = $row;
    }
}
//pr($cable_result_pack_data);
/* * **packages entry in simplebillings***** */

foreach ($cable_result_pack_data as $key => $val) {
    $sql_simple_package_data_insert = "INSERT INTO `packages`("
            . "`package_ID`,"
            . "`package_name`,"
            . " `package_rate`,"
            . "`package_cost_inclusive_tax`)"
            . " VALUES ('"
            . "" . $val['package_ID'] . "',"
            . "'" . $val['package_name'] . "',"
            . "'" . $val['package_rate'] . "'," . $val['package_cost_inclusive_tax'] . ")";

    mysqli_query($conn_simple, $sql_simple_package_data_insert);
}
/* * ***** */

/* * **truncate taxes table*** */
$sql_invoice_truncate = "TRUNCATE TABLE `taxes`";
mysqli_query($conn_simple, $sql_invoice_truncate);
/* * ** */

/* * ****fetch cable taxes data*** */
$sql_cable_tax_data = "SELECT * FROM taxes";
$result_cable_tax = mysqli_query($conn_cable, $sql_cable_tax_data);
if (mysqli_num_rows($result_cable_tax) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_tax)) {
        $cable_result_tax_data[] = $row;
    }
}

/* * **taxes entry in simplebillings***** */

foreach ($cable_result_tax_data as $key => $val) {
    $sql_simple_tax_data_insert = "INSERT INTO `taxes`(`tax_name`,"
            . " `tax_type`,"
            . "`tax_value`)"
            . " VALUES ('" . $val['tax_name'] . "','" . $val['tax_type'] . "','" . $val['tax_value'] . "')";


    mysqli_query($conn_simple, $sql_simple_tax_data_insert);
}
/* * ***** */
/* * **truncate channels table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `channels`");
/* * ** */

/* * ****fetch cable channels data*** */
$sql_cable_channel_data = "SELECT * FROM channels";

$result_cable_channel = mysqli_query($conn_cable, $sql_cable_channel_data);
if (mysqli_num_rows($result_cable_channel) > 0) {
    
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_channel)) {
        $cable_result_channel_data[] = $row;
    }
}
/* * **taxes entry in simplebillings***** */

foreach ($cable_result_channel_data as $key => $val) {
    $sql_simple_channel_data_insert = "INSERT INTO `channels`(`channel_ID`,"
            . " `channel_genre`,"
            . " `channel_broadcaster`,"
             . " `channel_name`,"
             . " `channel_type`,"
            . "`channel_price`)"
            . " VALUES ('" . $val['channel_ID'] . "','" . $val['channel_genre'] . "','" . $val['channel_broadcaster'] . "','" . $val['channel_name'] . "','" . $val['channel_type'] . "','" . $val['channel_price'] . "')";

//print_r($sql_simple_channel_data_insert);
 //echo $sql_simple_channel_data_insert;
//die();
    mysqli_query($conn_simple, $sql_simple_channel_data_insert);
}
/* * ***** */
/* * **truncate users table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `users`");
/* * ** */
/* * ****fetch cable users data*** */
$sql_cable_user_data = "SELECT * FROM users";
$result_cable_user = mysqli_query($conn_cable, $sql_cable_user_data);
if (mysqli_num_rows($result_cable_user) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_user)) {
        $cable_result_user_data[] = $row;
    }
}

/* * **user entry in simplebillings***** */

foreach ($cable_result_user_data as $key => $val) {
    $sql_simple_user_data_insert = "INSERT INTO `users`(`user_login`,"
            . " `user_pass`, "
            . "`user_firstname`, "
            . "`user_lastname`,"
            . "`user_email`,"
            . " `user_registered`, "
            . "`user_status`,"
            . " `user_type_id`,"
            . "`user_mobile`)"
            . " VALUES ('" . $val['user_login'] . "','" . $val['user_pass'] . "','" . $val['user_firstname'] . "','" . $val['user_lastname'] . "','" . $val['user_email'] . "','" .
            $val['user_registered'] . "'," . $val['user_status'] . ",'" . $val['user_type_id'] . "','" . $val['user_mobile'] . "')";


    mysqli_query($conn_simple, $sql_simple_user_data_insert);
}
/* * ***** */

/* * **prepare customer data and insert**** */
foreach ($cable_cust_data as $key => $val) {
    $searchStb = "SELECT `stb_ID` FROM `stbs` where stb_no='" . $val['stb_no'] . "'";
    $result = mysqli_query($conn_simple, $searchStb);
    $row = mysqli_fetch_assoc($result);
    $sql_simple_cust_data_insert = "INSERT INTO `customers`"
            . "(`customer_ID`,"
            . " `customer_code`, "
            . " `customer_name`, "
            . "`customer_address`, "
            . "`customer_contact`,"
            . " `customer_stb`, "
            . "`customer_activation_date`,"
            . " `customer_package`,"
            . " `customer_adons`, "
            . "`customer_area`,"
            . " `customer_status`,"
            . " `customer_deactivation_date`, "
            . "`customer_mso_account`, "
            . "`customer_due_date_of_month`)"
            . " VALUES ('" . $val['customer_ID'] . "','" . $val['customer_code'] . "','" . $val['customer_name'] . "','" . $val['customer_address'] . "','" . $val['customer_contact'] . "','" . $row['stb_ID'] . "','". $val['customer_activation_date'] . "','". $val['customer_package'] . "','". $val['customer_adons'] . "','" . $val['customer_area'] . "','" . $val['customer_status'] . "','" . $val['customer_deactivation_date'] . "','" . $val['customer_mso_account'] . "','" . $val['customer_due_date_of_month'] . "')";
    //print_r($cable_cust_data[0]);
   // echo $sql_simple_cust_data_insert;
   // die();
    mysqli_query($conn_simple, $sql_simple_cust_data_insert);
}
/* * **** */
/* * **truncate invoice table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `invoices`");
/* * ** */
/* * **truncate invoice table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `collections`");
/* * ** */
/* * ****fetch cable invoice data*** */
$sql_cable_invoice_paid_data = "SELECT * FROM `invoices` WHERE invoice_paid_amount > 0 AND invoice_period LIKE '%18'";
$sql_cable_invoice_bill_data = "SELECT * FROM `invoices` WHERE invoice_billed_amount >0 AND invoice_period LIKE '%18' group by invoice_period";
//print_r ( $sql_cable_invoice_bill_data);

$result_cable_invoice_paid_data = mysqli_query($conn_cable, $sql_cable_invoice_paid_data);
$result_cable_invoice_bill_data = mysqli_query($conn_cable, $sql_cable_invoice_bill_data);
if (mysqli_num_rows($result_cable_invoice_paid_data) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_invoice_paid_data)) {
        $cable_invoice_paid_data[] = $row;
    }
}
if (mysqli_num_rows($result_cable_invoice_bill_data) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_cable_invoice_bill_data)) {
        $cable_invoice_bill_data[] = $row;
    }
}




//print_r($cable_invoice_bill_data);
//die();


/* * ***invoice entry in simplebillings** */
foreach ($cable_invoice_bill_data as $key => $val) {
    //pr($cable_invoice_bill_data,1);
$invoice_meta['billing'][] = array('name'=>'Total Subscription Fee','cost'=>$val['invoice_billed_amount']);
$invoice_meta['total'] = $val['invoice_billed_amount'];
        
    $sql_simple_invoice_data_insert = "INSERT INTO `invoices`(`invoice_customer`,"
            . " `invoice_date`,"
            . " `invoice_for`,"
            . " `invoice_billed_amount`,"
            . " `invoice_tax_amount`, "
            . "`invoice_note`, "
            . "`invoice_entry_timestamp`, "
            . "`invoice_meta`) "
            . "VALUES ('" . $val['invoice_customer'] . "','" . $val['invoice_date'] . "','" . $val['invoice_period'] . "','" . $val['invoice_billed_amount'] . "','" . $val['invoice_tax_amount'] . "','" . 'migrated' . "','" . $val['invoice_entry_timestamp'] . "','" .$val['invoice_meta'] . "')";
    
    mysqli_query($conn_simple, $sql_simple_invoice_data_insert);
}
/* * *** */
//echo count($cable_invoice_paid_data);
/* * **collection entry in simplebillings*** */
foreach ($cable_invoice_paid_data as $key => $val) {
    $sql_simple_collection_data_insert = "INSERT INTO `collections`(`collection_collected_by`,"
            . " `collection_for`,"
            . " `collection_customer`, "
            . "`collection_date`,"
            . " `collection_amount`, "
            . " `collection_note`, "
            . "`collection_entry_timestamp`)"
            . " VALUES ('" . $val['invoice_collected_by'] . "','" . $val['invoice_period'] . "','" . $val['invoice_customer'] . "','" . $val['invoice_collection_date'] . "','" . $val['invoice_paid_amount'] . "','".'migrated'."','" . $val['collection_entry_timestamp'] . "')";
//print_r($sql_simple_collection_data_insert);
//die();
    mysqli_query($conn_simple, $sql_simple_collection_data_insert);
}
/****migret internet data***/
/*
/* * **truncate customer table*** */

mysqli_query($conn_simple, "TRUNCATE TABLE `internet_customers`");

/* * ****fetch internet customer data*** */
$sql_internet_cust_data = "SELECT * FROM internet_customers";
$result_internet_cust = mysqli_query($conn_cable, $sql_internet_cust_data);
//echo mysqli_num_rows($result);
if (mysqli_num_rows($result_internet_cust) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_internet_cust)) {
        $internet_cust_data[] = $row;
    }
}
 //print_r($internet_cust_data);
//die();
/* * **prepare customer data and insert**** */
foreach ($internet_cust_data as $key => $val) {
  //  $searchStb = "SELECT `stb_ID` FROM `stbs` where stb_no='" . $val['stb_no'] . "'";
    $result = mysqli_query($conn_simple);
    $row = mysqli_fetch_assoc($result);
    $sql_simple_cust_data_insert = "INSERT INTO `internet_customers`"
            . "(`customer_ID`,"
            . " `customer_name`, "
              . " `customer_ip`, "
            . "`customer_user_name`, "
            . "`customer_address`,"
            . " `customer_area`, "
            . "`customer_contact`,"
            . " `customer_package`,"
            . " `customer_code`, "
            . "`customer_isp_account`,"
              . "`customer_status`,"
            . " `customer_last_renew_date`,"
            . " `customer_activation_date`, "
            . "`customer_deactivation_date`, "
            . "`customer_is_free`)"
            . " VALUES ('" . $val['customer_ID'] . "','" . $val['customer_name'] . "','" . $val['customer_ip'] . "','" . $val['customer_user_name'] . "','" . $val['customer_address'] . "','" . $val['customer_area'] . "','". $val['customer_contact'] . "','". implode(',', json_decode($val['customer_package'])) . "','". $val['customer_code'] . "','" . $val['customer_isp_account'] . "','" . $val['customer_status'] . "','" . $val['customer_last_renew_date'] . "','" . $val['customer_activation_date'] . "','" . $val['customer_deactivation_date'] . "','" . $val['customer_is_free'] . "')";
    //print_r($cable_cust_data[0]);
   //echo $sql_simple_cust_data_insert;
    //die();
    mysqli_query($conn_simple, $sql_simple_cust_data_insert);
}
/* * **** */



/* * **truncate internet packages table*** */

/* * ****fetch cable packages data*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `internet_packages`");
/* * ** */

/* * ****fetch cable packages data*** */
$sql_internet_pack_data = "SELECT * FROM `internet_packages`";

$result_internet_pack = mysqli_query($conn_cable, $sql_internet_pack_data);
if (mysqli_num_rows($result_internet_pack) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_internet_pack)) {
        $internet_result_pack_data[] = $row;
    }
}
//pr($cable_result_pack_data);
/* * **packages entry in simplebillings***** */

foreach ($internet_result_pack_data as $key => $val) {
    $sql_simple_package_data_insert = "INSERT INTO `internet_packages`("
            . "`package_ID`,"
            . "`package_name`,"
            . " `package_rate`,"
            . "`package_cost_inclusive_tax`)"
            . " VALUES ('"
            . "" . $val['package_ID'] . "',"
            . "'" . $val['package_name'] . "',"
            . "'" . $val['package_rate'] . "'," . $val['package_cost_inclusive_tax'] . ")";

    mysqli_query($conn_simple, $sql_simple_package_data_insert);
}
/* * ***** */

/* * **truncate internet taxes table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `internet_taxes`");
/* * ** */

/* * ****fetch internet taxes data*** */
$sql_internet_tax_data = "SELECT * FROM internet_taxes";
$result_internet_tax = mysqli_query($conn_cable, $sql_internet_tax_data);
if (mysqli_num_rows($result_internet_tax) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_internet_tax)) {
        $internet_result_tax_data[] = $row;
    }
}

/* * **taxes entry in simplebillings***** */

foreach ($internet_result_tax_data as $key => $val) {
    $sql_simple_tax_data_insert = "INSERT INTO `internet_taxes`(`tax_name`,"
            . " `tax_type`,"
            . "`tax_value`)"
            . " VALUES ('" . $val['tax_name'] . "','" . $val['tax_type'] . "','" . $val['tax_value'] . "')";


    mysqli_query($conn_simple, $sql_simple_tax_data_insert);
}
/* * ***** */
/* * **truncate invoice table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `internet_invoices`");
/* * ** */
/* * ****fetch injternet invoice data*** */
$sql_internet_invoice_paid_data = "SELECT * FROM `internet_invoices` WHERE invoice_paid_amount > 0 AND invoice_period LIKE '%18'";
$sql_internet_invoice_bill_data = "SELECT * FROM `internet_invoices` WHERE invoice_billed_amount >0 AND invoice_period LIKE '%18'";
$result_internet_invoice_paid_data = mysqli_query($conn_cable, $sql_internet_invoice_paid_data);
$result_internet_invoice_bill_data = mysqli_query($conn_cable, $sql_internet_invoice_bill_data);
//echo mysqli_num_rows($result);
if (mysqli_num_rows($result_internet_invoice_paid_data) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_internet_invoice_paid_data)) {
        $internet_invoice_paid_data[] = $row;
    }
}
if (mysqli_num_rows($result_internet_invoice_bill_data) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result_internet_invoice_bill_data)) {
        $internet_invoice_bill_data[] = $row;
    }
}


/* * **truncate collection table*** */
mysqli_query($conn_simple, "TRUNCATE TABLE `internet_collections`");
/* * ** */


//print_r($cable_invoice_paid_data);
//die();


/* * ***invoice entry in simplebillings** */
foreach ($internet_invoice_bill_data as $key => $val) {
$invoice_meta['billing'][] = array('name'=>'Total Subscription Fee','cost'=>$val['invoice_billed_amount']);
$invoice_meta['total'] = $val['invoice_billed_amount'];
        
      $sql_simple_invoice_data_insert = "INSERT INTO `internet_invoices`(`invoice_customer`,"
            . " `invoice_date`,"
            . " `invoice_for`,"
            . " `invoice_billed_amount`,"
            . " `invoice_tax_amount`, "
            . "`invoice_note`, "
            . "`invoice_entry_timestamp`, "
            . "`invoice_meta`) "
            . "VALUES ('" . $val['invoice_customer'] . "','" . $val['invoice_date'] . "','" . $val['invoice_period'] . "','" . $val['invoice_billed_amount'] . "','" . $val['invoice_tax_amount'] . "','" . 'migrated' . "','" . $val['invoice_entry_timestamp'] . "','" .$val['invoice_meta'] . "')";
    
    mysqli_query($conn_simple, $sql_simple_invoice_data_insert) ;
}
/* * *** */
//echo count($cable_invoice_paid_data);
/* * **collection entry in simplebillings*** */
foreach ($internet_invoice_paid_data as $key => $val) {
    $sql_simple_collection_data_insert = "INSERT INTO  `internet_collections`(`collection_collected_by`,"
            . " `collection_for`,"
            . " `collection_customer`, "
            . "`collection_date`,"
            . " `collection_amount`, "
            . " `collection_note`, "
            . "`collection_entry_timestamp`)"
            . " VALUES ('" . $val['invoice_collected_by'] . "','" . $val['invoice_period'] . "','" . $val['invoice_customer'] . "','" . $val['invoice_collection_date'] . "','" . $val['invoice_paid_amount'] . "','".'migrated'."','" . $val['collection_entry_timestamp'] . "')";

    mysqli_query($conn_simple, $sql_simple_collection_data_insert);
}

echo "migretion comlipte";
mysqli_close($conn_cable);
mysqli_close($conn_simple);
?>