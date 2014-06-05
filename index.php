<?php

// Version
define('EXAMPLE', '1.0.0');

// Configuration
if (file_exists('config.php')) {
    require_once('config.php');
}  

// Startup
require_once(DIR_ENGINE . 'autoload.php');
require_once(DIR_ENGINE . 'controller.php');

$header = new Header();
$header->index();



$header = new Footer();
$header->index();