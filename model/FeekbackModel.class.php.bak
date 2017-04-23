<?php 
class FeedbackModel extends Model {
    private $id;
    private $title;
    private $nav;
    private $keyword;
    private $content;
    private $tag;
    private $author;
    private $source;
    private $thumbnail;
    private $attr;
    private $color;
    private $limit;
    private $readlimti;
    private $sort;
    private $commend;
    private $count;
    private $column;
    private $info;
    
    public function __set($key, $value) {
        $this->$key = $value;
    }
    public function __get($key) {
        return $this->$key;
    }
    //获取所有的评论
    public function getAllComment() {
        $sql = "SELECT `id`,`content`,`date` FROM `cms_comment`";
        return parent::all($sql);
    }
    //添加评论
    public function addComment() {
        $sql = "INSERT INTO `cms_comment` (`user`,`content`,`date`) VALUES ('$this->user')";
    }
    //累计文档的点击量
    public function setContentCount() {
        $sql = "UPDATE `cms_content` SET `count`=`count`+1 WHERE `id`='$this->id' LIMIT 1";
        return parent::adu($sql);
    }
    public function getAllNavChildId() {
        $sql = "SELECT id FROM cms_nav WHERE pid<>0";
        return parent::all($sql);
    }
    public function getOneContent() {
        $sql = "SELECT 
                    id,title,thumbnail,info,nav,attr,color,source,author,count,keyword,thumbnail,sort,readlimit
                FROM 
                    cms_content
                WHERE
                    id='$this->id'";
        return parent::one($sql);
    }
    public function getListManageTotal() {
        $sql = "SELECT 
                    c.id
                FROM 
                cms_content c,cms_nav n 
                WHERE 
                c.nav=n.id 
                and 
                c.nav IN ($this->nav)";
        return parent::Total($sql);
    }
    public function getContent() {
        $sql = "SELECT 
                    c.id,c.nav,c.attr,c.title t,c.title,c.date,c.info,c.thumbnail,c.content,c.count,n.nav_name 
                FROM 
                cms_content c,cms_nav n 
                WHERE 
                c.nav=n.id 
                and 
                c.nav IN ($this->nav)".$this->limit;
        return parent::all($sql);
    }
    public function addcontent() {
        $sql = "INSERT INTO `cms_content` 
                (`title`,`nav`,`keyword`,`date`,`tag`,`author`,`source`,`thumbnail`,`attr`,`sort`,`color`,`commend`,`count`,`info`,`readlimit`)
                VALUES 
                ('$this->title','$this->nav','$this->keyword',NOW(),'$this->tag','$this->author','$this->source','$this->thumbnail','$this->attr','$this->sort','$this->color','$this->commend','$this->count','$this->info','$this->readlimti')";
        return parent::adu($sql);
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