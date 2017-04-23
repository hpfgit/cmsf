<?php 
class RegisterModel extends Model {
    private $id;
    private $user;
    private $pass;
    private $email;
    private $question;
    private $answer;
    private $state;
    private $face;
    private $time;
    
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    public function getLaterUser() {
        $sql = "SELECT `user`,`face` FROM `cms_user` ORDER BY `time` DESC LIMIT 6";
        return parent::all($sql);
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
    public function getOneUser() {
        $sql = "SELECT `id`,`user`,`face`,`email` FROM `cms_user` WHERE `user` = '$this->user'";
        return parent::one($sql);
    }
    public function updatecontent() {
        $sql = "UPDATE `cms_content` SET 
                title='$this->title',nav='$this->nav',keyword='$this->keyword',
                tag='$this->tag',author='$this->author',source='$this->source',thumbnail='$this->thumbnail',
                attr='$this->attr',sort='$this->sort',color='$this->color',count='$this->count',
                info='$this->info',readlimit='$this->readlimti'
                WHERE id='$this->id'";
        return parent::adu($sql);
    }
    public function deletecontent() {
            $sql = "DELETE FROM `cms_content` WHERE `id` = '$this->id'";
            return parent::adu($sql);
    }
}