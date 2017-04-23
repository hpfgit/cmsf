<?php
require dirname(__FILE__).'/init.inc.php';
global $tpl;
$register = new RegisterAction($tpl);
$register->action();
$tpl->display('register.tpl');