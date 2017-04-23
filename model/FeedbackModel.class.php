<?php 
class FeedbackModel extends Model {
    private $id;
    private $cid;
    private $user;
    private $content;
    private $state;
    private $limit;
    
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    //支持
    public function sustain() {
        $sql = "UPDATE `cms_comment` SET `sustain` = `sustain`+1 WHERE `id`='$this->id'";
        return parent::adu($sql);
    }
    //反对
    public function oppose() {
        $sql = "UPDATE `cms_comment` SET `oppose` = `oppose`+1 WHERE `id`='$this->id'";
        return parent::adu($sql);
    }
    //查找单一评论
    public function getOneComment() {
        $sql = "SELECT 
                                `id` 
                    FROM 
                                `cms_comment` 
                    WHERE 
                                `id`='$this->id'";
        return parent::one($sql);
    }
    //获取评论总排行榜
    public function getHotTwentyComment() {
        $sql = "SELECT
                        ct.id,ct.title
                    FROM
                        cms_content ct
                    ORDER BY 
                        (SELECT COUNT(*) FROM cms_comment c WHERE c.cid=ct.id)
                    DESC
                        LIMIT 0,20";
        return parent::all($sql);
    }
    //获取最火的三条评论
    public function getHotThreeComment() {
        $sql = "SELECT
                        c.cid,c.id,c.content,c.user,c.date,u.face,c.sustain,c.oppose
                    FROM
                        cms_comment c
                    LEFT JOIN
                        cms_user u
                    ON
                        c.user=u.user
                    WHERE
                        c.cid = '$this->cid'
                    AND
                        c.sustain+c.oppose>0
                    ORDER BY
                        c.sustain+c.oppose
                    DESC LIMIT 3";
        return parent::all($sql);
    }
    //获取三条评论
    public function getNewThreeComment() {
        $sql = "SELECT
                        c.cid,c.id,c.content,c.user,c.date,u.face,c.sustain,c.oppose
                    FROM
                        cms_comment c
                    LEFT JOIN
                        cms_user u
                    ON
                        c.user=u.user
                    WHERE
                        c.cid = '$this->cid' LIMIT 3";
        return parent::all($sql);
    }
    //获取评论总量
    public function getAllUserCount() {
        $sql = "SELECT `id` FROM `cms_comment` WHERE `cid`='$this->cid'";
        return parent::Total($sql);
    }
    //获取所有的评论
    public function getAllComment() {
        $sql = "SELECT 
                    c.cid,c.id,c.content,c.user,c.date,u.face,c.sustain,c.oppose
                FROM 
                    cms_comment c
                LEFT JOIN
                    cms_user u
                ON
                    c.user=u.user
                WHERE 
                    c.cid = '$this->cid'".$this->limit;
        return parent::all($sql);
    }
    //添加评论
    public function addComment() {
        $sql = "INSERT INTO `cms_comment` (`user`,`content`,`state`,`cid`,`date`) VALUES ('$this->user','$this->content','$this->state','$this->cid',NOW())";
        return parent::adu($sql);
    }
}