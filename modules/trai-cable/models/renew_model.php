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

      $data = $this->db->query("
            SELECT 
                c.*,
                p.package_name,
                p.package_subscription_days
            FROM customers c
            LEFT JOIN packages p
                ON p.package_ID = c.pk_id
            WHERE 1=1 $where
            ORDER BY c.customer_last_renew_date ASC
        ")->result_array();




       foreach ($data as $k => $v) {

                if (empty($v['customer_last_renew_date']) || empty($v['package_subscription_days'])) {
                    $data[$k]['customer_renewal_date'] = null;
                    $data[$k]['customer_expired'] = false;
                    $data[$k]['customer_renewal_in'] = 'Not activated';
                    continue;
                }
            
                $renewalDate = date(
                    'Y-m-d',
                    strtotime('+' . (int)$v['package_subscription_days'] . ' days', strtotime($v['customer_last_renew_date']))
                );
            
                $today     = new DateTime();
                $renewDate = new DateTime($renewalDate);
                $days      = $today->diff($renewDate)->days;
            
                $data[$k]['customer_renewal_date'] = $renewalDate;
            
                if ($renewDate < $today) {
                    $data[$k]['customer_expired'] = true;
                    $data[$k]['customer_renewal_in'] = "Expired {$days} days ago";
                } elseif ($days <= 3) {
                    $data[$k]['customer_expired'] = false;
                    $data[$k]['customer_renewal_in'] = "Expiring in {$days} days";
                } else {
                    // ✅ KEEP THE ROW
                    $data[$k]['customer_expired'] = false;
                    $data[$k]['customer_renewal_in'] = "Active ({$days} days left)";
                }
            }

    
    
            return $data;
    }

    public function account_renew_customer_list1($dataSearch = null) {

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
         pk_id=" . $value['customer_package'] . ", 
         customer_deactivation_date='" . $nextDate . "', 
         customer_last_renew_date ='" . $value['customer_last_renew_date'] . "'  
         where customer_ID= " . $value['customer_ID'];
        $this->db->query($sql);
        $this->generate_bill($value['customer_ID'], (int) $value['for'], $value['customer_last_renew_date']);
    }
private function generate_bill($customer_id = null, $count = 1, $date = null, $statement_for = null, $return = false) {
    if (empty($date)) {
        $date = date('Y-m-d');
    }

    $statement_for = $count < 2 
        ? "Subscription Renewal on $date for $count month"
        : "Subscription Renewal on $date for $count months";

    $customers = $this->db->query("SELECT * FROM customers WHERE customer_ID = $customer_id")->result_array();
    $taxes = $this->internet_taxes_model->get_list();

    foreach ($customers as $data) {
        // Skip if invoice already exists for this statement
        $already_entry = $this->db->query(
            "SELECT * FROM invoices WHERE invoice_for = '$statement_for' AND invoice_customer = " . $data['customer_ID']
        )->result_array();

        if (!empty($already_entry)) continue;

        $invoice = [];
        $invoice['invoice_customer'] = $data['customer_ID'];
        $invoice['invoice_date'] = $date;
        $invoice['invoice_due_date'] = $data['customer_due_date_of_month'] == 0 
            ? $date 
            : date('Y-m-', strtotime($date)) . $data['customer_due_date_of_month'];

        // Decode customer package
        $customer_package = json_decode($data['customer_package'], true);

        // Build items and calculate subtotal
        $items = [];
        $subtotal = 0;
        foreach ($customer_package['items'] as $item) {
            $price = floatval($item['price']);
            $items[] = [
                'name' => $item['name'],
                'price' => $price
            ];
            $subtotal += $price;
        }

        // Taxes
        $taxtotal = 0;
        foreach ($taxes as $tax) {
            if ($tax['tax_type'] == 0) { // percentage
                $taxAmount = round($tax['tax_value'] * $subtotal / 100, 2);
            } else { // fixed
                $taxAmount = floatval($tax['tax_value']);
            }
            $taxtotal += $taxAmount;
        }

        // Prepare invoice_meta in original structure
        $invoice_meta = [];
        $invoice_meta['billings'] = [
            'subtotal' => round($subtotal, 2),
            'discount' => 0,
            'total' => round($subtotal + $taxtotal),
            'items' => $items
        ];
        $invoice_meta['total'] = $invoice_meta['billings']['total'];

        // Invoice amounts
        $invoice['invoice_billed_amount'] = round($count * ($subtotal + $taxtotal));
        $invoice['invoice_tax_amount'] = round($taxtotal, 2);
        $invoice['invoice_for'] = $statement_for;
        $invoice['invoice_entry_timestamp'] = date('Y-m-d H:i:s');
        $invoice['invoice_meta'] = json_encode($invoice_meta);

        if ($return) {
            return $invoice;
        } else {
            $this->invoices_model->insert_data($invoice);
        }
    }
}
    private function generate_bill2($customer_id = null, $count = 1, $date, $statement_for = null, $return = false) {

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

            // $packages = $this->db->query("select * from packages where package_ID in (" . $data['pk_id'] . ")")->result_array();


            // foreach ($packages as $valuex) {
            //     $billingData[] = array(
            //         'name' => $valuex['package_name'] . ' for ' . $statement_for,
            //         'cost' => (float) $valuex['package_rate']
            //     );

            //     $total += (float) $valuex['package_rate'];
            // }
            
            $customer_package = json_decode($data['customer_package'], true);

                foreach ($customer_package['items'] as $item) {
                    $cost = floatval($item['price']);
                    $billingData[] = [
                        'name' => $item['name'],// . ' for ' . $statement_for,
                        'cost' => $cost
                    ];
                    $total += $cost;
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
           // $invoice['invoice_billed_amount'] = $count * ($taxtotal + $total);//round off
            $invoice['invoice_billed_amount'] = round($count * ($total + $taxtotal));
            $invoice['invoice_tax_amount'] = $taxtotal;
            $invoice['invoice_for'] = $statement_for;
            $invoice['invoice_entry_timestamp'] = date('Y-m-d H:i:s');
            $invoice['invoice_meta'] = json_encode($invoice_meta);

            if ($return) {

                return $invoice;
            } else {
                $this->invoices_model->insert_data($invoice);
            }
        }
    }

    private function generate_bill1($customer_id = null, $count = 1, $date, $statement_for = null, $return = false) {

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
