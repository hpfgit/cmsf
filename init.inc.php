<?php
session_start();
ob_start();
header('Content-type:text/html;charset=utf-8');
define('ROOT_PATH', dirname(__FILE__));
require 'config/profile.inc.php';
require ROOT_PATH.'/includes/templates.class.php';
require ROOT_PATH.'/includes/DB.class.php';
require ROOT_PATH.'/includes/Tool.class.php';
require ROOT_PATH.'/includes/Validate.class.php';
require ROOT_PATH.'/includes/Page.class.php';
require ROOT_PATH.'/includes/ValidateCode.class.php';
require ROOT_PATH.'/includes/uploadfile.class.php';
require ROOT_PATH.'/includes/Image.class.php';
function __autoload($className) {
    if (substr($className, -6) == 'Action') {
        require ROOT_PATH.'/action/'.$className.'.class.php';
    } else if (substr($className, -5) == 'Model') {
        require ROOT_PATH.'/model/'.$className.'.class.php';
    } else {
        require ROOT_PATH.'/includes/'.$className.'.class.php';
    }
}
$cache = new Cache(array('code'));
$tpl = new Templates();
require 'connon.inc.php';