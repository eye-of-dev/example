<?php

// Version
define('EXAMPLE', '1.0.0');

// Configuration
if (file_exists('config.php')) {
    require_once('config.php');
}  

// Startup
require_once('startup.php');

// Registry
$registry = new Registry();

// Config
$image = new Image();
$registry->set('image', $image);

$header = new Header();
$header->index();

$body = new Body($registry);
$body->index();

$footer = new Footer();
$footer->index();