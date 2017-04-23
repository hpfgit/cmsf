<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$tpl->display('admin.tpl');