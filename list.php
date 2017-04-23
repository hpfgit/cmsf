<?php
require dirname(__FILE__).'/init.inc.php';
global $tpl;
$list = new ListAction($tpl);
$list->getNav();
$list->_action();
$tpl->display('list.tpl');