<?php defined('EXAMPLE') or die('Access denied');

function __autoload($classname){
    require_once DIR_CLASSES . $classname . '.php';
}

