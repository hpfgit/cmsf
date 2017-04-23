<?php
//是否开启缓存 前台
define('IS_CACHE', true);
IS_CACHE ? ob_start() : null;
global $tpl;
$nav = new NavAction($tpl);
$nav->showFront();