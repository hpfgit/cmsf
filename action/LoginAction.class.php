<?php
class LoginAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new ManageModel());
    }
    public function action() {
        switch ($_GET['action']) {
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
        }
    }
    private function login() {
        if (isset($_POST['send'])) {
            if (Validate::checkLength($_POST['checkcode'], 4, 'equals')) Tool::alertBack('验证码长度必须是四位');
            if (Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['code'])) Tool::alertBack('验证码不一致');
            if (!Validate::checkNull($_POST['amdin_user'])) Tool::alertBack('用户名不得为空');
            if (Validate::checkLength($_POST['admin_user'], 2, 'min')) Tool::alertBack('用户名不得小于四位');
            if (Validate::checkLength($_POST['admin_user'], 20, 'max')) Tool::alertBack('用户名不得大于二十位');
            if (Validate::checkLength($_POST['admin_pass'], 2, 'min')) Tool::alertBack('密码不得小于四位');
            if (Validate::checkLength($_POST['admin_pass'], 20, 'max')) Tool::alertBack('密码不得大于二十位');
            $this->model->admin_user = $_POST['admin_user'];
            $this->model->admin_pass = sha1($_POST['admin_pass']);
            if (is_object($this->model->checkLoginManage())) {
                $login = $this->model->checkLoginManage();
                $_SESSION['admin']['admin_user'] = $login->admin_user;
                $_SESSION['admin']['admin_level'] = $login->level_name;
                Tool::alertLocation(null,'admin.php');
            } else {
                Tool::alertBack('用户名或密码不正确');
            }
        }
    }
    private function logout() {
        Tool::unSession();
        Tool::alertLocation(null, 'admin_login.php');
    }
}