<?php

/**
 * Description of Site_settings_model
 *
 * @author kALLOL
 * 
 * 
 */
class Taxes_model extends MY_Model {

    //put your code here

    public $table_name;

    public function __construct() {
        parent::__construct();
        $this->table_name = 'taxes';
        $this->check();
    }

    public function install() {
        $query = $this->db->query("CREATE TABLE `taxes` (
		  `tax_ID` int(11) NOT NULL AUTO_INCREMENT,
		   `tax_name` varchar(50) NOT NULL,
                    `tax_type` int(11) NOT NULL,
                     `tax_value` decimal(10,2) NOT NULL,
		  PRIMARY KEY (`tax_ID`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
		");
        $this->db->query("INSERT INTO `taxes` (`tax_ID`, `tax_name`, `tax_type`, `tax_value`) VALUES
(1, 'CGST', 0, '9.00'),
(2, 'SGST', 0, '9.00');");
    }

    public function calulate_tax($amount) {
        $taxes = $this->get_list(NULL, NULL, NULL, NULL, NULL, 'tax_type asc');
        $taxable_amount['pretax'] = $amount;
        $taxable_amount['total'] = 0.0;
        foreach ($taxes as $key => $value) {
            if ($value['tax_type'] == 0) {
                $taxable_amount[$value['tax_name']] = number_format((float) ($amount * floatval($value['tax_value']) / 100), 2, '.', '');
            } else {
                $taxable_amount[$value['tax_name']] = floatval($value['tax_value']);
            }
        }
        foreach ($taxable_amount as $value) {
            $taxable_amount['total'] += $value;
        }
        $taxable_amount['taxes'] = $taxes;
        $taxable_amount['round'] = round($taxable_amount['total']);
        return $taxable_amount;
    }

    /**
     * 
     * tax type = '1' => simple sum; 0 = percent;
     * * */
    public function reverse_calulate_tax($amount) {
        $taxes = $this->get_list_for_dropdown();
        $tx = null;
        /*         * *************sorted by tax type********** */

        foreach ($taxes as $tax) {
            $tx[$tax['tax_type']][] = $tax;
        }
        $tax_details['pretax'] = $amount;
        $tax_details['total'] = $amount;
        /*         * *************simpletax********** */

        /*         * *******percent************* */
        $total_percent_amount = 0;
        # pr($tx);
        foreach ($tx[0] as $key => $tax) {
            if ($tax['tax_type'] == 0) {
                $total_percent_amount += floatval($tax['tax_value']);
            }
        }
        # pr($total_percent_amount);
        $tax_details = (100 * $amount) / (100 + $total_percent_amount);

        return $tax_details;
    }

}

?>
