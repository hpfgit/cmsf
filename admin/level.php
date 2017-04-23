<?php
require substr(dirname(__FILE__),0,-5).'/init.inc.php';
global $tpl;
Validate::checkSession();
$level = new LevelAction($tpl); //入口
$level->action();
$tpl->display('level.tpl');