<?php

$debug = 1;

if (isset($_GET['env']) && $_GET['env'] == "dev") {
    $debug = 1;
}

define('debug' , $debug);
ini_set("display_errors", debug);
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
ini_set('max_execution_time', 300);

include('system/config/paths.php');
include('system/autoload.php');

// Load system classes.
require_once SYSTEM . 'App.class.php';
require_once SMARTY . 'Smarty.class.php';


//try {

    // Run app.
    $app = new App();
    $app->run();
//try {
//} catch (Exception $e) {
//    $response = '';
//
//    if (debug) {
//        $response = ': [' . $e->getCode() . '] ' . $e->getMessage();
//        echo 'ERROR' . $response;
//    }
//
//    echo "Wystąpiły problemy techniczne";
//}