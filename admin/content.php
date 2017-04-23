<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$content = new ContentAction($tpl); //入口
$content->action();
$tpl->display('content.tpl');