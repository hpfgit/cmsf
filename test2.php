<?php
/**
 * Created by PhpStorm.
 * User: 郝鹏飞
 * Date: 2016/12/29
 * Time: 10:59
 */
$str = explode('/', $_SERVER['SCRIPT_NAME']);
$str = explode('.', $str[count($str)-1]);
echo $str[0].'.tpl';