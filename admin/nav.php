<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$nav = new NavAction($tpl); //入口
$nav->action();
$tpl->display('nav.tpl');