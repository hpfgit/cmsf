<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$nav = new UserAction($tpl); //入口
$nav->action();
$tpl->display('user.tpl');