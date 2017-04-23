<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
$tpl->assign('name', $_SESSION['admin']['admin_user']);
$tpl->assign('level_name', $_SESSION['admin']['admin_level']);
$tpl->display('top.tpl');