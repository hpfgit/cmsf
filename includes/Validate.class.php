<?php
//验证类
class Validate {
    // 是否为空
    static function checkNull($data) {
        if (trim($data) == '') return TRUE ;
        return FALSE;
    }
    // 长度是否合法
    static function checkLength($data, $length, $flag) {
        if ($flag == 'min') {
            if (mb_strlen(trim($data), 'utf-8') < $length) return TRUE;
            return FALSE;
        } elseif ($flag == 'max') {
            if (mb_strlen(trim($data), 'utf-8') > $length) return TRUE;
            return FALSE;
        } elseif ($flag == 'equals') {
            if (mb_strlen(trim($data)) != $length) return TRUE;
            return FALSE;
        } else {
            TOOL::alertBack('参数传递错误');
        }
    }
    // 数据是否一致
    static function checkEquals($data, $otherdate) {
        if (trim($data) == trim($otherdate)) return FALSE;
        return TRUE;
    }
    // session验证
    static function checkSession() {
        if (!isset($_SESSION['admin'])) Tool::alertLocation('非法登陆', 'admin_login.php');
    }
    // 邮箱验证
    static function checkemail($data) {
        if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $data)) return TRUE;
        return FALSE;
    }
}