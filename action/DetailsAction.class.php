<?php
class DetailsAction extends Action {
    public function __construct(&$tpl) {
        parent::__construct($tpl, new ContentModel());
    }
    public function action() {
        $this->getDetails();
    }
    private function getDetails() {
      if (isset($_GET['id'])) {
          $this->model->id = $_GET['id'];
          $this->tpl->assign('details', true);
          if (!$this->model->setContentCount()) Tool::alertBack('没有此导航');
          $content = $this->model->getOneContent();
          $this->tpl->assign('id', $content->id);
          $this->tpl->assign('info', $content->info);
          $this->tpl->assign('tag', $content->tag);
          if (IS_CACHE) {
              $this->tpl->assign('count', '<script type="text/javascript">get();</script>');
          } else {
              $this->tpl->assign('count', $content->count);
          }
          $this->getNav($content->nav);
          $comment = new FeedbackModel();
          $comment->cid = $_GET['id'];
          $this->tpl->assign('threecomment', $comment->getNewThreeComment());
          $this->tpl->assign('hothreecomment', $comment->getHotThreeComment());
          $this->tpl->assign('getHotTwentyComment', $comment->getHotTwentyComment());
      } else {
          Tool::alertBack('非法操作');
      }
    }
    //获取前台显示导航
    private function getNav($id) {
        $nav = new NavModel();
        $nav->id = $id;
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
    }
}