<?php
//数据库配置文件
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cms');
define('PAGE_SIZE' ,5);
define('GPC', get_magic_quotes_gpc());
define('UPLOAD', 'upload/');
// 模板的配置信息
define('TPL_DIR', ROOT_PATH.'/templates/');
define('TPL_C_DIR', ROOT_PATH.'/templates_c/');
define('CACHE', ROOT_PATH.'/cache/');
define('CONFIG', ROOT_PATH.'/config/');