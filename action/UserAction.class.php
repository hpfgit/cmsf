<?php
class UserAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new UserModel());
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
        $page = new Page($this->model->getUserTotal(),PAGE_SIZE);
        $this->model->limit = $page->limit;
        $this->tpl->assign('list', true);
        $this->tpl->assign('title', '会员列表');
        $this->tpl->assign('AllUser', $this->model->getAllUser());
        $this->tpl->assign('page', $page->ShowPage());
    }
    private function add() {
        $this->tpl->assign('optionOne', range(1, 9));
        $this->tpl->assign('optionTwo', range(10, 10));
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['username'])) Tool::alertBack('会员名称不得为空');
            if (Validate::checkLength($_POST['userpass'], 4, 'min')) Tool::alertBack('会员名称不得小于4为');
            if (Validate::checkLength($_POST['username'], 20, 'max')) Tool::alertBack('会员名称不得大于20为');
            if (Validate::checkNull($_POST['userpass'])) Tool::alertBack('密码不得为空');
            if (Validate::checkLength($_POST['userpass'], 200, 'max')) Tool::alertBack('密码不得大于20为');
            $this->model->user = $_POST['username'];
            if ($this->model->getOneUser()) Tool::alertBack('会员名已被占用');
            $this->model->pass = $_POST['userpass'];
            $this->model->email = $_POST['email'];
            $this->model->face = $_POST['face'];
            $this->model->time = time();
            $this->model->adduser() ? Tool::alertLocation('恭喜你！新增会员成功！', 'user.php?action=list') : Tool::alertBack('很遗憾，新增会员失败！');
        }
        $this->tpl->assign('add', true);
        $this->tpl->assign('title', '新增会员');
    }
    private function update() {
        $this->tpl->assign('optionOne', range(1, 9));
        $this->tpl->assign('optionTwo', range(10, 10));
        if (isset($_POST['send'])) {
            $this->model->id = $_POST['id'];
            $this->model->user = $_POST['username'];
            if (Validate::checkNull($_POST['userpass'])) {
                $this->model->pass = $_POST['userpass'];
            }  else {
                if (Validate::checkLength($_POST['userppasss'], 6, 'min')) Tool::alertBack('密码不得小于6位');
                $this->model->pass = $_POST['userppasss'];
            }
            $this->model->pass = $_POST['userpass'];
            $this->model->email = $_POST['email'];
            $this->model->face = $_POST['face'];
            $this->model->updateUser() ? Tool::alertLocation('修改等级成功！', 'user.php?action=list') : Tool::alertBack('修改等级失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            is_object($this->model->getOneUser()) ? true : Tool::alertBack('你传的等级id有误');
            $this->tpl->assign('id',$this->model->getOneUser()->id);
            $this->tpl->assign('username',$this->model->getOneUser()->user);
            $this->tpl->assign('userpass',$this->model->getOneUser()->pass);
            $this->tpl->assign('email',$this->model->getOneUser()->email);
            $this->face($this->model->getOneUser()->face);
            $this->state($this->model->getOneUser()->state);
            $this->tpl->assign('update', true);
            $this->tpl->assign('title', '修改会员');
        } else {
            TOOL::alertBack('非法操作');
        }
    }
    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deleteUser() ? Tool::alertLocation('删除会员成功！', 'user.php?action=list') : Tool::alertBack('删除会员失败！');
        } else {
            Tool::alertBack('非法操作');
        }
        $this->tpl->assign('delete', true);
        $this->tpl->assign('title', '删除会员');
    }
    private function face($face) {
        $one = range(1, 9);
        $two = range(10, 10);
        foreach ($one as $value) {
            if ($face == $value) $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=0".$value.".jpg>0".$value.".jpg<option>";
            $selected = '';
        }
        foreach ($two as $value) {
            if ($face == $value) $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=".$value.".jpg>".$value.".jpg<option>";
            $selected = '';
        }
        $this->tpl->assign('face', $html);
    }
    private function state($state) {
        $statearr = array('被封杀的会员','待审核的会员','初级会员','高级会员','VIP会员');
        foreach ($statearr as $key=>$value) {
            if ($state == $key) $selected = 'selected="selected"';
            $html .= "<option ".$selected." value=".$key.">".$value."<option>";
            $selected = '';
        }
        $this->tpl->assign('state', $html);
    }
}