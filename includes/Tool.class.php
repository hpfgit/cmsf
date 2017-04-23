<?php
class Tool {
    //弹窗跳转
    static function alertLocation($info, $url) {
        if (empty($info)) {
            header("location:".$url);
        } else {
            echo "<script>alert('.$info.');location.href='$url'</script>";
        }
        exit();
    }
    //弹窗返回
    static function alertBack($info) {
        echo "<script>alert('.$info.');history.back(-1)</script>";
        exit();
    }
    //弹窗关闭
    static function alertClose($info) {
        echo "<script>alert('.$info.');close();</script>";
        exit();
    }
    // 检测session
    static function unSession() {
        if (session_start()) {
            session_destroy();
        }
    }
    //过滤字符串
    static function htmlString($date) {
        if (is_array($date)) {
            foreach ($date as $key=>$value) {
                $string[$key] = Tool::htmlString($value); //递归
            }
        } elseif (is_object($date)) {
            foreach ($date as $key=>$value) {
                $string->$key = Tool::htmlString($value); //递归
            }
        } else {
            $string = Tool::htmlString($date);
        }
        return $string;
    }
    //上传专用
    static function alertOpenClose($info, $path) {
        echo "<script>alert('$info');</script>";
        echo "<script>opener.document.content.thumbnail.value='$path'</script>";
        echo "<script>opener.document.content.pic.style.display='block';</script>";
        echo "<script>opener.document.content.pic.src='$path';</script>";
        echo "<script>window.close();</script>";
    }
    //截取字符串
    static function substr($object, $filed, $length, $encoding) {
        if ($object) {
            foreach ($object as $value) {
                if (mb_strlen($value->$filed, 'utf-8') > 10) {
                    $value->$filed = mb_substr($value->$filed, 0, $length, $encoding).'...';
                }
            }
        } else {
            return mb_substr($value->$filed, 0, $length, $encoding).'...';
        }
    }
    //对象转化字符串
    static function objOfstr($object, $filed) {
        foreach ($object as $value) {
            $id .= $value->$filed.',';
        }
        return substr($id, 0, strlen($id) - 1);
    }
    //获取tpl文件名
    static function tplName() {
        $str = explode('/', $_SERVER['SCRIPT_NAME']);
        $str = explode('.', $str[count($str)-1]);
        return $str[0].'.tpl';
    }
}