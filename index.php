<?php
//print_r(phpinfo());die();
date_default_timezone_set('Asia/Kolkata');
ini_set('max_input_vars', 5000);
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost';
$is_local = (
    $server_name === 'localhost' ||
    $server_name === '127.0.0.1' ||
    substr($server_name, -10) === '.localhost' ||
    substr($server_name, -6) === '.local'
);

if ($is_local) {
    define('SB_DB_HOST', 'localhost');
    define('SB_DB_USER', 'root');
    define('SB_DB_PASSWORD', '');
    define('SB_DB_NODE', 'node');
    define('SB_DB_PREFIX', '');
} else {
    define('SB_DB_HOST', 'localhost');
    define('SB_DB_USER', 'u404684354_node');
    define('SB_DB_PASSWORD', 'BR66MK55@msb');
    define('SB_DB_NODE', 'u404684354_node');
    define('SB_DB_PREFIX', 'u404684354_');
}

define("white_list_ip", "92.249.46.20");
$conn = new mysqli(SB_DB_HOST, SB_DB_USER, SB_DB_PASSWORD, SB_DB_NODE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$subdomain = explode('.', $server_name)[0];
if (isset($_GET['node']) && !empty($_GET['node'])) {
    $target_node = $conn->real_escape_string($_GET['node']);
    $sql = 'SELECT * FROM nodes WHERE node_name = "' . $target_node . '" LIMIT 1';
} elseif ($is_local) {
    if ($server_name === 'localhost' || $server_name === '127.0.0.1' || $subdomain === 'msbbiling' || $subdomain === 'node') {
        $sql = 'SELECT * FROM nodes WHERE node_name = "node" LIMIT 1';
    } else {
        $clean_sub = $conn->real_escape_string($subdomain);
        $clean_srv = $conn->real_escape_string($server_name);
        $sql = 'SELECT * FROM nodes WHERE node_url = "' . $clean_srv . '" OR node_name = "' . $clean_sub . '" LIMIT 1';
    }
} else {
    $sql = 'SELECT * FROM nodes WHERE node_url = "' . $conn->real_escape_string($server_name) . '"';
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['node_status'] != 0) {

        if ($row['node_status'] == 2 && white_list_ip != $_SERVER['HTTP_CF_CONNECTING_IP']) {
            echo "Down for maintainence";
            die();
        }
        define('NODEMETA', json_encode($row));
        define('DEACTIVATION_DATE', $row['deactivation_date']);
        define('DUE_DATE', $row['duereminder']);
        define('DUE', $row['due']);
        define('PLAN_NAME', $row['node_plan']);
        define('PLAN_PACKAGES', $row['node_module']);
        define('NODE', $row['node_name']);
        define('NODETYPE', $row['node_plan']);
        define('ROOTPATH', dirname(__FILE__) . '/');

        $next = date("Y-m-d", strtotime('+1 months'));
        $duedate = date("Y-m-d", strtotime($row['duereminder']));
        // echo $next;

        if (strtotime($row['deactivation_date']) <= time() && ($duedate <= $next)) { ?>

            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
                <title><?php echo $row['deactivation_note']; ?></title>
                <meta name="author" content="Account Suspended." />
                <style type="text/css">
                    body {
                        background-color: #eee;
                    }

                    h1 {
                        padding: 5px 0 5px 0;
                        font-size: 2.5em;
                        font-family: Times;
                        text-align: center;
                        color: #fff;
                        background-color: #d33;
                        border-radius: 15px 15px 0 0;
                    }

                    p {
                        padding: 0 20px 0 20px;
                        color: #333;
                        font-size: 1.2em;
                        font-family: Times, Serif;
                        text-align: justify;
                        line-height: 1.2em;
                    }

                    .container {
                        background-color: #fff;
                        border: 2px solid #fff;
                        border-radius: 0 0 15px 15px;
                    }

                    .note {
                        font-size: 1.2em;
                        border-top: 2px solid #ccc;
                        margin: 0 15px 10px 15px;
                        padding: 5px 5px 0 5px;
                    }

                    .line {
                        color: #555;
                    }
                </style>
            </head>

            <body>
                <h1><?php echo $row['node_url']; ?> is Down for subscription expiry on dated <?= $row['deactivation_date'] ?></h1>
                <div class="container">
                    <h2 style="text-align: center;">Renew Your Subscription</h2>
                    <p>
                    <table style="width:97%;height: 200px;margin:10px">
                        <tr>
                            <td style="border: 1px dotted black;text-align: center;font-weight: bold"><img src="https://msbbiling.in/msb/g-pay4500.jpeg" /></td>
                            <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                                <p><b>Bank: </b>UCO</p>
                                <p><b>A/C Name: </b>BAPAN ROY</p>
                                <p><b>A/C No: </b>11760110012932</p>
                                <p><b>IFSC Code: </b>UCBA0001176</p>
                            <!--    <p><b>A/C Type: </b>Current Account</p>-->


                            </td>

                        </tr>
                    </table>
                    </p>
                    <p class="note" style="text-align: center;"><b>&copy</b>msbbiling.in@<?= date('Y') ?></p>
                </div>
            </body>

            </html>
        <?php die();
        }
    } else {  ?>

        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <title><?php echo $row['deactivation_note']; ?></title>
            <meta name="author" content="Registrar Administrator" />
            <style type="text/css">
                body {
                    background-color: #eee;
                }

                h1 {
                    margin: 10% 20% 0 20%;
                    padding: 5px 0 5px 0;
                    font-size: 2.5em;
                    font-family: Times;
                    text-align: center;
                    color: #fff;
                    background-color: #d33;
                    border-radius: 15px 15px 0 0;
                }

                p {
                    padding: 0 20px 0 20px;
                    color: #333;
                    font-size: 1.2em;
                    font-family: Times, Serif;
                    text-align: justify;
                    line-height: 1.2em;
                }

                .container {
                    margin: 0 20% 0 20%;
                    background-color: #fff;
                    border: 2px solid #fff;
                    border-radius: 0 0 15px 15px;
                }

                .note {
                    font-size: 1.2em;
                    border-top: 2px solid #ccc;
                    margin: 0 15px 10px 15px;
                    padding: 5px 5px 0 5px;
                }

                .line {
                    color: #555;
                }
            </style>
        </head>

        <body>
            <h1><?php echo $row['node_url']; ?> is Down from <?= $row['deactivation_date'] ?></h1>
            <div class="container">
                <p><?php echo $row['deactivation_note']; ?></p>
                <p class="note"><b>&copy</b>msbbiling.in@<?= date('Y') ?></p>
            </div>
        </body>

        </html>
    <?php die();
    }
} else {
   // pp($_SERVER['SERVER_NAME']);
    if ($_SERVER['SERVER_NAME'] == "www.msbbiling.in" || $_SERVER['SERVER_NAME'] == "msbbiling.in" || $_SERVER['SERVER_NAME'] == "https://msbbiling.in") {

        //include 'home.php';
        header("Location: https://msbbiling.in/");
        die();
    }
    die();
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Oops!!</title>
        <meta name="author" content="Registrar Administrator" />
        <style type="text/css">
            body {
                background-color: #eee;
            }

            h1 {
                margin: 10% 20% 0 20%;
                padding: 5px 0 5px 0;
                font-size: 2.5em;
                font-family: Times;
                text-align: center;
                color: #fff;
                background-color: #d33;
                border-radius: 15px 15px 0 0;
            }

            p {
                padding: 0 20px 0 20px;
                color: #333;
                font-size: 1.2em;
                font-family: Times, Serif;
                text-align: justify;
                line-height: 1.2em;
            }

            .container {
                margin: 0 20% 0 20%;
                background-color: #fff;
                border: 2px solid #fff;
                border-radius: 0 0 15px 15px;
            }

            .note {
                font-size: 1.2em;
                border-top: 2px solid #ccc;
                margin: 0 15px 10px 15px;
                padding: 5px 5px 0 5px;
            }

            .line {
                color: #555;
            }
        </style>
    </head>

    <body>
        <h1>OOPS!! Not Found!!!</h1>
        <div class="container">
            <p> The Requsted node <?= $_SERVER['SERVER_NAME'] ?> not found. Please contact support!</p>
            <p class="note"><b>&copy</b>msbbiling@<?= date('Y') ?></p>
        </div>
    </body>

    </html>
<?php die();
}
$conn->close();
/*
 * ---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 * ---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */

define('ENVIRONMENT', 'testing');
/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/*
 * ---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 * ---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$system_path = 'system';

/*
 * ---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 * ---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */

$application_folder = 'fastapp';//fastappv1
//$application_folder = 'application';

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';
// The controller class file name.  Example:  Mycontroller
// $routing['controller'] = '';
// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';
/*
  if($_SERVER['HTTP_HOST']=='cloud.webcraftctvbb.com'){
  define('NODE', 'webcraft');
  define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'].'/');
  }

  if($_SERVER['HTTP_HOST']=='cloud.biswascommunications.in'){
  define('NODE', 'biswascommunications');
  define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'].'/');
  }
  if($_SERVER['HTTP_HOST']=='cloud.starcablecommunication.com'){
  define('NODE', 'starcable');
  define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'].'/');
  }
  if($_SERVER['HTTP_HOST']=='debayan.lml.pw'){
  define('NODE', 'debayan');
  define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'].'/');
  }
 * 
 */


// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


// The path to the "application" folder
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    if (!is_dir(BASEPATH . $application_folder . '/')) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH . 'core/CodeIgniter.php';

/* End of file index.php */
/* Location: ./index.php */
?>
