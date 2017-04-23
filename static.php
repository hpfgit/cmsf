<?php
header('Content-type:text/html;charset=utf-8');
define('ROOT_PATH', dirname(__FILE__));
require ROOT_PATH.'/config/profile.inc.php';
if (!FRONT_CACHE) exit();
function __autoload($className) {
    if (substr($className, -6) == 'Action') {
        require ROOT_PATH.'/action/'.$className.'.class.php';
    } else if (substr($className, -5) == 'Model') {
        require ROOT_PATH.'/model/'.$className.'.class.php';
    } else {
        require ROOT_PATH.'/includes/'.$className.'.class.php';
    }
}
$cache = new Cache();
$cache->cachetype();