<?php
class IndexAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl);
    }
    public function action() {
        $this->login();
        $this->laterUser();
    }
    private function laterUser() {
        $lateruser = new RegisterModel();
        $this->tpl->assign('Alllateruser', $lateruser->getLaterUser());
        $this->tpl->assign('alllateruser', true);
    }
    private function login() {
        if ($_COOKIE['user']) {
            $this->tpl->assign('user', $_COOKIE['user']);
            $this->tpl->assign('face', $_COOKIE['face']);
        } else {
            $this->tpl->assign('login', true);
        }
    }
}