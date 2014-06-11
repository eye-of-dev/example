<?php defined('EXAMPLE') or die('Access denied');

// for ajax data
if (isset($_GET['route']))
{
    $route = explode('/', $_GET['route']);
    
    if (method_exists($route['0'], $route['1'])){

        print call_user_func_array(array($route['0'], $route['1']), array());
    }
    EXIT;
}