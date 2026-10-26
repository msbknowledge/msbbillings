<?php

class Renew_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'lcos';
        // $this->check();
    }

    public function account_renew_lco_list($dataSearch = null) {

        $where = " ";
        if ($dataSearch != null) {
            if (!empty($dataSearch['lco_code'])) {
                $where .= ' and lco_code like "%' . trim($dataSearch['lco_code']) . '%"';
            }
            if (!empty($dataSearch['lco_name'])) {
                $where .= ' and lco_name like "%' . trim($dataSearch['lco_name']) . '%"';
            }
            if (!empty($dataSearch['lco_contact'])) {
                $where .= ' and lco_contact like "%' . trim($dataSearch['lco_contact']) . '%"';
            }
        }

        //pr($sql,1);
        $data = $this->db->query("select * from lcos where 1=1 $where
			order by lco_last_renew_date asc
			")->result_array();

        foreach ($data as $k => $v) {
           // pr($data,1);
            $data[$k]['lco_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['lco_last_renew_date'])));
            $current_date = date_create(date('Y-m-d'));
            $renew_date = date_create($data[$k]['lco_renewal_date']);
            $diff = date_diff($renew_date, $current_date);
            //echo $diff->format("%R%a days");
            if ($diff->format("%R") == '-') {
                if ($diff->format("%a") > 3) {
                    unset($data[$k]);
                } else {
                    $data[$k]['lco_renewal_in'] = 'Expiring in ' . $diff->format("%a days") . '';
                    $data[$k]['lco_expired'] = false;
                }
            } else {
                $data[$k]['lco_expired'] = true;
                $data[$k]['lco_renewal_in'] = 'Expired ' . $diff->format("%a days") . ' before';
            }
        }

        return $data;
    }

    public function packages() {
        $data = $this->db->query("SELECT `package_ID`,`package_name` FROM `packages`")->result_array();
        return $data;
    }

    public function update($value) {

        $nextDate = date('Y-m-d', strtotime("+" . $value['for'] . " months", strtotime($value['lco_last_renew_date'])));
        //pr($value,1);

        $sql = "update lcos set 
         lco_package=" . $value['lco_package'] . ", 
         lco_deactivation_date='" . $nextDate . "', 
         lco_last_renew_date ='" . $value['lco_last_renew_date'] . "'  
         where lco_ID= " . $value['lco_ID'];
        $this->db->query($sql);
        $this->generate_bill($value['lco_ID'], (int) $value['for'], $value['lco_last_renew_date']);
    }

    private function generate_bill($lco_id = null, $count = 1, $date, $statement_for = null, $return = false) {

        if (empty($date)) {
            $date = date('Y-m-d');
        }
        if ($count < 2) {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' month';
        } else {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' months';
        }
        $lcos = $this->db->query("select * from lcos where lco_ID =$lco_id ")->result_array();
        $taxes = $this->internet_taxes_model->get_list();

        foreach ($lcos as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_for = '$statement_for' and invoice_lco = " . $data['lco_ID'])->result_array();

            if (!empty($already_entry)) {

                continue;
            }

            $invoice['invoice_lco'] = $data['lco_ID'];
            $invoice['invoice_date'] = $date;
            $total = 0.00;
            $billingData = null;
            if ($data['lco_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-', strtotime($date)) . $data['lco_due_date_of_month'];
            }

            $packages = $this->db->query(
                            "select * from packages where package_ID in (" . $data['lco_package'] . ")")->result_array();


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
