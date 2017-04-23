<?php
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
$ValidateCode = new ValidateCode();
$ValidateCode->run();
$_SESSION['code'] = $ValidateCode->GetCode();