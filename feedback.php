<?php
require dirname(__FILE__).'/init.inc.php';
global $tpl;
$feedback = new FeedbackAction($tpl); //入口
$feedback->action();
$tpl->display('feedback.tpl');