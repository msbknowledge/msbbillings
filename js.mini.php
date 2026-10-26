<?php

// Array of js files
$js = array(
    'js/jquery-ui-1.8.21.custom.min.js',
    'js/bootstrap-transition.js',
    'js/bootstrap-alert.js',
    'js/bootstrap-modal.js',
    'js/bootstrap-dropdown.js',
    'js/bootstrap-scrollspy.js',
    'js/bootstrap-tab.js',
    'js/bootstrap-tooltip.js',
    'js/bootstrap-popover.js',
    'js/bootstrap-button.js',
    'js/bootstrap-collapse.js',
    'js/bootstrap-carousel.js',
    'js/bootstrap-typeahead.js',
    'js/bootstrap-tour.js',
    'js/jquery.cookie.js',
    'js/jquery.dataTables.min.js',
    'js/excanvas.js',
    'js/jquery.flot.min.js',
    'js/jquery.flot.pie.min.js',
    'js/jquery.flot.stack.js',
    'js/jquery.flot.resize.min.js',
    'js/jquery.chosen.min.js',
    'js/chosen.jquery.min.js',
    'js/jquery.uniform.min.js',
    'js/jquery.colorbox.min.js',
    'js/jquery.cleditor.min.js',
    'js/jquery.noty.js',
    'js/jquery.elfinder.min.js',
    'js/jquery.raty.min.js',
    'js/jquery.iphone.toggle.js',
    'js/jquery.autogrow-textarea.js',
    'js/jquery.uploadify-3.1.min.js',
    'js/jquery.history.js',
    'js/jquery.datetimepicker.js',
    'js/bootstrap-tagsinput.js',
    'js/charisma.js',
    'js/fastapp.js'
    

);

$mergejs = "";
// Loop the js Array
foreach ($js as $js_file) {
    // Load the content of the js file 
    $mergejs.= file_get_contents($js_file);
}

// Remove comments also applicable in javascript
$mergejs= preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $mergejs);

// Remove space after colons
$mergejs= str_replace(': ', ':', $mergejs);

// Remove whitespace
$mergejs= str_replace(array("\n", "\t", '  ', '    ', '    '), '', $mergejs);

//Generate Etag
$genEtag = md5_file($_SERVER['SCRIPT_FILENAME']);

// call the browser that support gzip, deflate or none at all, if the browser doest      support compression this function will automatically return to FALSE
ob_start('ob_gzhandler');

// call the generated etag
header("Etag: ".$genEtag); 

// Same as the cache-control and this is optional
header("Pragma: public");

// Enable caching
header("Cache-Control: public ");

// Expire in one day
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400 ) . ' GMT');

// Set the correct MIME type, because Apache won't set it for us
header("Content-type: text/javascript");

// Set accept-encoding
header('Vary: Accept-Encoding');

// Write everything out
echo($mergejs);

?>