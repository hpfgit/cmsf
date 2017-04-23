<?php 
class LevelModel extends Model {
    private $id;
    private $level_name;
    private $level_info;
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    public function getOneLevel() {
        $sql = "SELECT `id`,`level_name`,`level_info` FROM `cms_level` WHERE `id` = '$this->id' OR `level_name` = '$this->level_name'";
        return parent::one($sql);
    }
    public function getLevel() {
        $sql = "SELECT `id`,`level_name`,`level_info`
            FROM cms_level ORDER BY `id` LIMIT 10";
        return parent::all($sql);
    }
    public function getAlllevel() {
        $sql = "SELECT `id`,`level_info`,`level_name` FROM `cms_level` ORDER BY `id` ASC";
        return parent::all($sql);
    }
    public function addLevel() {
        $sql = "INSERT INTO `cms_level` (`level_name`,`level_info`)
                    VALUES ('$this->level_name','$this->level_info')";
        return parent::adu($sql);
    }
    public function updateLevel() {
        $sql = "UPDATE `cms_level` SET `level_name` = '$this->level_name',`level_info` = '$this->level_info' WHERE `id` = '$this->id'";
        return parent::adu($sql);
    }
    public function deleteLevel() {
        $sql = "DELETE FROM `cms_level` WHERE  id = '$this->id'";
        return parent::adu($sql);
    }
}