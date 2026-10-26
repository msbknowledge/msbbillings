<?php

class Renew_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'students';
        // $this->check();
    }

    public function account_renew_student_list($dataSearch = null) {
        $where = " ";
        if ($dataSearch != null) {
            if (!empty($dataSearch['student_code'])) {
                $where .= ' and student_code like "%' . trim($dataSearch['student_code']) . '%"';
            }
            if (!empty($dataSearch['student_name'])) {
                $where .= ' and student_name like "%' . trim($dataSearch['student_name']) . '%"';
            }
            if (!empty($dataSearch['student_contact'])) {
                $where .= ' and student_contact like "%' . trim($dataSearch['student_contact']) . '%"';
            }
        }

        //pr($sql,1);
        $data = $this->db->query("select * from students where 1=1 $where
			order by student_last_renew_date asc
			")->result_array();
        foreach ($data as $k => $v) {
           // $data[$k]['student_renewal_date'] = date('Y-m-d', strtotime('+' . $v['package_subscription_days'] . ' days', strtotime($v['student_last_renew_date'])));
            $data[$k]['student_renewal_date'] = $v['student_deactivation_date'];
            $current_date = date_create(date('Y-m-d'));
            $renew_date = date_create($data[$k]['student_renewal_date']);
            $diff = date_diff($renew_date, $current_date);
            //echo $diff->format("%R%a days");
            if ($diff->format("%R") == '-') {
                if ($diff->format("%a") > 3) {
                    unset($data[$k]);
                } else {
                    $data[$k]['student_renewal_in'] = 'Expiring in ' . $diff->format("%a days") . '';
                    $data[$k]['student_expired'] = false;
                }
            } else {
                $data[$k]['student_expired'] = true;
                $data[$k]['student_renewal_in'] = 'Expired ' . $diff->format("%a days") . ' before';
            }
        }

        return $data;
    }

    public function packages() {
        $data = $this->db->query("SELECT `package_ID`,`package_name` FROM `packages`")->result_array();
        return $data;
    }

    public function update($value) {
        $nextDate = date('Y-m-d', strtotime("+" . $value['for'] . " months", strtotime($value['student_last_renew_date'])));
        $sql = "update students set 
         student_deactivation_date='" . $nextDate . "', 
         student_last_renew_date ='" . $value['student_last_renew_date'] . "'  
         where student_ID= " . $value['student_ID'];
        $this->db->query($sql);
        $this->generate_bill($value['student_ID'], (int) $value['for'], $value['student_last_renew_date']);
    }

    private function generate_bill($student_id = null, $count = 1, $date, $statement_for = null, $return = false) {
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        if ($count < 2) {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' month';
        } else {
            $statement_for = 'Subscription Renewal on ' . $date . ' for ' . $count . ' months';
        }
        $students = $this->db->query("select * from students where student_ID =$student_id ")->result_array();
        $taxes = $this->taxes_model->get_list();

        foreach ($students as $data) {
            $already_entry = $this->db->query("select * from invoices where invoice_for = '$statement_for' and invoice_student = " . $data['student_ID'])->result_array();

            if (!empty($already_entry)) {

                continue;
            }

            $invoice['invoice_student'] = $data['student_ID'];
            $invoice['invoice_date'] = $date;
            $total = 0.00;
            $billingData = null;
            if ($data['student_due_date_of_month'] == 0) {
                $invoice['invoice_due_date'] = $invoice['invoice_date'];
            } else {
                $invoice['invoice_due_date'] = Date('Y-m-', strtotime($date)) . $data['student_due_date_of_month'];
            }

           /// $packages = $this->db->query("select * from packages where package_ID in (" . $data['student_package'] . ")")->result_array();

            $packages = json_decode($data['student_package'], true);
            foreach ($packages['items'] as $valuex) {
                $billingData[] = array(
                    'name' => $valuex['name'] ,
                    'price' => (float) $valuex['price']
                );

                $total += (float) $valuex['price'];
            }


            $taxtotal = 0.00;
            foreach ($taxes as $value) {
                if ($value['tax_type'] == 0) {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . '%)',
                        'price' => (float) $value['tax_value'] * $total / 100
                    );
                    $taxtotal += (float) $value['tax_value'] * $total / 100;
                } else {
                    $billingData[] = array(
                        'name' => $value['tax_name'] . ' (' . $value['tax_value'] . ')',
                        'price' => (float) $value['tax_value']
                    );

                    $taxtotal += (float) $value['tax_value'];
                }
            }

            $invoice_meta['billings']['items'] = $billingData;
            $invoice_meta['billings']['subtotal'] = $total;
            $invoice_meta['billings']['total'] = $taxtotal + $total;
            $invoice_meta['billings']['discount'] = 0;
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
