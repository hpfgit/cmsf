<?php
class Model {
    //获取下一个id
    protected function nextid($table) {
        $sql = "SHOW TABLE STATUS LIKE '$table'";
        $object = $this->one($sql);
        return $object->Auto_increment;
    }
    //获取结果集
    protected function Total($sql) {
        $pdo = DB::getDB();
        $stmt = $pdo->query($sql);
        $rows = $stmt->rowCount();
        return $rows;
    }
    //查找单个数据模型
    protected function one($sql) {
        $pdo = DB::getDB();
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    //查找多个数据模型
    protected function all($sql) {
        $pdo = DB::getDB();
        $stmt = $pdo->query($sql);
        $html = array();
        while(!!$result = $stmt->fetch(PDO::FETCH_OBJ)) {
            $html[] = $result;
        }
        return $html;
    }
    //增删改
    protected function adu($sql) {
        $pdo = DB::getDB();
        $result = $pdo->exec($sql);
        return $result;
    }
}