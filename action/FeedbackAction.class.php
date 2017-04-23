<?php
class FeedbackAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new FeedbackModel());
    }
    public function action() {
//         switch ($_GET['type']) {
//             case 'list':
                $this->showComment();
                $this->setCount();
//                 break;
//             case 'add':
                $this->comment();
//                 break;
//         }
    }
    private function comment() {
        if (isset($_POST['send'])) {
            if ($_SERVER['HTTP_REFERER'] == 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]) {
                if (Validate::checkLength($_POST['checkcode'], 4, 'equals')) Tool::alertBack('验证码长度必须是四位');
                if (Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['code'])) Tool::alertBack('验证码不一致');
                if (Validate::checkNull($_POST['content'])) Tool::alertBack('评论内容不得为空！');
            } else {
                if (Validate::checkLength($_POST['checkcode'], 4, 'equals')) Tool::alertClose('验证码长度必须是四位');
                if (Validate::checkEquals(strtolower($_POST['checkcode']), $_SESSION['code'])) Tool::alertClose('验证码不一致');
                if (Validate::checkNull($_POST['content'])) Tool::alertClose('评论内容不得为空！');
            }
            if ($_COOKIE['user']) {
                $this->model->user = $_COOKIE['user'];
            } else {
                $this->model->user = '游客';
            }
            $this->model->cid = $_GET['cid'];
            $this->model->content = $_POST['content'];
            $this->model->addComment() ? Tool::alertLocation('评论成功', 'feedback.php?cid='.$this->model->cid): Tool::alertLocation('评论失败', 'feedback.php?cid='.$this->model->cid);
        }
    }
    private function showComment() {
        if (isset($_GET['cid'])) {
            $this->model->cid = $_GET['cid'];
            $this->tpl->assign('id', $this->model->cid);
            $page = new Page($this->model->getAllUserCount(), PAGE_SIZE);
            $this->model->limit = $page->limit;
            $allcomment = $this->model->getAllComment();
            foreach ($allcomment as $key=>$value) {
                if (!empty($value->oppose)) {
                    $value->oppose = '-'.$value->oppose;
                }
            }
            $this->tpl->assign('allcomment', $allcomment);
            $this->tpl->assign('page', $page->ShowPage());
//             echo $_SERVER['HTTP_REFERER'].'<br />'; //可以得到上一页的地址
//             echo $_SERVER['PHP_SELF'].'<br />'; //得到当前页面地址
//             echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];//这个可以得到带参数的地址
        } else {
            Tool::alertBack('非法操作！');
        }
    }
    private function setCount() {
        if (isset($_GET['cid']) && isset($_GET[id]) && isset($_GET['type'])) {
            $this->model->id = $_GET['id'];
            if (!$this->model->getOneComment()) Tool::alertBack('不存在次id');
            switch ($_GET['type']) {
                case 'sustain':
                    $this->model->sustain() ? Tool::alertLocation('支持成功！', 'feedback.php?cid='.$_GET['cid']) : Tool::alertLocation('支持失败！', 'feedback.php?cid='.$_GET['cid']);
                    break;
                case 'oppose':
                    $this->model->oppose() ? Tool::alertLocation('反对成功！', 'feedback.php?cid='.$_GET['cid']) : Tool::alertLocation('反对失败！', 'feedback.php?cid='.$_GET['cid']);
                    break;
            }
        }
    }
}