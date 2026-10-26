<?php

/**
 * Description of barcodes
 *
 * @author kALLOL
 * 
 * 
 */
class Barcodes_model extends MY_Model {
    //put your code here
    
    public $table_name;
    public function __construct() {
        parent::__construct();
        $this->table_name = 'barcodes';
       //$this->check();
    }

 
}

?>
