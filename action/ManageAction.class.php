<?php
class ManageAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new ManageModel());
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
        $page = new Page($this->model->getManageTotal(),PAGE_SIZE);
        $this->model->limit = $page->limit;
        $this->tpl->assign('list', true);
        $this->tpl->assign('title', '管理员列表');
        $result = $this->model->getManage();
        $this->tpl->assign('manage', $result);
        $this->tpl->assign('total', $page->ShowPage());
    }
    private function add() {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['admin_user'])) Tool::alertBack('用户名不得为空');
            if (Validate::checkLength($_POST['admin_user'], 4, 'min')) Tool::alertBack('用户名不得小于4为');
            if (Validate::checkLength($_POST['admin_user'], 20, 'max')) Tool::alertBack('用户名不得大于20为');
            if (Validate::checkEquals($_POST['admin_pass'], $_POST['admin_notpass'])) Tool::alertBack('密码不一致，请重新输入密码');
            $this->model->admin_user = $_POST['admin_user'];
            if ($this->model->getOneManage()) Tool::alertBack('此用户已被占用');
            $this->model->admin_pass = sha1($_POST['admin_pass']);
            $this->model->level = $_POST['level'];
            $this->model->addManage() ? Tool::alertLocation('恭喜你！新增管理员成功！', 'manage.php?action=list') : Tool::alertBack('很遗憾，注册失败！');
        }
        $this->tpl->assign('add', true);
        $level = new LevelModel();
        $this->tpl->assign('alllevel',$level->getAlllevel());
        $this->tpl->assign('title', '新增管理员');
    }
    private function update() {
        if (isset($_POST['send'])) {
            $this->model->id = $_POST['id'];
            if (trim($_POST['admin_pass']) == '') {
                $this->model->admin_pass = $_POST['pass'];
            } else {
                if (Validate::checkLength($_POST['admin_pass'], 6, 'min')) Tool::alertBack('密码不得小于6为');
                $this->model->admin_pass = sha1($_POST['admin_pass']);
            }
            $this->model->admin_pass = sha1($_POST['amdin_pass']);
            $this->model->level = $_POST['level'];
            $this->model->updateManage() ? Tool::alertLocation('修改成功！', 'manage.php?action=list') : Tool::alertBack('修改失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            is_object($this->model->getOneManage()) ? true : Tool::alertBack('你传的id有误');
            $this->tpl->assign('id',$this->model->getOneManage()->id);
            $this->tpl->assign('level',$this->model->getOneManage()->level);
            $this->tpl->assign('admin_user',$this->model->getOneManage()->admin_user);
            $this->tpl->assign('admin_pass',$this->model->getOneManage()->admin_pass);
            $this->tpl->assign('update', true);
            $level = new LevelModel();
            $this->tpl->assign('alllevel',$level->getAlllevel());
            $this->tpl->assign('title', '修改管理员');
        } else {
            TOOL::alertBack('非法操作');
        }
    }
    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deleteManage() ? Tool::alertLocation('删除成功！', 'manage.php?action=list') : Tool::alertBack('删除失败！');
        } else {
            Tool::alertBack('非法操作');
        }
        $this->tpl->assign('delete', true);
        $this->tpl->assign('title', '删除管理员');
    }
}