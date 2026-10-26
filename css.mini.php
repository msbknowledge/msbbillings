<?php

// Array of css files
$css = array(
    'css/bootstrap-spacelab.css',
    'css/bootstrap-responsive.min.css',
    'css/charisma-app.css',
    'css/jquery-ui-1.8.21.custom.css',
    'css/uniform.default.css',
    'css/colorbox.css',
    'css/jquery.cleditor.css',
    'css/jquery.noty.css',
    'css/noty_theme_default.css',
    'css/elfinder.min.css',
    'css/elfinder.theme.css',
    'css/jquery.iphone.toggle.css',
    'css/opa-icons.css',
    'css/uploadify.css',
    'css/chosen.css',
    'css/chosen.min.css',
    'css/bootstrap-tagsinput.css',
    'css/jquery.datetimepicker.css',
    'css/fastapp.css'

);

$mergeCSS = "";
// Loop the css Array
foreach ($css as $css_file) {
    // Load the content of the css file 
    $mergeCSS.= file_get_contents($css_file);
}

// Remove comments also applicable in javascript
$mergeCSS= preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $mergeCSS);

// Remove space after colons
$mergeCSS= str_replace(': ', ':', $mergeCSS);

// Remove whitespace
$mergeCSS= str_replace(array("\n", "\t", '  ', '    ', '    '), '', $mergeCSS);

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
header("Content-type: text/css");

// Set accept-encoding
header('Vary: Accept-Encoding');

// Write everything out
echo($mergeCSS);

?>