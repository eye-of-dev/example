<?php defined('EXAMPLE') or die('Access denied');

$root_dir = dirname(__FILE__);

define('DIR_ROOT', $root_dir);
define('DIR_CLASSES', $root_dir . '/classes/');
define('DIR_ENGINE', $root_dir . '/engine/');
define('DIR_IMAGES', $root_dir . '/images/');
define('DIR_LIBS', $root_dir . '/libs/');
define('DIR_VIEW', $root_dir . '/view/');
define('DIR_TMP', $root_dir . '/tmp/');

define('SITE_ROOT', $_SERVER['SERVER_NAME']);
define('IMG_W', '750');
define('IMG_H', '723');
define('width', '300');
define('height', '220');
define('IMG_BACKGROUND', FALSE);
define('IMG_WATERMARK', TRUE);
define('IMG_WATERMARK_SRC', $root_dir . '/watermark.png');