<?php 
class UserModel extends Model {
    private $id;
    private $user;
    private $pass;
    private $email;
    private $question;
    private $answer;
    private $state;
    private $face;
    private $time;
    private $limit;
    
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    public function setLaterUser() {
        $sql = "UPDATE `cms_user` SET `time` = '$this->time' WHERE `id` = '$this->id'";
        return parent::adu($sql);
    }
    public function checklogin() {
        $sql = "SELECT `id` FROM `cms_user` WHERE `user` = '$this->user' AND `pass` = '$this->pass'";
        return parent::one($sql);
    }
    public function adduser() {
        $sql = "INSERT INTO `cms_user` 
                (`user`,`pass`,`email`,`face`,`time`,`date`)
                VALUES 
                ('$this->user','$this->pass','$this->email','$this->face','$this->time',NOW())";
        return parent::adu($sql);
    }
    public function getAllUser() {
        $sql = "SELECT `id`,`user`,`email` FROM `cms_user`".$this->limit;
        return parent::all($sql);
    }
    public function getUserTotal() {
        $sql = "SELECT `id` FROM `cms_user`";
        return parent::Total($sql);
    }
    public function getOneUser() {
        $sql = "SELECT `id`,`user`,`pass`,`face`,`email` FROM `cms_user` WHERE `user` = '$this->user' OR `id` = '$this->id'";
        return parent::one($sql);
    }
    public function updateUser() {
        $sql = "UPDATE `cms_user` SET 
                user='$this->user',pass='$this->pass',email='$this->email',face='$this->face'
                WHERE id='$this->id'";
        return parent::adu($sql);
    }
    public function deleteUser() {
            $sql = "DELETE FROM `cms_user` WHERE `id` = '$this->id'";
            return parent::adu($sql);
    }
}