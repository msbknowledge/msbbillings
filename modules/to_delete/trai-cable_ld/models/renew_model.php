<?php

class Renew_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'customers';
        // $this->check();
    }

    public function account_renew_customer_list($dataSearch = null) {

        $where = " ";
        if ($dataSearch != null) {
            if (!empty($dataSearch['customer_code'])) {
                $where .= ' and customer_code like "%' . trim($dataSearch['customer_code']) . '%"';
            }
            if (!empty($dataSearch['customer_name'])) {
                $where .= ' and customer_name like "%' . trim($dataSearch['customer_name']) . '%"';
            }
            if (!empty($dataSearch['customer_contact'])) {
                $where .= ' and customer_contact like "%' . trim($dataSearch['customer_contact']) . '%"';
            }
        }

        //pr($sql,1);
        $data = $this->db->query("select * from customers where 1=1 $where
			order by customer_last_renew_date asc
			")->result_array();

        foreach ($data as $k => $v) {
           // pr($data,1);
            $data[$k]['customer_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['customer_last_renew_date'])));
            $current_date = date_create(date('Y-m-d'));
            $renew_date = date_create($data[$k]['customer_renewal_date']);
            $diff = date_diff($renew_date, $current_date);
            //echo $diff->format("%R%a days");
            if ($diff->format("%R") == '-') {
                if ($diff->format("%a") > 3) {
                    unset($data[$k]);
                } else {
                    $data[$k]['customer_renewal_in'] = 'Expiring in ' . $diff->format("%a days") . '';
                    $data[$k]['customer_expired'] = false;
                }
            } else {
                $data[$k]['customer_expired'] = true;
                $data[$k]['customer_renewal_in'] = 'Expired ' . $diff->format("%a days") . ' before';
            }
        }

        return $data;
    }

    public function packages() {
        $data = $this->db->query("SELECT `package_ID`,`package_name` FROM `packages`")->result_array();
        return $data;
    }

    public function update($value) {

        $nextDate = date('Y-m-d', strtotime("+" . $value['for'] . " months", strtotime($value['customer_last_renew_date'])));
        //pr($value,1);

        $sql = "update customers set 
         customer_package=" . $value['customer_package'] . ", 
         customer_deactivation_date='" . $nextDate . "', 
         customer_last_renew_date ='" . $value['customer_last_renew_date'] . "'  
         where customer_ID= " . $value['customer_ID'];
        $this->db->query($sql);
        $this->generate_bill($value['customer_ID'], (int) $value['for'], $value['customer_last_renew_date']);
    }

    private function generate_bill($customer_id = null, $count = 1, $date, $statement_for = null, $return = false) {

        if (empty($date)) {
            $date = date('Y-m-d');
        }
        if ($count < 2) {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' month';
        } else {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' months';
        }
        $customers = $this->db->query("select * from customers where customer_ID =$customer_id ")->result_array();
        $taxes = $this->internet_taxes_model->get_list();

        foreach ($customers as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_for = '$statement_for' and invoice_customer = " . $data['customer_ID'])->result_array();

            if (!empty($already_entry)) {

                continue;
            }

            $invoice['invoice_customer'] = $data['customer_ID'];
            $invoice['invoice_date'] = $date;
            $total = 0.00;
            $billingData = null;
            if ($data['customer_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-', strtotime($date)) . $data['customer_due_date_of_month'];
            }

            $packages = $this->db->query(
                            "select * from packages where package_ID in (" . $data['customer_package'] . ")")->result_array();


            foreach ($packages as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['package_name'] . ' for ' . $statement_for,
                    'cost' => (float) $valuex['package_rate']
                );

                $total += (float) $valuex['package_rate'];
            }


            $taxtotal = 0.00;
            foreach ($taxes as $value) {
                if ($value['tax_type'] == 0) {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
                        'cost' => (float) $value['tax_value'] * $total / 100
                    );
                    $taxtotal += (float) $value['tax_value'] * $total / 100;
                } else {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
                        'cost' => (float) $value['tax_value']
                    );

                    $taxtotal += (float) $value['tax_value'];
                }
            }

            $invoice_meta['billings'] = $billingData;
            $invoice_meta['total'] = $taxtotal + $total;
            $invoice['invoice_billed_amount'] = $count * ($taxtotal + $total);
            $invoice['invoice_tax_amount'] = $taxtotal;
            $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_meta'] = json_encode($invoice_meta);

            if ($return) {

                return $invoice;
            } else {
                $this->invoices_model->insert_data($invoice);
            }
        }
    }

}
