<?php
class LevelAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new LevelModel());
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
        $this->tpl->assign('title', '管理员等级列表');
        $this->tpl->assign('manage', $this->model->getAlllevel());
    }
    private function add() {
        if (isset($_POST['send'])) {
            if (Validate::checkNull($_POST['level_name'])) Tool::alertBack('等级名称不得为空');
            if (Validate::checkLength($_POST['level_name'], 4, 'min')) Tool::alertBack('等级名称不得小于4为');
            if (Validate::checkLength($_POST['level_name'], 20, 'max')) Tool::alertBack('等级名称不得大于20为');
            if (Validate::checkNull($_POST['level_info'])) Tool::alertBack('描述不得为空');
            if (Validate::checkLength($_POST['level_info'], 200, 'max')) Tool::alertBack('描述不得大于20为');
            $this->model->level_name = $_POST['level_name'];
            if ($this->model->getOneLevel()) Tool::alertBack('等级名已被占用');
            $this->model->level_info = $_POST['level_info'];
            $this->model->addLevel() ? Tool::alertLocation('恭喜你！新增等级成功！', 'level.php?action=list') : Tool::alertBack('很遗憾，新增等级失败！');
        }
        $this->tpl->assign('add', true);
        $this->tpl->assign('title', '新增管理员等级');
    }
    private function update() {
        if (isset($_POST['send'])) {
            $this->model->id = $_POST['id'];
            $this->model->level_name = $_POST['level_name'];
            $this->model->level_info = $_POST['level_info'];
            $this->model->updateLevel() ? Tool::alertLocation('修改等级成功！', 'level.php?action=list') : Tool::alertBack('修改等级失败！');
        }
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            is_object($this->model->getOneLevel()) ? true : Tool::alertBack('你传的等级id有误');
            $this->tpl->assign('id',$this->model->getOneLevel()->id);
            $this->tpl->assign('level_name',$this->model->getOneLevel()->level_name);
            $this->tpl->assign('admin_info',$this->model->getOneLevel()->level_info);
            $this->tpl->assign('update', true);
            $this->tpl->assign('title', '修改等级');
        } else {
            TOOL::alertBack('非法操作');
        }
    }
    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->id = $_GET['id'];
            $this->model->deleteLevel() ? Tool::alertLocation('删除等级成功！', 'level.php?action=list') : Tool::alertBack('删除等级失败！');
        } else {
            Tool::alertBack('非法操作');
        }
        $this->tpl->assign('delete', true);
        $this->tpl->assign('title', '删除管理员等级');
    }
}