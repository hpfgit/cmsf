<?php
require dirname(__FILE__).'/init.inc.php';
global $tpl;
$index = new IndexAction($tpl);
$index->action();
$tpl->display('index.tpl');