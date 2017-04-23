<?php 
class ManageModel extends Model {
    private $id;
    private $admin_user;
    private $admin_pass;
    private $level;
    private $limit;
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    public function checkLoginManage() {
        $sql = "SELECT m.admin_user,l.level_name FROM cms_manage m,cms_level l WHERE m.admin_user = '$this->admin_user' and m.admin_pass = '$this->admin_pass' and m.level = l.id LIMIT 1";
        return parent::one($sql);
    }
    public function getManageTotal() {
        $sql = "SELECT `id` FROM `cms_manage`";
        return parent::Total($sql);
    }
    public function getOneManage() {
        $sql = "SELECT `id`,`admin_user`,`admin_pass`,`level` FROM `cms_manage` WHERE id = '$this->id' OR `admin_user` = '$this->admin_user'";
        return parent::one($sql);
    }
    public function getManage() {
        $sql = "SELECT m.id,m.admin_user,m.level,m.login_number,m.login_ip,m.login_time,m.reg_time,l.level_name
            FROM cms_manage m,cms_level l
            WHERE l.level = m.level ".$this->limit;
        return parent::all($sql);
    }
    public function addManage() {
        $sql = "INSERT INTO `cms_manage` (`admin_user`,`admin_pass`,`level`,`reg_time`)
                    VALUES ('$this->admin_user','$this->admin_pass','$this->level',NOW())";
        return parent::adu($sql);
    }
    public function updateManage() {
        $sql = "UPDATE `cms_manage` SET `admin_pass` = '$this->admin_pass',`level` = '$this->level' WHERE `id` = '$this->id'";
        return parent::adu($sql);
    }
    public function deleteManage() {
        $sql = "DELETE FROM `cms_manage` WHERE  id = '$this->id'";
        return parent::adu($sql);
    }
}