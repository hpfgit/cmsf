<?php
require dirname(__FILE__).'/init.inc.php';
global $tpl;
$tpl->cache('details.tpl');
$details = new DetailsAction($tpl); //入口
$details->action();
$tpl->display('details.tpl');