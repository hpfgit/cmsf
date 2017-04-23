<?php
class ListAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new ContentModel());
    }
    public function _action() {
        $this->getListContent();
    }
    private function getListContent() {
        if (isset($_GET['id'])) {
            $this->tpl->assign('list',TRUE);
            $nav = new NavModel();
            $nav->id = $_GET['id'];
            $navid = $nav->getChildId();
            if ($navid) {
                $this->model->nav = Tool::objOfstr($navid, id);
            } else {
                $this->model->nav = $nav->id;
            }
            $page = new Page($this->model->getListManageTotal(),PAGE_SIZE);
            $this->model->limit = $page->limit;
            $object = $this->model->getContent();
            Tool::substr($object, info, 120, 'utf-8');
            if (IS_CACHE) {
                foreach ($object as $value) {
                    $value->count = '<script type="text/javascript">get();</script>';
                }
            }
            $this->tpl->assign('listcontent',$object);
            $this->tpl->assign('page', $page->ShowPage());
        } else {
            Tool::alertBack('非法操作');
        }
    }
    //获取前台显示导航
    public function getNav() {
        if (isset($_GET['id'])) {
            $nav = new NavModel();
            $nav->id = $_GET['id'];
            $this->tpl->assign('nav', $nav->getOneNav()->nav_name);
            if ($nav->getOneNav()) {
                if ($nav->getOneNav()->nnav_name) $navMain1 = '<a href="list.php?id='.$nav->getOneNav()->iid.'">'.$nav->getOneNav()->nnav_name.'</a>&gt;';
                $navMain2 = '<a href="list.php?id='.$nav->getOneNav()->id.'">'.$nav->getOneNav()->nav_name.'</a>';
                $this->tpl->assign('nav',$navMain1.$navMain2);
                //子导航
                $this->tpl->assign('childnav', $nav->getAllFrontChildNav());
            } else {
                Tool::alertBack('警告：没有此导航');
            }
        } else {
            Tool::alertBack('警告：非法操作');
        }
    }
}