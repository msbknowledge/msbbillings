<?php
class Landing extends MY_Controller
{

    public $publicAccess = array(
        'index',
        'blogs',
        'chat',
        'wishes',
        'home',
        'wishe',
        'about_us',
        'blogdetails',
        'contact_us',
        'payment_terms_and_conditions',
        'privacy_policy',
        'details',
        'main',
        'check_subscriber'
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('help_model');
    }

    public function index()
    {
        $server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
        $subdomain = explode('.', $server_name)[0];

        $is_main_domain = false;
        if (!isset($_GET['node']) || empty($_GET['node'])) {
            if ($server_name === 'localhost' || $server_name === '127.0.0.1') {
                $is_main_domain = true;
            } elseif ($server_name === 'msbbiling.in' || $server_name === 'www.msbbiling.in' || $server_name === 'msbbillings.in' || $server_name === 'www.msbbillings.in') {
                $is_main_domain = true;
            }
        }

        // Main corporate platform website
        if ($is_main_domain) {
            $landing_url = get_option('home_page');
            if (!empty($landing_url)) {
                redirect(base_url($landing_url));
            } else {
                $this->load->view('index_tpl.php');
            }
            return;
        }

        // Subdomain / Node dynamic portal
        $node_name = defined('NODE') ? NODE : (isset($_GET['node']) ? trim($_GET['node']) : $subdomain);
        $node_plan = defined('PLAN_NAME') ? PLAN_NAME : (defined('NODETYPE') ? NODETYPE : '');
        $node_modules = defined('PLAN_PACKAGES') ? json_decode(PLAN_PACKAGES, true) : array();
        if (!is_array($node_modules)) {
            $node_modules = array();
        }

        // Gather options from current node database
        $options_raw = array();
        if ($this->db->table_exists('options')) {
            $opt_res = $this->db->get('options')->result_array();
            foreach ($opt_res as $opt) {
                $key = isset($opt['option_key']) ? $opt['option_key'] : (isset($opt['option_name']) ? $opt['option_name'] : '');
                if (!empty($key)) {
                    $options_raw[$key] = isset($opt['option_value']) ? $opt['option_value'] : '';
                }
            }
        }

        // Cable TV Packages (if module includes trai-cable or cable)
        $cable_packages = array();
        if ($this->db->table_exists('packages')) {
            $cable_packages = $this->db->order_by('package_rate', 'ASC')->get('packages')->result_array();
        }

        // Channels count
        $channels_count = 0;
        if ($this->db->table_exists('channels')) {
            $channels_count = $this->db->count_all('channels');
        }

        // Internet Broadband Packages (if module includes internet)
        $internet_packages = array();
        if ($this->db->table_exists('internet_packages')) {
            $internet_packages = $this->db->order_by('package_rate', 'ASC')->get('internet_packages')->result_array();
        }

        // Medicine Categories / Stock (if medical)
        $medicine_categories = array();
        if ($this->db->table_exists('medicine_categories')) {
            $medicine_categories = $this->db->limit(12)->get('medicine_categories')->result_array();
        }

        $data = array(
            'node_name' => $node_name,
            'node_plan' => $node_plan,
            'node_modules' => $node_modules,
            'options' => $options_raw,
            'cable_packages' => $cable_packages,
            'channels_count' => $channels_count,
            'internet_packages' => $internet_packages,
            'medicine_categories' => $medicine_categories,
            'login_url' => site_url('console/user/login')
        );

        $this->load->view('subdomain_tpl.php', $data);
    }

    /**
     * Live Subscriber Account / Dues Lookup Endpoint
     */
    public function check_subscriber()
    {
        header('Content-Type: application/json');
        $query = $this->input->get_post('query', TRUE);
        if (empty($query)) {
            echo json_encode(array('status' => false, 'message' => 'Please enter Mobile number or Subscriber/STB ID'));
            return;
        }

        $query = trim($query);
        $found = null;

        $escaped = $this->db->escape_str($query);
        $escaped_like = $this->db->escape_like_str($query);

        // Check in customers table (Cable TV)
        if ($this->db->table_exists('customers')) {
            $where_sql = "(customer_contact = '{$escaped}' OR customer_ID = '{$escaped}' OR customer_stb LIKE '%{$escaped_like}%')";
            $cust = $this->db->where($where_sql, NULL, FALSE)->get('customers', 1)->row_array();
            if ($cust) {
                $pkg = json_decode($cust['customer_package'], true);
                $pack_total = isset($pkg['total']) ? $pkg['total'] : (isset($pkg['subtotal']) ? $pkg['subtotal'] : 0);
                $found = array(
                    'type' => 'Cable TV Subscriber',
                    'name' => $cust['customer_name'],
                    'id' => $cust['customer_ID'],
                    'contact' => $cust['customer_contact'],
                    'address' => $cust['customer_address'],
                    'stb' => $cust['customer_stb'],
                    'package_total' => $pack_total,
                    'due_date' => !empty($cust['customer_deactivation_date']) ? $cust['customer_deactivation_date'] : 'End of Month',
                    'status' => ($cust['customer_status'] == 1 ? 'Active' : 'Pending / Due')
                );
            }
        }

        // Check in internet_customers table (Broadband)
        if (!$found && $this->db->table_exists('internet_customers')) {
            $where_isql = "(customer_contact = '{$escaped}' OR customer_ID = '{$escaped}' OR customer_username LIKE '%{$escaped_like}%')";
            $icust = $this->db->where($where_isql, NULL, FALSE)->get('internet_customers', 1)->row_array();
            if ($icust) {
                $found = array(
                    'type' => 'Broadband Subscriber',
                    'name' => $icust['customer_name'],
                    'id' => $icust['customer_ID'],
                    'contact' => $icust['customer_contact'],
                    'address' => $icust['customer_address'],
                    'stb' => isset($icust['customer_username']) ? $icust['customer_username'] : '',
                    'package_total' => isset($icust['package_amount']) ? $icust['package_amount'] : 0,
                    'due_date' => !empty($icust['customer_deactivation_date']) ? $icust['customer_deactivation_date'] : 'End of Month',
                    'status' => ($icust['customer_status'] == 1 ? 'Active' : 'Pending / Due')
                );
            }
        }

        if ($found) {
            echo json_encode(array('status' => true, 'data' => $found));
        } else {
            echo json_encode(array('status' => false, 'message' => 'No active subscriber found with that Mobile number or ID. Please check and try again.'));
        }
    }

    public function contact_us()
    {
        $this->render();
    }
    public function about_us()
    {
        $this->render();
    }
    public function wishes()
    {
        $this->load->view('2024_tpl.php');
    }
    public function chat()
    {
        echo 'coming soon';
    }
}
