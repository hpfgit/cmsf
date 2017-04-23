<?php
class RegisterAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new RegisterModel());
    }
    public function action() {
        switch ($_GET['action']) {
            case 'register':
                $this->register();
                break;
            case 'add':
                $this->adduser();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                Tool::alertBack('非法操作');
        }
    }
    private function register() {
        $this->tpl->assign('register', true);
        $this->tpl->assign('optionOne', range(1, 9));
        $this->tpl->assign('optionTwo', range(10, 10));
    }
    private function login() {
        if (isset($_POST['send'])) {
            if (Validate::checkLength($_POST['checkcode'], 4, 'equals')) Tool::alertBack('验证码长度必须是四位');
            if (Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['code'])) Tool::alertBack('验证码不一致');
            $this->model->user = $_POST['username'];
            $this->model->pass = sha1($_POST['userpass']);
            $user = $this->model->getOneUser();
            if (is_object($this->model->checklogin())) {
                setcookie('user', $user->user, time()+7200);
                setcookie('pass', $user->pass, time()+7200);
                setcookie('face', $user->face, time()+7200);
                $this->model->id=$user->id;
                $this->model->time = time();
                $this->model->setLaterUser();
                $this->tpl->assign('islogin', true);
                Tool::alertLocation('登录成功！', './index.php');
            } else {
                Tool::alertBack('登录失败！');
            }
        }
        $this->tpl->assign('login', true);
    }
    private function logout() {
        setcookie('user', $this->model->user, -1);
        setcookie('pass', $this->model->pass, -1);
        Tool::alertLocation(null, './index.php');
    }
    private function adduser() {
        if (isset($_POST['send'])) {
            if (Validate::checkLength($_POST['checkcode'], 4, 'equals')) Tool::alertBack('验证码长度必须是四位');
            if (Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['code'])) Tool::alertBack('验证码不一致');
            if (Validate::checkemail($_POST['email'])) Tool::alertBack('邮箱格式不正确！');
            $this->model->user = $_POST['username'];
            $this->model->pass = sha1($_POST['userpass']);
            $this->model->email = $_POST['email'];
            $this->model->face = $_POST['face'];
            $this->model->time = time();
            if (is_object($this->model->getOneUser())) Tool::alertBack('此用户已被注册');
            $this->model->adduser() ? Tool::alertLocation('注册成功！', './register.php?action=login') : Tool::alertBack('注册失败');
        }
    }
    private function laterUser() {
        ;
    }
}