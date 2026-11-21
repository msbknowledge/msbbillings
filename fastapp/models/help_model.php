<?php

class Help_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_help($type = null) {
        $DB2 = $this->load->database('node_db', TRUE);
        $DB2->select('*');
        $DB2->from('helps');
        if (!empty($type)) {
            $DB2->where('help_type', $type);
        }
        $DB2->order_by('help_id', 'ASC');
        $query = $DB2->get();
        $result = $query ? $query->result_array() : array();
        return $result;
    }

}
