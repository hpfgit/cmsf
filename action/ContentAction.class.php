<?php
class ContentAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new ContentModel());
    }
    public function action() {
        switch ($_GET['action']) {
            case 'list':
                $this->show();
                break;
            case 'add':
                $this->add();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                Tool::alertBack('非法操作');
        }
    }
    private function show() {
        $this->tpl->assign('list', true);
        $this->tpl->assign('title', '文档列表');
        $nav = new ContentModel();
        $this->getNav();
        if (empty($_GET['nav'])) {
            $this->model->nav = Tool::objOfstr($nav->getAllNavChildId(), id);
        } else {
            $nav = new NavModel();
            $nav->id = $_GET['nav'];
            if (!$nav->getOneNav()) Tool::alertBack('参数错误');
            $this->model->nav = $_GET['nav'];
        }
        parent::page($this->model->getListManageTotal());
        $object = $this->model->getContent();
        Tool::substr($object, 'title', 20, 'utf-8');
        $this->tpl->assign('allcontent', $object);
    }
    private function add() {
        if (isset($_POST['send'])) {
            $this->getPost();
            $this->model->addcontent() ? Tool::alertLocation('新增成功！', 'content.php?action=list') : Tool::alertBack('新增失败');
        }
        $this->tpl->assign('content', true);
        $this->tpl->assign('title', '新增文章');
        $this->getNav();
    }
    //获取POST数据
    private function getPost() {
        if (!Validate::checkNull($_POST['column'])) Tool::alertBack('请选择一个栏目');
        if (Validate::checkLength($_POST['info'], 200, 'max')) Tool::alertBack('内容摘要不得大与200位');
        if (!is_numeric($_POST['count'])) Tool::alertBack('浏览次数必须是数字');
        $this->model->title = $_POST['title'];
        $this->model->tag = $_POST['tag'];
        $this->model->keyword = $_POST['keyword'];
        $this->model->thumbnail = $_POST['thumbnail'];
        $this->model->source = $_POST['source'];
        $this->model->author = $_POST['author'];
        if (isset($_POST['attr'])) {
            $this->model->attr = implode(',', $_POST['attr']);
        } else {
            $this->model->attr = '无属性';
        }
        $this->model->sort = $_POST['sort'];
        $this->model->limit = $_POST['limit'];
        $this->model->color = $_POST['color'];
        $this->model->commend = $_POST['commend'];
        $this->model->count = $_POST['count'];
        $this->model->nav = $_POST['column'];
        $this->model->info = $_POST['info'];
        $this->model->readlimit = $_POST['readlimit'];
    }
    //attr方法
    private function attr($attr) {
        $attrarr = array('头条','推荐','加粗','跳转');
        $attrs = explode(',', $attr);
        $attrno = array_diff($attrarr, $attrs);
        if ($attrs[0] != '无属性') {
            foreach ($attrs as $value) {
                $html .= "<input type='checkbox' checked='checked' name='attr[]' value='" . $value . "' >" . $value;
            }
        }
        foreach ($attrno as $value) {
            $html .= "<input type='checkbox' name='attr[]' value='" . $value . "' >" . $value;
        }
        $this->tpl->assign('attr', $html);
    }
    // nav方法
    private function getNav($navid = 0) {
        $nav = new NavModel();
        foreach ($nav->getAllFrontNav() as $navname) {
            $html .= "<optgroup label='".$navname->nav_name."'>";
            $nav->id = $navname->id;
            if (!!$childnav = $nav->getAllFrontChildNav()) {
                foreach ($childnav as $navname) {
                    if ($navid == $navname->id) $selected = 'selected="selected"';
                    $html .= "<option ".$selected." value=".$navname->id.">".$navname->nav_name."<option>";
                    $selected = '';
                }
            }
            $html .= "<optgroup>";
        }
        $this->tpl->assign('nav', $html);
    }
    //color方法
    private function color($color) {
        $colorarr = array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','green'=>'绿色');
        foreach ($colorarr as $key=>$value) {
            if ($color == $key) $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=".$key.">".$value."<option>";
            $selected = '';
        }
        $this->tpl->assign('color', $html);
    }
    //sort 方法
    private function sort($sort) {
        $sortarr = array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周');
        foreach ($sortarr as $key=>$value) {
            if ($sort == $key) $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=".$key.">".$value."<option>";
            $selected = '';
        }
        $this->tpl->assign('sort', $html);
    }
    //readlimit 方法
    private function readlimit($limit) {
        $limitarr = array(0=>'普通游客',1=>'普通会员',2=>'高级会员');
        foreach ($limitarr as $key=>$value) {
            if ($limit == $key)  $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=".$key.">".$value."<option>";
            $selected = '';
        }
        $this->tpl->assign('readlimit', $html);
    }
    private function update() {
        if (isset($_POST['send'])) {
            $this->getPost();
            $this->model->id = $_GET['id'];
            $this->model->updatecontent() ? tool::alertLocation('修改成功！', 'content.php?action=list') : tool::alertBack('修改失败！');
        }
        if (isset($_GET['id'])) {
            $this->tpl->assign('title', '修改文章');
            $this->tpl->assign('update', true);
            $this->model->id = $_GET['id'];
            $content = $this->model->getOneContent();
            if ($content) {
                $this->tpl->assign('id', $content->id);
                $this->tpl->assign('title', $content->title);
                $this->tpl->assign('info', $content->info);
                $this->tpl->assign('tag', $content->tag);
                $this->tpl->assign('source', $content->source);
                $this->tpl->assign('author', $content->author);
                $this->tpl->assign('count', $content->count);
                $this->tpl->assign('keywords', $content->keyword);
                $this->tpl->assign('thumbnail', $content->thumbnail);
                $this->getNav($content->nav);
                $this->attr($content->attr);
                $this->color($content->color);
                $this->sort($content->sort);
                $this->readlimit($content->readlimit);
            } else {
                tool::alertBack('不存在此文档');
            }
        }
    }
    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deletecontent() ? tool::alertLocation('删除成功！','content.php?action=list') : tool::alertBack('删除失败！');
        } else {
            tool::alertBack('非法操作');
        }
    }
}