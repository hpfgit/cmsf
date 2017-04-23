<?php 
class NavModel extends Model {
    private $id;
    private $nav_name;
    private $nav_info;
    private $pid;
    private $sort;
    
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    public function getChildId() {
        $sql = "SELECT `id` FROM `cms_nav` WHERE `pid` = '$this->id'";
        return parent::all($sql);
    }
    public function getFrontNav() {
        $sql = "SELECT `id`,`nav_name` FROM `cms_nav` WHERE `pid` = 0 LIMIT 10";
        return parent::all($sql);
    }
    //查询所有的导航 不带limit的
    public function getAllFrontNav() {
        $sql = "SELECT `id`,`nav_name` FROM `cms_nav` WHERE `pid` = 0";
        return parent::all($sql);
    }
    public function getFrontChildNav() {
        $sql = "SELECT `id`,`nav_name` FROM `cms_nav` WHERE `pid` = '$this->pid' LIMIT 10";
        return parent::all($sql);
    }
    //查询所有的子导航
    public function getAllFrontChildNav() {
        $sql = "SELECT `id`,`nav_name` FROM `cms_nav` WHERE `pid` = '$this->id'";
        return parent::all($sql);
    }
    public function getNavTotal() {
        $sql = "SELECT `id` FROM `cms_nav`";
        return parent::Total($sql);
    }
    public function getOneNav() {
        $sql = "SELECT n1.id,n1.nav_name,n1.nav_info,n2.id iid,n2.nav_name nnav_name FROM cms_nav n1 LEFT JOIN cms_nav n2 ON n1.pid = n2.id WHERE n1.id = '$this->id' OR n1.nav_name = '$this->nav_name' LIMIT 1";
        return parent::one($sql);
    }
    public function getAllNav() {
        $sql = "SELECT `id`,`nav_name`,`nav_info`,`sort`
            FROM `cms_nav` WHERE `pid` = 0 ORDER BY `id` LIMIT 10";
        return parent::all($sql);
    }
    public function getAllNavChild() {
        $sql = "SELECT `id`,`nav_name`,`nav_info`,`sort`
            FROM `cms_nav` WHERE `pid` = '$this->pid' ORDER BY `id` LIMIT 10";
        return parent::all($sql);
    }
    public function addNav() {
        $sql = "INSERT INTO `cms_nav` (`nav_name`,`nav_info`,`pid`,`sort`)
        VALUES ('$this->nav_name','$this->nav_info','$this->pid',".parent::nextid('cms_nav').")";
        return parent::adu($sql);
    }
    public function updateNav() {
        $sql = "UPDATE `cms_nav` SET `nav_name` = '$this->nav_name',`nav_info` = '$this->nav_info' WHERE `id` = '$this->id'";
        return parent::adu($sql);
    }
    public function deleteNav() {
        $sql = "DELETE FROM `cms_nav` WHERE  id = '$this->id'";
        return parent::adu($sql);
    }
}