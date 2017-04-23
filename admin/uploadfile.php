<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
if (isset($_POST['send'])) {
    $upload = new Upload();
    $image = new Image($upload->getpath());
    $image->thumb();
    $image->out();
} else {
    Tool::alertBack('未知错误');
}