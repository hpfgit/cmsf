<?php
class Cache {
    public function details() {
        $content = new ContentModel();
        $content->id = $_GET['id'];
        $this->setContentCount($content);
        $this->getContentCount($content);
    }
    
    public function cachetype() {
        switch ($_GET['type']) {
            case 'details':
                $this->details();
                break;
            case 'list':
                $this->listc();
                break;
            case 'header':
                $this->getHeader();
                break;
        }
    }
    private function getHeader() {
        if ($_COOKIE['user']) {
            echo "
                function getHeader() {
                    document.write('".$_COOKIE['user']."您好！<a href=\"./register.php?action=logout\">退出</a>');
                }
                ";
        } else {
            echo "
                function getHeader() {
                    document.write('<a href=\"./register.php?action=register\">注册</a> | <a href=\"./register.php?action=login\">登录</a>');
                }
                ";
        }
    }
    private function listc() {
        $content = new ContentModel();
        $content->id = $_GET['id'];
        $this->setContentCount($content);
        $this->getContentCount($content);
    }

    private function setContentCount(&$content) {
        $content->setContentCount();
    }

    private function getContentCount(&$content) {
        $count = $content->getOneContent()->count;
        echo "
            function get() {
                document.write('$count');
            }
        ";
    }
}