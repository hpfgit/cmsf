<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$manage = new ManageAction($tpl); //入口
$manage->action();
$tpl->display('manage.tpl');