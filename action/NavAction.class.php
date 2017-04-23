<?php
class NavAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new NavModel());
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
            case 'showchild':
                $this->showchild();
                break;
            case 'addchild':
                $this->addchild();
                break;
            case 'sort':
                $this->sort();
                break;
            default:
                Tool::alertBack('非法操作');
        }
    }
    public function showFront() {
        $this->tpl->assign('allnav', $this->model->getFrontNav());
    }
    public function showFrontChildNav() {
        if (isset($_GET['pid'])) {
            $this->model->pid = $_GET['pid'];
            $this->tpl->assign('allchildnav', $this->model->getFrontChildNav());
        }
    }
    private function sort() {
        if (isset($_POST['send'])) {
            $sort = $_POST['sort'];
            foreach ($sort as $key=>$value) {
                if (!is_numeric($value)) continue;
                $sql .= "UPDATE `cms_nav` SET `sort`='$value' WHERE `id` = '$key';";
            }
            $pdo = DB::getDB();
            $pdo->query($sql);
            Tool::alertLocation('排序成功', 'nav.php?action=list');
        }
    }
    private function show() {
        $this->tpl->assign('list', true);
        $this->tpl->assign('title', '导航列表');
        $this->tpl->assign('manage', $this->model->getAllNav());
    }
    private function add() {
        if (isset($_POST['send'])) {
            $this->model->nav_name = $_POST['nav_name'];
            if ($this->model->getOneNav()) Tool::alertBack('此导航已被添加');
            $this->model->nav_info = $_POST['nav_info'];
            $this->model->pid = $_POST['pid'];
            $url = $this->model->pid ? 'nav.php?action=showchild&pid='.$this->model->pid : 'nav.php?action=list';
            $this->model->addNav() ? Tool::alertLocation('恭喜你！新导航成功！', $url) : Tool::alertBack('很遗憾，新增失败！');
        }
        $this->tpl->assign('add', true);
        $level = new NavModel();
        $this->tpl->assign('alllevel',$level->getAllNav());
        $this->tpl->assign('title', '新增导航');
    }
    private function update() {
        if (isset($_POST['send'])) {
            $this->model->id = $_POST['id'];
            $this->model->nav_name = $_POST['nav_name'];
            $this->model->nav_info = $_POST['nav_info'];
            $this->model->updateNav() ? Tool::alertLocation('修改成功！', 'nav.php?action=list') : Tool::alertBack('修改失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $nav = $this->model->getOneNav();
            is_object($nav) ? true : Tool::alertBack('你传的id有误');
            $this->tpl->assign('id',$nav->id);
            $this->tpl->assign('nav_name',$nav->nav_name);
            $this->tpl->assign('nav_info',$nav->nav_info);
            $this->tpl->assign('sort',$nav->sort);
            $this->tpl->assign('update', true);
            $level = new NavModel();
            $this->tpl->assign('alllevel',$level->getOneNav());
            $this->tpl->assign('title', '修改导航');
        } else {
            TOOL::alertBack('非法操作');
        }
    }
    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deleteNav() ? Tool::alertLocation('删除成功！', 'nav.php?action=list') : Tool::alertBack('删除失败！');
        } else {
            Tool::alertBack('非法操作');
        }
        $this->tpl->assign('delete', true);
        $this->tpl->assign('title', '删除导航');
    }
    private function addchild() {
        if (isset($_POST['send'])) {
            $this->add();
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $nav = $this->model->getOneNav();
            is_object($nav) ? true : Tool::alertBack('导航id有误');
            $this->tpl->assign('id', $this->model->id);
            $this->tpl->assign('pid', $nav->id);
            $this->tpl->assign('prev_name', $nav->nav_name);
            $this->tpl->assign('addchild', true);
            $this->tpl->assign('title', '新增子导航');
        }
    }
    private function showchild() {
        if (isset($_GET['pid'])) {
            $this->model->pid = $_GET['pid'];
            $this->tpl->assign('pid', $this->model->pid);
            $this->tpl->assign('showchild', true);
            $this->tpl->assign('title', '子导航列表');
            $this->tpl->assign('manage', $this->model->getAllNavChild());
        }
    }
}